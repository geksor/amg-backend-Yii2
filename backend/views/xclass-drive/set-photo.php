<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ImageUpload */
/* @var $question \common\models\AmgStaticQuestion */
/* @var $image */

$this->title = "Выбор картинки: $image";
$this->params['breadcrumbs'][] = ['label' => 'X-Class Тест драйв', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $question->title, 'url' => ['view', 'id' => $question->id]];
$this->params['breadcrumbs'][] = 'Выбор картинки';
?>
<div class="xclassDrive-set-photo">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-photo', [
        'model' => $model,
    ]) ?>


</div>
