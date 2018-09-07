<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yiister\adminlte\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\MbuxTest */
/* @var $searchModel common\models\MbuxQuestiontSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'MBUX тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbux-test-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'При удалении данной записи будут так же удалены и все дочерние элементы. Продолдить удаление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
        ],
    ]) ?>

    <h1>Вопросы теста</h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать вопрос', ['question-create', 'parId' => $model->id, 'parTitle' => $model->title], ['class' => 'btn btn-success']) ?>
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
                    'description',
                    [
                        'attribute' => 'image_1',
                        'format' => 'html',
                        'value' => function ($data) {
                        /* @var $data common\models\MbuxQuestion */
                            return Html::img($data->getPhotos()['thumb_image_1'], ['style' => 'max-width: 150px;']);
                        }
                    ],
                    [
                        'attribute' => 'image_2',
                        'format' => 'html',
                        'value' => function ($data) {
                        /* @var $data common\models\MbuxQuestion */
                            return Html::img($data->getPhotos()['thumb_image_2'], ['style' => 'max-width: 150px;']);
                        }
                    ],
//                    'mbux_test_id',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'view' => function($url, $model, $key){
                                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-eye-open"]);
                                return Html::a($icon, 'question-view/'.$key);
                            },
                            'update' => function($url, $model, $key){
                                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-pencil"]);
                                return Html::a($icon, 'question-update/'.$key);
                            },
                            'delete' => function($url, $model, $key){
                                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-trash"]);
                                return Html::a($icon, 'question-delete/'.$key);
                            },
                        ],
                    ],
                ],
                "condensed" => true,
                "hover" => true,
            ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
