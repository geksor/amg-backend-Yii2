<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\Quiz */

$this->title = 'ABS Авто Викторина';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Викторина',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <?php $form = ActiveForm::begin(['id' => 'quiz-form', 'options' => ['class' => 'x-class_content']]); ?>

    <? $model->trueAnswer = null ?>

    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'trueAnswer')->radioList([
            '1' => $model->answer_1,
            '2' => $model->answer_2,
            '3' => $model->answer_3,
            '4' => $model->answer_4,
        ],
        [
            'itemOptions' => [
                    'labelOptions' => [
                            'class' => 'container quiz__answer'
                    ]
            ]
        ])->label("<p> <span>Вопрос:</span> $model->question </p>") ?>

    <?= Html::submitButton('Оветить', ['class' => 'submit']) ?>

    <?php ActiveForm::end(); ?>

    <?= $this->render('_footer') ?>
</div>


