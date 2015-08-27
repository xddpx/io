<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;
use yii\log\Logger as LoggerBase;

/**
 * Logger
 *
 * @author Dmitry Pilipenko
 * @version 1.0
 */
class Logger extends \yii\log\FileTarget {

    public $date_format = "Y.m.d";
    private $_levels = array(1, 2);

    /**
     * Initializes the route.
     * This method is invoked after the route is created by the route manager.
     */
    public function getDir($logFile = 'app') {
        $logFile = preg_replace("![^\w\d\s]*!", "", $logFile);
        $logFile = (empty($logFile)) ? 'app' : $logFile;
        $this->logFile = Yii::$app->getRuntimePath() . '/logs/' . date($this->date_format) . '/' . $logFile . '.log';
        $logPath = dirname($this->logFile);
        if (!is_dir($logPath)) {
            FileHelper::createDirectory($logPath, $this->dirMode, true);
        }
        if ($this->maxLogFiles < 1) {
            $this->maxLogFiles = 1;
        }
    }

    /**
     * Writes log messages to a file.
     * @throws InvalidConfigException if unable to open the log file for writing
     */
    public function export() {
        foreach ($this->messages as $message) {
            if (!in_array($message[1], $this->_levels)) {
                continue;
            }
            $this->getDir($message[2]);
            $text = implode("\n", array_map([$this, 'formatMessage'], array($message))) . "\n";
            if (($fp = @fopen($this->logFile, 'a')) === false) {
                throw new InvalidConfigException("Unable to append to log file: {$this->logFile}");
            }
            @flock($fp, LOCK_EX);
            if ($this->enableRotation) {
                // clear stat cache to ensure getting the real current file size and not a cached one
                // this may result in rotating twice when cached file size is used on subsequent calls
                clearstatcache();
            }
            if ($this->enableRotation && @filesize($this->logFile) > $this->maxFileSize * 1024) {
                $this->rotateFiles();
                @flock($fp, LOCK_UN);
                @fclose($fp);
                @file_put_contents($this->logFile, $text, FILE_APPEND | LOCK_EX);
            } else {
                @fwrite($fp, $text);
                @flock($fp, LOCK_UN);
                @fclose($fp);
            }
            if ($this->fileMode !== null) {
                @chmod($this->logFile, $this->fileMode);
            }
        }
    }

}
