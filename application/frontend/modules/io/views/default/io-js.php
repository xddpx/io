<script type="text/javascript">
    init.push(function () {
        var host = '<?= Yii::$app->request->serverName ?>';
        var port = '9000';
        var socket_uri = "ws://" + host + ":" + port + "/stream/document/connection";
        var auth_key = $("#auth_key").val();
        var document_id = $("#document_id").val();
        var websocket = new WebSocket(socket_uri);

        var origin_document = $("#document-content").val();
        var new_document = '';
        var is_update = false;
        $("#document-content").on("keyup", function (e) {
            is_update = true;
            new_document = $(this).val();
        }).height("400px");

        setInterval(function () {
            if (is_update) {
                result = text.diffPath(origin_document, new_document);
                websocket.send(JSON.stringify({
                    auth_key: auth_key,
                    document_id: document_id,
                    diff: result,
                }));
                origin_document = new_document;
                is_update = false;
            }
        }, 3000);


        var text = {
            diffPath: function (text, new_text) {
                result = [];
                text_array = text.split(" ");
                new_text_array = new_text.split(" ");
                length = Math.max(text_array.length, new_text_array.length);
                for (i = 0; i < length; i++) {
                    if (text_array[i] != new_text_array[i]) {
                        result.push({element: i, value: new_text_array[i]});
                    }
                }
                return result;
            },
            insertDiff: function (text, diff) {
                result = '';
                text_array = text.split(" ");
                for (i = 0; i < diff.length; i++) {
                    text_array[diff[i].element] = diff[i].value;
                }
                for (i = 0; i < text_array.length; i++) {
                    if (text_array[i]) {
                        result += (result == "") ? text_array[i] : " " + text_array[i];
                    }
                }
                return result;
            },
        }
        ;
        websocket.onopen = function (ev) {
        }

        websocket.onmessage = function (ev) {
            var msg = JSON.parse(ev.data);
            var type = msg.type; //message type
            switch (type) {
                case 'update':
                    $("#document-content").val(text.insertDiff(origin_document, msg.document_diff));
                    origin_document = $("#document-content").val();
                    break
                case 'system':
                    $.growl({title: "Growl", message: msg.message});
                    break
            }
        };

        websocket.onerror = function (ev) {
            $.growl.error({message: "Error in connection establishment"});
        };

        websocket.onclose = function (ev) {
            websocket = new WebSocket(socket_uri);
        };
    });
</script>