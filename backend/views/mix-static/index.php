<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\MixStaticSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'MIX Статика';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mix-static-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать альбом', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'title',
                    [
                        'format' => 'html',
                        'label' => 'Изображение',
                        'value' => function ($data)
                        {
                            return Html::img($data->getThumbPhoto(), ['width' => 100]);
                        },
                    ],
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'headerOptions' => ['width' => 50],
                        'value' => function ($data){
                            $intDown = $data->rank > 1 ? 1 : 0;
                            $up = Html::a(
                                '&#9650;',
                                [
                                    'order',
                                    'id' => $data->id,
                                    'order' => $data->rank - $intDown,
                                    'up' => true,
                                ],
                                ['class'=>'btn btn-default']);

                            $down = Html::a(
                                '&#9660;',
                                [
                                    'order',
                                    'id' => $data->id,
                                    'order' => $data->rank + 1,
                                    'up' => false,
                                ],
                                ['class'=>'btn btn-default']);

                            return $up.$down;
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
