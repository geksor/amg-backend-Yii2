<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $day */
/* @var $group */

$this->title = "Расписание на день $day группа № $group";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-table">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать запись', ['create', 'weekday' => $day, 'group' => $group], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    'startTime',
                    'stopTime',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
                "condensed" => true,
                "hover" => true,
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
