<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \frontend\models\ImageUpload */

$this->title = 'MyNT2018 MIX Тест-Драйв';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'MIX Тест-Драйв',
        'link' => Yii::$app->homeUrl,
    ]) ?>
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data', 'class' => 'x-class_content'],
    ]); ?>

    <?= $form->field($model, 'image')->fileInput(['class' => 'jsImageInput', 'style' => 'display:none'])->label('<img id="insertImage" src = "/public/images/noimage.svg" class = "mix_img">'); ?>

    <p class="mix_ul_p"></p>


    <?= Html::submitButton('Отправить фотограйию', ['class' => 'submit']) ?>

    <?php ActiveForm::end(); ?>

    <?= $this->render('_footer') ?>
</div>


