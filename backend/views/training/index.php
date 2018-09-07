<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DealerCenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тренинги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать тренинг', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    [
                        'attribute' => 'date',
                        'format' => ['date', 'php:d.m.Y'],
                    ],
                    [
                        'label' => 'День недели',
                        'value' => function ($data){
                            $weekday = (integer) date('w', $data->date);
                            if ($weekday === 1){
                                $weekday = 'Понедельник';
                            }
                            if ($weekday === 3){
                                $weekday = 'Среда';
                            }
                            return $weekday;
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
                "condensed" => true,
                "hover" => true,
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>




