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

$this->title = 'MyNT2018 Чат';
?>

<div class = "forum">
    <?= $this->render('_top-line', [
        'title' => 'Назад',
        'link' => Yii::$app->homeUrl,
    ]) ?>
    <div class="messBlockWrap">
        <div id="messBlock" class="messBlock">
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
    </div>
    <?= $this->render('_footer', [
            'userModel' => $userModel,
    ]) ?>
</div>

<script>
    // var block = document.getElementById("messBlock");
    // block.scrollTop = block.scrollHeight;
</script>

<script>
    window.onload = function () {

        var $chatWrap = $('.messBlockWrap');
        var $chatBlock = $('#messBlock');
        var $sendMessage = $('#sendMessage');

        $chatWrap.css('height', $chatWrap.height());

        $chatWrap.scrollTop($chatBlock.height());

        function connect () {
            var chat = new WebSocket('ws://188.225.9.40:1025');
            // var chat = new WebSocket('ws://localhost:1024');
            chat.onmessage = function(e) {

                var response = JSON.parse(e.data);
                if (response.type && response.type === 'chat') {
                    console.log(response);
                    var messClass = +response.from.id === +$sendMessage.data('id') ? ' messege_user' : '';
                    var messName = +response.from.id === +$sendMessage.data('id') ? 'Вы' : response.from.name;
                    $chatBlock.append( '<div class="messege' + messClass + '"><h3>' + messName + '</h3> <p>' + response.message + '</p></div>' );
                    $chatWrap.scrollTop($chatBlock.height());
                } else if (response.message) {
                    console.log(response.message);
                }
            };
            chat.onopen = function(e) {
                chat.send( JSON.stringify({'action' : 'setName', 'name' : $sendMessage.data('name'), 'id' : $sendMessage.data('id')}) );
                console.log('connect')
            };
            $('#send').click(function() {
                if ($sendMessage.val()) {
                    chat.send( JSON.stringify({'action' : 'chat', 'message' : $sendMessage.val()}) );
                    $sendMessage.val('');
                } else {
                    // alert('Enter the message')
                }
            });
            $sendMessage.keypress(function(e){
                if(e.keyCode === 13){
                    chat.send( JSON.stringify({'action' : 'chat', 'message' : $sendMessage.val()}) );
                    $sendMessage.val('');
                }
            });

            chat.onclose = function () {
                window.location.reload();
            };
        }

        connect();
    }
</script>




