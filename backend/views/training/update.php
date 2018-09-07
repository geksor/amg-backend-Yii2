<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Training */

$this->title = 'Редактирование тренинга от: ' . date('d.m.y', $model->date);
$this->params['breadcrumbs'][] = ['label' => 'Тренинги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => date('d.m.y', $model->date), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="training-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
