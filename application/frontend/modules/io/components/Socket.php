<?php

namespace frontend\modules\io\components;

use Yii;
use common\models\User;
use frontend\modules\io\models\Document;
use yii\db\Connection;

/**
 * Socket server
 * @author Dmitry Pilipenko
 */
class Socket extends \yii\base\Component {

    public $host;
    public $port;
    public $domain;
    private $clients;

    public function listen() {
        try {
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); //Create TCP/IP sream socket
            socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1); //reuseable port
            socket_bind($socket, 0, $this->getPort()); //bind socket to specified host
            socket_listen($socket); //listen to port
            $this->clients = array($socket); //create & add listning socket to the list
            //start endless loop, so that our script doesn't stop
            while (true) {
                $changed = $this->clients; //manage multipal connections
                socket_select($changed, $null, $null, 0, 10); //returns the socket resources in $changed array
                //check for new socket
                if (in_array($socket, $changed)) {
                    $socket_new = socket_accept($socket); //accpet new socket
                    $this->clients[] = $socket_new; //add socket to client array
                    $header = socket_read($socket_new, 1024); //read data sent by the socket
                    $this->performHandshaking($header, $socket_new, $this->getHost(), $this->getPort()); //perform websocket handshake
                    socket_getpeername($socket_new, $ip); //get ip address of connected socket
                    $response = $this->mask(json_encode(array('type' => 'system', 'message' => $ip . ' connected'))); //prepare json data
                    $this->sendMessage($response); //notify all users about new connection
                    $found_socket = array_search($socket, $changed); //make room for new socket
                    unset($changed[$found_socket]);
                }
                //loop through all connected sockets
                foreach ($changed as $changed_socket) {
//                    check for any incomming data
                    while (socket_recv($changed_socket, $buf, 8192000, 0) >= 1) {
                        $received_text = $this->unmask($buf); //unmask data
                        $tst_msg = json_decode($received_text); //json decode 
                        $diff = $tst_msg->diff; //document diff
                        $auth_key = $tst_msg->auth_key; //user auth key
                        $document_id = $tst_msg->document_id; //document id
                        if (!Yii::$app->db->getIsActive()) {
                            Yii::$app->db->open();
                        }
                        $user = User::findIdentityByAuthKey($auth_key);
                        if ($user === NULL) {
                            $response_text = $this->mask(json_encode(array('type' => 'system', 'message' => "You don't have permission to access")));
                            $this->sendMessage($response_text); //send data
                            break 2;
                        }
                        $document = Document::findOne(['id' => intval($document_id)]);
                        if ($document === NULL) {
                            $response_text = $this->mask(json_encode(array('type' => 'system', 'message' => "The requested document does not exist.")));
                            $this->sendMessage($response_text); //send data
                            break 2;
                        }
                        $this->saveDocument($document, $diff);
                        //prepare data to be sent to client
                        $response_text = $this->mask(json_encode(array('type' => 'update', 'document_diff' => $diff)));
                        var_dump($this->sendMessage($response_text)); //send data
                        break 2; //exist this loop
                    }
                    $buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
                    if ($buf === false) { // check disconnected client
                        // remove client for $this->clients array
                        $found_socket = array_search($changed_socket, $this->clients);
                        @socket_getpeername($changed_socket, $ip);
                        unset($this->clients[$found_socket]);
                        //notify all users about disconnected connection
                        $response = $this->mask(json_encode(array('type' => 'system', 'message' => $ip . ' disconnected')));
                        $this->sendMessage($response);
                    }
                }
            }
        } catch (\yii\base\Exception $e) {
            
        } finally {
            // close the listening socket
            socket_close($socket);
        }
    }

    private function saveDocument(&$document, $diff) {
        $result = '';
        $text_array = explode(" ", $document->content);
        foreach ($diff as $item) {
            $text_array[$item->element] = $item->value;
        }
        $result = implode(" ", $text_array);
        return Document::updateAll(['content' => $result], ['id' => $document->id]);
    }

    private function sendMessage($msg) {
        if (empty($this->clients)) {
            return false;
        }
        foreach ($this->clients as $changed_socket) {
            @socket_write($changed_socket, $msg, strlen($msg));
        }
        return true;
    }

    private function unmask($text) {
        $length = ord($text[1]) & 127;
        if ($length == 126) {
            $masks = substr($text, 4, 4);
            $data = substr($text, 8);
        } elseif ($length == 127) {
            $masks = substr($text, 10, 4);
            $data = substr($text, 14);
        } else {
            $masks = substr($text, 2, 4);
            $data = substr($text, 6);
        }
        $text = "";
        for ($i = 0; $i < strlen($data); ++$i) {
            $text .= $data[$i] ^ $masks[$i % 4];
        }
        return $text;
    }

    private function mask($text) {
        $b1 = 0x80 | (0x1 & 0x0f);
        $length = strlen($text);

        if ($length <= 125)
            $header = pack('CC', $b1, $length);
        elseif ($length > 125 && $length < 65536)
            $header = pack('CCn', $b1, 126, $length);
        elseif ($length >= 65536)
            $header = pack('CCNN', $b1, 127, $length);
        return $header . $text;
    }

    private function performHandshaking($receved_header, $client_conn, $host, $port) {
        $headers = array();
        $lines = preg_split("/\r\n/", $receved_header);
        foreach ($lines as $line) {
            $line = chop($line);
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }

        $secKey = $headers['Sec-WebSocket-Key'];
        $secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        //hand shaking header
        $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
                "Upgrade: websocket\r\n" .
                "Connection: Upgrade\r\n" .
                "WebSocket-Origin: $host\r\n" .
                "WebSocket-Location: ws://$host:$port/demo/shout.php\r\n" .
                "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
        socket_write($client_conn, $upgrade, strlen($upgrade));
    }

    public function setHost($host) {
        $this->host = $host;
        return $this;
    }

    public function getHost() {
        return ($this->host == null) ? $_SERVER['SERVER_ADDR'] : $this->host;
    }

    public function setPort($port) {
        $this->port = $port;
        return $this;
    }

    public function getPort() {
        return $this->port;
    }

}
