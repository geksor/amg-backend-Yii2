<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $day */
/* @var $dayName */
/* @var $training */
/* @var $numberTraining */

$this->title = "Тренинг $numberTraining Расписание на $dayName";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Первая группа', ['table', 'TimetableSearch' => ['trainingDay' => $training, 'weekday' => $day, 'group' => 1]], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Вторая группа', ['table', 'TimetableSearch' => ['trainingDay' => $training, 'weekday' => $day, 'group' => 2]], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
