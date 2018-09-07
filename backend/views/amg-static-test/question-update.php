<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AmgStaticQuestion */

$this->title = 'Редактирование вопроса: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->amgStaticTest->title, 'url' => ['view', 'id' => $model->amgStatic_test_id]];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['question-index', 'TimetableSearch' => ['amgStatic_test_id' => $model->amgStatic_test_id]]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['question-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование вопроса';
?>
<div class="amg-static-test-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
