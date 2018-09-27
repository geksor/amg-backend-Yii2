<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $messages \common\models\Chat */
/* @var $message \common\models\Chat */
/* @var $userModel \common\models\User */

$this->title = 'ABS Авто Чат';
?>

<div class = "forum">
    <?= $this->render('_top-line', [
        'title' => 'Назад',
        'link' => Yii::$app->homeUrl,
    ]) ?>
    <div id="messBlock" class="messBlockWrap">
        <? foreach ($messages as $message) {?>

            <? if ($message->user_id === $userModel->id) {?>
                <div class="messege messege_user">
                    <h3>Вы</h3>
                    <p>
                        <?= $message->message ?>
                    <p>
                </div>
            <?}else{?>
                <div class="messege">
                    <? $user = $message->user ?>
                    <h3><?= "$user->surname $user->first_name $user->last_name" ?></h3>
                    <p>
                        <?= $message->message ?>
                    <p>
                </div>
            <?}?>

        <?}?>
    </div>
    <p>
        <input id="sendMessage" type="text" name="text" class = "textarea" placeholder = "Написать сообщение..">
    </p>
    <?= $this->render('_footer') ?>
</div>

<script>
    var block = document.getElementById("messBlock");
    block.scrollTop = block.scrollHeight;
</script>

<script>
    window.onload = function () {

        var $chatBlock = $('#messBlock');
        var $sendMessage = $('#sendMessage');

        function connect () {
            var chat = new WebSocket('ws://localhost:8080');
            chat.onmessage = function(e) {

                var response = JSON.parse(e.data);
                if (response.type && response.type === 'chat') {
                    console.log(response);
                    $chatBlock.append('<div class="messege"><h3>' + response.from + '</h3> <p>' + response.message + '</p></div>');
                    $chatBlock.scrollTop = chat.height;
                } else if (response.message) {
                    console.log(response.message);
                }
            };
            chat.onopen = function(e) {
                chat.send( JSON.stringify({'action' : 'setName', 'name' : $('#username').val()}) );
                console.log('connect')
            };
            $('#send').click(function() {
                if ($sendMessage.val()) {
                    chat.send( JSON.stringify({'action' : 'chat', 'message' : $sendMessage.val()}) );
                } else {
                    alert('Enter the message')
                }
            });

            chat.onclose = function () {
                connect()
            };
        }

        connect();
    }
</script>




