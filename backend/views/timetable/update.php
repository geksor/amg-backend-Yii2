<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */

$day = $model->weekday;
$group = $model->group;

$this->title = 'Редактирование записи: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => "Расписание на день $day группа № $model->group", 'url' => ['table', 'TimetableSearch' => ['weekday' => $day, 'group' => $group]]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="timetable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'day' => $day,
        'group' => $group,
    ]) ?>

</div>
