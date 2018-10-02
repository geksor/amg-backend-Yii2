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
/* @var $commandModel \common\models\Command */
/* @var $captain \common\models\User */

$captain = $commandModel->captain;
$this->title = 'ABS Авто Список членов команды';
?>

<div class = "schedule">
    <?= $this->render('_top-line', [
        'title' => 'Список членов команды',
        'link' => Yii::$app->homeUrl,
    ]) ?>

    <div id="captain" class = "x-class_content_1 schedule_content">
        <p class = "x-class_name"><?= $captain->surname . ' ' . $captain->first_name . ' ' . $captain->last_name ?></p>
        <p class = "x-class_number"><span class = "orange">Капитан команды</span></p>
    </div>
    <div id="player1" class = "x-class_content_1 schedule_content">
        <p class = "x-class_name">
            <?= $commandModel->player1 !== null
                ? $commandModel->player1->surname . ' ' . $commandModel->player1->first_name . ' ' . $commandModel->player1->last_name
                : ''?>
        </p>
    </div>
    <div id="player2" class = "x-class_content_1 schedule_content">
        <p class = "x-class_name">
            <?= $commandModel->player2 !== null
                ? $commandModel->player2->surname . ' ' . $commandModel->player2->first_name . ' ' . $commandModel->player2->last_name
                : ''?>
        </p>
    </div>
    <div id="player3" class = "x-class_content_1 schedule_content">
        <p class = "x-class_name">
            <?= $commandModel->player3 !== null
                ? $commandModel->player3->surname . ' ' . $commandModel->player3->first_name . ' ' . $commandModel->player3->last_name
                : ''?>
        </p>
    </div>

    <div class="x-class_content comand_content">
        <p>
            <span>*</span> Данный квест является командным, все задания видит только капитан. Остальные члены команды помогают
        </p>
        <? if ($userModel->id === $captain->id) {?>
            <?= Html::a('Перейти к вопросам', '/xclass-drive/question', ['class' => 'submit']) ?>
        <?}?>
    </div>

    <?= $this->render('_footer') ?>
</div>

<?= $this->render('_popup-captain') ?>

<script>
    window.onload = function () {

        var name = '<?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?>';
        var userId = <?= $userModel->id ?>;
        var commandId = <?= $commandModel->id ?>;

        function connect () {
            var socket = new WebSocket('ws://188.225.10.52:1024');
            // var socket = new WebSocket('ws://localhost:8081');

            socket.onmessage = function(e) {

                var response = JSON.parse(e.data);

                if (response.type && response.type === 'selectCommand') {
                    console.log(response);
                    if (+response.from.commandId === +commandId) {
                        switch (response.from.player) {
                            case 'player1':
                                $('#player1').text(response.message);
                                break;
                            case 'player2':
                                $('#player2').text(response.message);
                                break;
                            case 'player3':
                                $('#player3').text(response.message);
                                break;
                        }
                    }
                } else if (response.message) {
                    console.log(response.message);
                }
            };

            socket.onopen = function() {
                socket.send( JSON.stringify({'action' : 'setName', 'name' : name, 'id' : userId}) );
                console.log('connect')
            };

            socket.onclose = function () {
                connect()
            };
        }

        connect();
    }
</script>




