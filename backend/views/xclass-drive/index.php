<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\XClassDriveQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'X-Class Тест драйв';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xclass-drive-question-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать вопрос', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

        //            'id',
                    'title',
                    'question:ntext',
                    [
                        'format' => 'html',
                        'label' => 'Изображение',
                        'value' => function ($data)
                        {
                            /* @var $data \common\models\XClassDriveQuestion */
                            return Html::img($data->getThumbPhoto(), ['width' => 200]);
                        },
                    ],
        //            'description:ntext',
                    //'answer_var_1',
                    //'answer_var_2',
                    //'answer_var_3',
                    //'answer_var_4',
                    //'answer_isImage',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
                "condensed" => true,
                "hover" => true,
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
