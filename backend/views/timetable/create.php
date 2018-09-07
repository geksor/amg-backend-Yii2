<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $day */
/* @var $dayName */
/* @var $training */
/* @var $group */
/* @var $numberTraining */

$this->title = "Создание пункта расписания $dayName группа $group";
$this->params['breadcrumbs'][] = ['label' => "Тренинг $numberTraining Расписание на $dayName", 'url' => ['index', 'trainingDay' => $training, 'weekday' => $day,]];
$this->params['breadcrumbs'][] = ['label' => "Расписание на $dayName группа № $group", 'url' => ['table', 'TimetableSearch' => ['trainingDay' => $training, 'weekday' => $day, 'group' => $group]]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'day' => $day,
        'training' => $training,
        'group' => $group,
    ]) ?>

</div>
