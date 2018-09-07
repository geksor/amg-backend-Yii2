<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */

$this->title = 'Редактирование вопроса ID: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quizzes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Вопрос ID : $model->id", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="quiz-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
