<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\PointTest */
/* @var $form ActiveForm */

$this->title = 'Очки за тесты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pointTest-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box box-primary">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'amgStatic') ?>
            <?= $form->field($model, 'mixStatic') ?>
            <?= $form->field($model, 'mbux') ?>
            <?= $form->field($model, 'xClassDrive') ?>
            <?= $form->field($model, 'amgDrive') ?>
            <?= $form->field($model, 'intelligent') ?>
            <?= $form->field($model, 'mixDrive') ?>
            <?= $form->field($model, 'xClassLine') ?>
            <?= $form->field($model, 'quizItem') ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- index -->
