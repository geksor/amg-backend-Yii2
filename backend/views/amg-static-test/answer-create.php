<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AmgStaticAnswer */
/* @var $testLink */
/* @var $parTitle */

$this->title = 'Создание ответа';
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $testLink;
$this->params['breadcrumbs'][] = [
    'label' => 'Вопросы',
    'url' => [
        'question-index',
        'TimetableSearch' => [
            'amgStatic_test_id' => $testLink['url']['id']
        ],
        'testTitle' => $testLink['label'],
        'parId' => $testLink['url']['id'],
    ]
];
$this->params['breadcrumbs'][] = ['label' => $parTitle, 'url' => ['question-view', 'id' => $model->amgStatic_question_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amg-static-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_answer-form', [
        'model' => $model,
    ]) ?>

</div>
