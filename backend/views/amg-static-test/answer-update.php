<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AmgStaticAnswer */

$this->title = 'Редактирование ответа: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->amgStaticQuestion->amgStaticTest->title, 'url' => ['view', 'id' => $model->amgStaticQuestion->amgStatic_test_id]];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['question-index', 'TimetableSearch' => ['amgStatic_test_id' => $model->amgStaticQuestion->amgStatic_test_id]]];
$this->params['breadcrumbs'][] = ['label' => $model->amgStaticQuestion->title, 'url' => ['question-view', 'id' => $model->amgStaticQuestion->id]];
$this->params['breadcrumbs'][] = 'Редактирование ответа';
?>
<div class="amg-static-test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_answer-form', [
        'model' => $model,
    ]) ?>

</div>
