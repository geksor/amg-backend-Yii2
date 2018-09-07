<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MbuxQuestion */
/* @var $parentTitle */

$this->title = 'Создание вопроса';
$this->params['breadcrumbs'][] = ['label' => 'MBUX тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $parentTitle, 'url' => ['view', 'id' => $model->mbux_test_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbux-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_question-form', [
        'model' => $model,
    ]) ?>

</div>
