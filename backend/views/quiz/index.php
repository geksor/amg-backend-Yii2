<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\QuizTestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Вопросы викторины';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-index">

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

//                'id',
                'question',
//                'answer_1',
//                'answer_2',
//                'answer_3',
                //'answer_4',
                //'trueAnswer',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            "condensed" => true,
            "hover" => true,
        ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
