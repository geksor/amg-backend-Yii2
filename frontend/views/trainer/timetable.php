<?php

/* @var $this yii\web\View */
/* @var $timetableModels \common\models\Timetable */
/* @var $traningDay \frontend\controllers\SiteController */
/* @var $model \common\models\Timetable */

$this->title = 'ABS Авто расписание';
?>

<div class="schedule schedule_trener">
    <?= $this->render('_top-line', [
        'title' => 'Расписание',
        'link' => '/trainer/index',
    ]) ?>
    <div class="schedule_content_trener_in">
        <div class = "schedule_tab_trener_in">
            <div class = "schedule_tab_trener">
                <h2>Группа 1</h2>
                <ul class = "schedule_tab">
                    <li><a href = "weekday_<?= $traningDay === 1 ? '1' : '3' ?>_group_1" class="trainerTabLink active"><?= $traningDay === 1 ? 'Понедельник' : 'Среда' ?></a></li>
                    <li><a href = "weekday_<?= $traningDay === 1 ? '2' : '4' ?>_group_1" class="trainerTabLink"><?= $traningDay === 1 ? 'Вторник' : 'Четверг' ?></a></li>
                    <li><a href = "weekday_<?= $traningDay === 1 ? '3' : '5' ?>_group_1" class="trainerTabLink"><?= $traningDay === 1 ? 'Среда' : 'Пятница' ?></a></li>
                </ul>
            </div>
            <div class = "schedule_tab_trener">
                <h2>Группа 2</h2>
                <ul class = "schedule_tab">
                    <li><a href = "weekday_<?= $traningDay === 1 ? '1' : '3' ?>_group_2" class="trainerTabLink"><?= $traningDay === 1 ? 'Понедельник' : 'Среда' ?></a></li>
                    <li><a href = "weekday_<?= $traningDay === 1 ? '2' : '4' ?>_group_2" class="trainerTabLink"><?= $traningDay === 1 ? 'Вторник' : 'Четверг' ?></a></li>
                    <li><a href = "weekday_<?= $traningDay === 1 ? '3' : '5' ?>_group_2" class="trainerTabLink"><?= $traningDay === 1 ? 'Среда' : 'Пятница' ?></a></li>
                </ul>
            </div>
        </div>
        <div class="schedule_content_treners">
            <div id="weekday_<?= $traningDay === 1 ? '1' : '3' ?>_group_1" class="schedule_content_trener timetableDayWrap active">
                <? $key = 1 ?>
                <? foreach ($timetableModels as $model) {?>
                    <? if ($model->weekday === ($traningDay === 1 ? 1 : 3) && $model->group === 1) {?>
                        <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                            <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                            <p class = "schedule_read"><?= $model->title ?></p>
                        </div>
                        <? ++$key ?>
                    <?}?>
                <?}?>
            </div>
            <div id="weekday_<?= $traningDay === 1 ? '2' : '4' ?>_group_1" class="schedule_content_trener timetableDayWrap">
                <? $key = 1 ?>
                <? foreach ($timetableModels as $model) {?>
                    <? if ($model->weekday === ($traningDay === 1 ? 2 : 4) && $model->group === 1) {?>
                        <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                            <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                            <p class = "schedule_read"><?= $model->title ?></p>
                        </div>
                        <? ++$key ?>
                    <?}?>
                <?}?>
            </div>
            <div id="weekday_<?= $traningDay === 1 ? '3' : '5' ?>_group_1" class="schedule_content_trener timetableDayWrap">
                <? $key = 1 ?>
                <? foreach ($timetableModels as $model) {?>
                    <? if ($model->weekday === ($traningDay === 1 ? 3 : 5) && $model->group === 1) {?>
                        <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                            <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                            <p class = "schedule_read"><?= $model->title ?></p>
                        </div>
                        <? ++$key ?>
                    <?}?>
                <?}?>
            </div>

            <div id="weekday_<?= $traningDay === 1 ? '1' : '3' ?>_group_2" class="schedule_content_trener timetableDayWrap">
                <? $key = 1 ?>
                <? foreach ($timetableModels as $model) {?>
                    <? if ($model->weekday === ($traningDay === 1 ? 1 : 3) && $model->group === 2) {?>
                        <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                            <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                            <p class = "schedule_read"><?= $model->title ?></p>
                        </div>
                        <? ++$key ?>
                    <?}?>
                <?}?>
            </div>
            <div id="weekday_<?= $traningDay === 1 ? '2' : '4' ?>_group_2" class="schedule_content_trener timetableDayWrap">
                <? $key = 1 ?>
                <? foreach ($timetableModels as $model) {?>
                    <? if ($model->weekday === ($traningDay === 1 ? 2 : 4) && $model->group === 2) {?>
                        <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                            <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                            <p class = "schedule_read"><?= $model->title ?></p>
                        </div>
                        <? ++$key ?>
                    <?}?>
                <?}?>
            </div>
            <div id="weekday_<?= $traningDay === 1 ? '3' : '5' ?>_group_2" class="schedule_content_trener timetableDayWrap">
                <? $key = 1 ?>
                <? foreach ($timetableModels as $model) {?>
                    <? if ($model->weekday === ($traningDay === 1 ? 3 : 5) && $model->group === 2) {?>
                        <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                            <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                            <p class = "schedule_read"><?= $model->title ?></p>
                        </div>
                        <? ++$key ?>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>

    <?= $this->render('_footer') ?>
</div> <!-- -->

<script>
    window.onload = function () {
        $('.trainerTabLink').on('click', function (event) {
            event.preventDefault();
            $('.trainerTabLink').removeClass('active');
            $(this).addClass('active');
            $('.timetableDayWrap').removeClass('active');
            $('#'+$(this).attr('href')).addClass('active');

        });
    }
</script>
