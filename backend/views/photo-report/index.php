<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PhotoReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фотоотчет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать фотоотчет', ['create'], ['class' => 'btn btn-success']) ?>
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
                [
                    'attribute' => 'video',
                    'format' => 'raw',
                    'value' => /**
                     * @param $data
                     * @return string
                     */
                        function ($data){
                        /* @var $data \common\models\PhotoReport */
                        $poster = $data->video ? $data->getVideo().'.gif': $data->getVideo();

                        return Html::img($poster, ['style' => 'max-width: 200px']);
                    },
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
