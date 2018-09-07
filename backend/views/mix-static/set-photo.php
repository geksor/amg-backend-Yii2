<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ImageUpload */
/* @var $gallery \common\models\MixStatic */

$this->title = 'Выбор фото: ' . $gallery->title;
$this->params['breadcrumbs'][] = ['label' => 'Специалисты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $gallery->title, 'url' => ['view', 'id' => $gallery->id]];
$this->params['breadcrumbs'][] = 'Выбор фото';
?>
<div class="mix-static-set-photo">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-photo', [
        'model' => $model,
    ]) ?>


</div>
