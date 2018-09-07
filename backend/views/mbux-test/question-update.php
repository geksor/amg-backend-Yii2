<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MbuxQuestion */

$this->title = 'Редактирование: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'MBUX тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mbuxTest->title, 'url' => ['view', 'id' => $model->mbux_test_id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['question-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="mbux-question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_question-form', [
        'model' => $model,
    ]) ?>

</div>
