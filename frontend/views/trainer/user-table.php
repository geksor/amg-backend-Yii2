<?php

/* @var $this yii\web\View */
/* @var $userModelsGroup1 \common\models\User */
/* @var $userModelsGroup2 \common\models\User */
/* @var $maxPoint \frontend\controllers\TrainerController */

$this->title = 'ABS Авто раздел тренера список учасников';
?>
<div class = "info info_trenr_group">
    <?= $this->render('_top-line', [
        'title' => 'Список участников',
        'link' => '/trainer/index',
    ]) ?>

        <div id="group_1_block" class = "trenr_groups" <?= (integer)Yii::$app->user->identity->group === 1 ? '' : 'style="display:none"' ?>>
            <? if (empty($userModelsGroup1)) {?>
                Нет пользователей в группе
            <?}else{?>
                <? foreach ($userModelsGroup1 as $key => $userModel) {?>
                    <?/* @var $userModel \common\models\User */?>
                    <div class = "trenr_group">
                        <div class = "group_place">
                            <p class = "group_place_number"> <?= ++$key ?> </p>
                        </div>
                        <div class = "group_name">
                            <p><?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?></p>
                        </div>
                        <div class = "group_bal" data-value="<?= $userModel->totalPoint ?>">
                            <p class = "group_bal_number"><?= $userModel->totalPoint ?></p>
                        </div>
                    </div>
                <?}?>
            <?}?>
        </div>

        <div id="group_2_block" class = "trenr_groups" <?= (integer)Yii::$app->user->identity->group === 2 ? '' : 'style="display:none"' ?>>
            <? if (empty($userModelsGroup2)) {?>
                Нет пользователей в группе
            <?}else{?>
                <? foreach ($userModelsGroup2 as $key => $userModel) {?>
                    <?/* @var $userModel \common\models\User */?>
                    <div class = "trenr_group">
                        <div class = "group_place">
                            <p class = "group_place_number"> <?= ++$key ?> </p>
                        </div>
                        <div class = "group_name">
                            <p><?= $userModel->surname . ' ' . $userModel->first_name . ' ' . $userModel->last_name ?></p>
                        </div>
                        <div class = "group_bal" data-value="<?= $userModel->totalPoint ?>">
                            <p class = "group_bal_number"><?= $userModel->totalPoint ?></p>
                        </div>
                    </div>
                <?}?>
            <?}?>
        </div>

    <?= $this->render('_footer-group') ?>
</div> <!-- -->

<script>
    window.onload = function () {

        var maxPoint = <?= $maxPoint ?>;

        $('.group_bal').each(function () {

            $(this).progressbar({
                value: $(this).data('value'),
                max: maxPoint
            })
        });

        $('#groupSelect_1').on('click', function () {
            $('#group_2_block').hide();
            $('#group_1_block').show();
        });

        $('#groupSelect_2').on('click', function () {
            $('#group_1_block').hide();
            $('#group_2_block').show();
        });

        function connect () {
            // var chat = new WebSocket('ws://188.225.10.52:1024');
            var chat = new WebSocket('ws://localhost:8081');
            chat.onmessage = function(e) {

                var response = JSON.parse(e.data);
                if (response.type && response.type === 'changePoint') {
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

