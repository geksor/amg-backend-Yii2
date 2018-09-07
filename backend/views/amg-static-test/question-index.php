<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AmgStaticQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $testTitle */
/* @var $parentId */

$testLink = [
    'label' => $testTitle,
    'url' => [
        'view',
        'id' => $parentId
    ]
];

$this->title = "Вопросы к тесту";
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $testLink;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amg-static-test-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Вопрос', ['question-create', 'testLink' => $testLink], ['class' => 'btn btn-success']) ?>
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
                    'answerCount',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'view' => function($url, $model, $key){
                                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-eye-open"]);
                                return Html::a($icon, 'question-view/'.$key, ['data-pjax' => '0',]);
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
