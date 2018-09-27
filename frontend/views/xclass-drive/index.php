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
/* @var $userModel \common\models\User */

$this->title = 'ABS Авто X-Class тест драйв';
?>

<div class = "info x-class">
    <?= $this->render('_top-line', [
        'title' => 'X-Class тест драйв выбор капитанов',
        'link' => Yii::$app->homeUrl,
    ]) ?>
    <div class = "x-class_content">
        <p>
            Уважаемые участники, для начала данного квеста необходимо выбрать капитанов и поделиться на команды.
        </p>
    </div>
    <div class = "kapitan">
        <a id="captainButton" class="red_button">ХОЧУ СТАТЬ<br>КАПИТАНОМ</a>
    </div>
    <div class = "x-class_content">
        <p>
            По команде тренера все желающие стать капитанами жмут "Красную кнопку" на экране.
            Первые 6 человек назначаются капитанами
        </p>
    </div>
    <?= $this->render('_footer') ?>
</div>

<?= $this->render('_popup-captain-ok') ?>

<script>
    window.onload = function () {

        var $captainButton = $('#captainButton');
        var name = '<?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?>';
        var userId = <?= $userModel->id ?>;
        var trainingId = <?= $userModel->training_id ?>;
        var group = <?= $userModel->group ?>;

        function connect () {
            // var chat = new WebSocket('ws://188.225.10.52:1024');
            var socket = new WebSocket('ws://localhost:8080');

            socket.onmessage = function(e) {

                var response = JSON.parse(e.data);
                if (response.type && response.type === 'setCaptain') {
                    console.log(response);
                    if (+response.from === +userId){
                        $('#captainOk').show();
                    }
                } else if (response.message) {
                    console.log(response.message);
                }
            };

            socket.onopen = function() {
                socket.send( JSON.stringify({'action' : 'setName', 'name' : name, 'id' : userId}) );
                console.log('connect')
            };

            $captainButton.click(function() {
                socket.send( JSON.stringify({'action' : 'setCaptain', 'user_id' : userId, 'training_id' : trainingId, 'group' : group}) );
            });

            socket.onclose = function () {
                connect()
            };
        }

        connect();
    }
</script>




