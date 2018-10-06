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

    <div class="flex_1">
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

    }
</script>

