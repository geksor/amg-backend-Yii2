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
/* @var $noAnswer bool */
/* @var $userAnswer integer || bool */

$this->title = 'ABS Авто Викторина';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Викторина',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <?php $form = ActiveForm::begin(['id' => 'quiz-form', 'options' => ['class' => 'x-class_content']]); ?>

    <? if ($noAnswer){$model->trueAnswer = null;} ?>

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
        ])->label("<p> $model->question </p>") ?>

    <?= Html::submitButton('Ответить', ['class' => 'submit', 'style' => !$noAnswer ? 'display:none': '']) ?>
    <?= Html::a('Далее', '/site/quiz', ['class' => 'submit', 'style' => $noAnswer ? 'display:none': '']) ?>

    <?php ActiveForm::end(); ?>

    <?= $this->render('_footer') ?>
</div>

<script>
    window.onload = function () {
        var userAnswer = <?= $userAnswer?$userAnswer:0 ?>;
        var noAnswer = <?= $noAnswer?$noAnswer:0 ?>;
        var truAnswer = <?= $model->trueAnswer?$model->trueAnswer:0 ?>;

        if (+noAnswer === 0){
            $('.quiz__answer').each(function () {
                $(this).css('color', '#d8d8d8');
                if (+$(this).find('input').val() === userAnswer){
                    $(this).css('color', 'red')
                }
                if (+$(this).find('input').val() === truAnswer){
                    $(this).css('color', 'green')
                }
            })
        }
    }
</script>


