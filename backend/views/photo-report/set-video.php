<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\VideoUpload */
/* @var $gallery \common\models\PhotoReport */

$this->title = 'Выбор видео: ' . $gallery->title;
$this->params['breadcrumbs'][] = ['label' => 'Фотоотчет', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $gallery->title, 'url' => ['view', 'id' => $gallery->id]];
$this->params['breadcrumbs'][] = 'Выбор видео';
?>
<div class="photo-report-set-video">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-video', [
        'model' => $model,
        'message' => false,
        'id' => $gallery->id,
    ]) ?>


</div>
