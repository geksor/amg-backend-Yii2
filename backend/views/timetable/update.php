<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $dayName */

$day = $model->weekday;
$training = $model->trainingDay;
$group = $model->group;

$this->title = 'Редактирование записи: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => "Тренинг $model->trainingDay Расписание на $dayName", 'url' => ['index', 'trainingDay' => $model->trainingDay, 'weekday' => $model->weekday,]];
$this->params['breadcrumbs'][] = ['label' => "Расписание на $dayName группа № $model->group", 'url' => ['table', 'TimetableSearch' => ['trainingDay' => $model->trainingDay, 'weekday' => $model->weekday, 'group' => $model->group]]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="timetable-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'day' => $day,
        'training' => $training,
        'group' => $group,
    ]) ?>

</div>
