<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $dayName */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => "Тренинг $model->trainingDay Расписание на $dayName", 'url' => ['index', 'trainingDay' => $model->trainingDay, 'weekday' => $model->weekday,]];
$this->params['breadcrumbs'][] = ['label' => "Расписание на $dayName группа № $model->group", 'url' => ['table', 'TimetableSearch' => ['trainingDay' => $model->trainingDay, 'weekday' => $model->weekday, 'group' => $model->group]]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'startTime',
            'stopTime',
            [
                'attribute' => 'weekday',
                'value' => $dayName,
            ],
            'trainingDay',
            'group',
        ],
    ]) ?>
</div>
