<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Training */

$this->title = 'Создание тренинга';
$this->params['breadcrumbs'][] = ['label' => 'Тренинги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
