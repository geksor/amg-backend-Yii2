<?php

use common\models\PointTest;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model PointTest */
/* @var $form ActiveForm */

$this->title = 'Настройки тестов';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pointTest-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box box-primary">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>

            <h2>Тесты с загрузкой фото</h2>
            <?= $form->field($model, 'amgDrive') ?>
            <?= $form->field($model, 'mfaDrive') ?>
            <?= $form->field($model, 'eqDrive') ?>

            <h2>Викторина</h2>
            <?= $form->field($model, 'quizItem') ?>
            <?= $form->field($model, 'quizItemTime') ?>

            <h2>Битва умов</h2>
            <?= $form->field($model, 'brainsBattleFirstRound') ?>
            <?= $form->field($model, 'brainsBattleWin') ?>
            <?= $form->field($model, 'brainsBattleDrawn') ?>
            <?= $form->field($model, 'brainsBattleMaxPoints') ?>
            <?= $form->field($model, 'brainsBattleItemTime') ?>

            <h2>Suv Challenge</h2>
            <?= $form->field($model, 'suvChallenge') ?>
            <?= $form->field($model, 'suvChallengeItem') ?>
            <?= $form->field($model, 'suvChallengeItemTime') ?>

            <h2>Race</h2>
            <?= $form->field($model, 'racePlace_1') ?>
            <?= $form->field($model, 'racePlace_2') ?>
            <?= $form->field($model, 'racePlace_3') ?>
            <?= $form->field($model, 'raceItemTime') ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- index -->
