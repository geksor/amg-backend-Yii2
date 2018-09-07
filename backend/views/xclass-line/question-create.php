<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\XClassLineQuestion */
/* @var $parentTitle */

$this->title = 'Создание задания';
$this->params['breadcrumbs'][] = ['label' => 'X-class линии исполнения тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $parentTitle, 'url' => ['view', 'id' => $model->xClass_line_test_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xClass-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_question-form', [
        'model' => $model,
    ]) ?>

</div>
