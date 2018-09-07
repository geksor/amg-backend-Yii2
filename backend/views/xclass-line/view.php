<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yiister\adminlte\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\XClassLineTest */
/* @var $searchModel common\models\XClassLineQuestionTestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'X-class линии исполнения тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xclass-line-test-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'При удалении записи будут удалены все дочерние элементы. Продолжить удаление?',
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

    <h2>Задания</h2>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить задание', ['question-create', 'parId' => $model->id, 'parTitle' => $model->title], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'title',
                    'leftColumn',
                    'rightColumn',
                    'answerCount',
                    //'xClass_line_test_id',

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
