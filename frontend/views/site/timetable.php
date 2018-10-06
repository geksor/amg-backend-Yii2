<?php

/* @var $this yii\web\View */
/* @var $timetableModels \common\models\Timetable */
/* @var $traningDay \frontend\controllers\SiteController */
/* @var $model \common\models\Timetable */

$this->title = 'MyNT2018 расписание';
?>
<div class="schedule">
    <?= $this->render('_top-line', [
        'title' => 'Расписание',
        'link' => Yii::$app->homeUrl,
    ]) ?>

    <ul class = "schedule_tab">
        <li><a href = "weekday_<?= $traningDay === 1 ? '1' : '3' ?>" class="tabLink active"><?= $traningDay === 1 ? 'Понедельник' : 'Среда' ?></a></li>
        <li><a href = "weekday_<?= $traningDay === 1 ? '2' : '4' ?>" class="tabLink"><?= $traningDay === 1 ? 'Вторник' : 'Четверг' ?></a></li>
        <li><a href = "weekday_<?= $traningDay === 1 ? '3' : '5' ?>" class="tabLink"><?= $traningDay === 1 ? 'Среда' : 'Пятница' ?></a></li>
    </ul>

    <div id="weekday_<?= $traningDay === 1 ? '1' : '3' ?>" class="timetableDayWrap active">
        <? $key = 1 ?>
        <? foreach ($timetableModels as $model) {?>
            <? if ($model->weekday === ($traningDay === 1 ? 1 : 3)) {?>
                <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                    <?= \yii\helpers\Html::a('', ['/site/timetable-info', 'id' => $model->id]) ?>
                    <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                    <p class = "schedule_read"><?= $model->title ?></p>
                </div>
                <? ++$key ?>
            <?}?>
        <?}?>
    </div>

    <div id="weekday_<?= $traningDay === 1 ? '2' : '4' ?>" class="timetableDayWrap">
        <? $key = 1 ?>
        <? foreach ($timetableModels as $model) {?>
            <? if ($model->weekday === ($traningDay === 1 ? 2 : 4)) {?>
                <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                    <?= \yii\helpers\Html::a('', ['/site/timetable-info', 'id' => $model->id]) ?>
                    <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                    <p class = "schedule_read"><?= $model->title ?></p>
                </div>
                <? ++$key ?>
            <?}?>
        <?}?>
    </div>

    <div id="weekday_<?= $traningDay === 1 ? '3' : '5' ?>" class="timetableDayWrap">
        <? $key = 1 ?>
        <? foreach ($timetableModels as $model) {?>
            <? if ($model->weekday === ($traningDay === 1 ? 3 : 5)) {?>
                <div class = "schedule_content<?= $key%2 !== 0 ? ' schedule_content_1' : '' ?>">
                    <?= \yii\helpers\Html::a('', ['/site/timetable-info', 'id' => $model->id]) ?>
                    <p class = "schedule_data"><?= $model->startTime ?> - <?= $model->stopTime ?></p>
                    <p class = "schedule_read"><?= $model->title ?></p>
                </div>
                <? ++$key ?>
            <?}?>
        <?}?>
    </div>

    <?= $this->render('_footer') ?>

</div>
