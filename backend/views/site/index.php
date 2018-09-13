<?php

/* @var $this yii\web\View */

$this->title = 'ABS админ панель';
?>
<div class="site-index">
<!--    --><?//= \yii\bootstrap\Html::textInput('message', '', ['class' => 'messField', 'placeholder' => 'Message']) ?>
<!--    --><?//= \yii\helpers\Html::button(
//            'Привет',
//            [
//                'class' => 'hey btn btn-primary',
//            ]
//    ) ?>
<!--    <div class="response"></div>-->
<!---->
<!--    <script>-->
<!--        var conn = new WebSocket('ws://localhost:8080');-->
<!--        conn.onmessage = function (e) {-->
<!--            console.log(e);-->
<!--            $('.response').text('Response: ' + e.data)-->
<!--        };-->
<!--        conn.onopen = function (e) {-->
<!--            console.log("Connection established!");-->
<!--        };-->
<!---->
<!--        window.onload = function () {-->
<!--            $('.hey').on('click', function () {-->
<!--                conn.send($('.messField').val());-->
<!--            });-->
<!--        }-->
<!--    </script>-->

    Username:<br />
    <input id="username" type="text"><button id="btnSetUsername">Set username</button><button id="disconnect">Disconnect</button>

    <div id="chat" style="width:400px; height: 250px; overflow: scroll;"></div>

    Message:<br />
    <input id="message" type="text"><button id="btnSend">Send</button>
    <div id="response" style="color:#D00"></div>

    <script>
        window.onload = function () {
            function connect () {
                var chat = new WebSocket('ws://localhost:8080');
                chat.onmessage = function(e) {
                    $('#response').text('');

                    var response = JSON.parse(e.data);
                    if (response.type && response.type == 'chat') {
                        console.log(response);
                        $('#chat').append('<div><b>' + response.from + '</b>: ' + response.message + '</div>');
                        $('#chat').scrollTop = $('#chat').height;
                    } else if (response.message) {
                        $('#response').text(response.message);
                    }
                };
                chat.onopen = function(e) {
                    $('#response').text("Connection established! Please, set your username.");
                    open = true;
                };
                $('#btnSend').click(function() {
                    if ($('#message').val()) {
                        chat.send( JSON.stringify({'action' : 'chat', 'message' : $('#message').val()}) );
                    } else {
                        alert('Enter the message')
                    }
                });

                $('#btnSetUsername').click(function() {
                    if ($('#username').val()) {
                        chat.send( JSON.stringify({'action' : 'setName', 'name' : $('#username').val()}) );
                    } else {
                        alert('Enter username')
                    }
                });

                chat.onclose = function () {
                    connect()
                };
            }

            connect();
        }
    </script>

</div>
