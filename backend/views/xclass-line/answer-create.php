<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\XClassLineAnswer */
/* @var $parentTitle */
/* @var $testTitle */
/* @var $testId */

$this->title = 'Добавление картинки';
$this->params['breadcrumbs'][] = ['label' => 'X-class линии исполнения тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $testTitle, 'url' => ['view', 'id' => $testId]];
$this->params['breadcrumbs'][] = ['label' => $parentTitle, 'url' => ['question-view', 'id' => $model->xClass_line_question_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xClass-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_answer-form', [
        'model' => $model,
    ]) ?>

</div>
