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
/* @var $commandModels \common\models\Command */
/* @var $commandModel \common\models\Command */

$this->title = 'ABS Авто Выбор команды';
?>

<div class = "schedule">
    <?= $this->render('_top-line', [
        'title' => 'Выбор команды',
        'link' => false,
    ]) ?>

    <? foreach ($commandModels as $commandModel) {?>
        <?/* @var $captain \common\models\User */
            $captain = $commandModel->captain;
            $playerCount = 1;
            $playerCount = $commandModel->player_1_id != null ? ++$playerCount : $playerCount;
            $playerCount = $commandModel->player_2_id != null ? ++$playerCount : $playerCount;
            $playerCount = $commandModel->player_3_id != null ? ++$playerCount : $playerCount;
        ?>

        <div id="command_<?= $commandModel->id ?>" class = "x-class_content_1 schedule_content" data-command_id="<?= $commandModel->id ?>">
            <p class = "x-class_name"><?= $captain->surname . ' ' . $captain->first_name . ' ' . $captain->last_name ?></p>
            <p class = "x-class_number">
                <? if ($commandModel->isFull) {?>
                    <span>Команда набрана</span>
                <?}else{?>
                    (<?= $playerCount ?> / 4)
                <?}?>
            </p>
        </div>

    <?}?>

    <div class="x-class_content">
        <p>
            <span>*</span> Данный квест является командным, все задания видит только капитан. Остальные члены команды помогают
        </p>
        <p id="selectCommand" class="submit">ОК</p>
    </div>

    <?= $this->render('_footer') ?>
</div>

<?= $this->render('_popup-captain') ?>

<script>
    //x-class_active//
    window.onload = function () {

        var commandId;

        $('.schedule_content').on('click', function () {
            $('.schedule_content').removeClass('x-class_active');
            $(this).addClass('x-class_active');
            commandId = $(this).data('command_id');
        });


        var name = '<?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?>';
        var userId = <?= $userModel->id ?>;


        function connect () {
            // var chat = new WebSocket('ws://188.225.10.52:1024');
            var socket = new WebSocket('ws://localhost:8081');

            socket.onmessage = function(e) {

                var response = JSON.parse(e.data);

                if (response.type && response.type === 'selectCommand') {
                    console.log(response);
                    if (response.from.commandId && response.from.player) {
                        switch (response.from.player) {
                            case 'player1':
                                $('#command_' + response.from.commandId).find('.x-class_number').text('2 / 4');
                                break;
                            case 'player2':
                                $('#command_' + response.from.commandId).find('.x-class_number').text('3 / 4');
                                break;
                            case 'player3':
                                $('#command_' + response.from.commandId).find('.x-class_number').html('<span>Команда набрана</span>');
                                break;
                        }
                        if (+userId === +response.from.userId){
                            $('#commandSet').show();
                        }
                    }else if (+response.from === userId){
                        $('#commandNoSet').show();
                    }

                } else if (response.message) {
                    console.log(response.message);
                }
            };

            socket.onopen = function() {
                socket.send( JSON.stringify({'action' : 'setName', 'name' : name, 'id' : userId}) );
                console.log('connect')
            };

            $('#selectCommand').on('click', function () {
                socket.send( JSON.stringify({'action' : 'selectCommand', 'name' : name, 'user_id' : userId, 'commandId' : commandId}) );
            });

            socket.onclose = function () {
                connect()
            };
        }

        connect();
    }
</script>




