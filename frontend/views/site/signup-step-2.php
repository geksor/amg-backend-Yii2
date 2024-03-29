<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupFormStep2 */
/* @var $trainingsArr */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';

?>
    <div class = "registration site-signup-step-2">
        <?= $this->render('_top-line-signup', [
            'title' => $this->title,
            'imageName' => 'step_2.svg',

        ]) ?>

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form_step_1']]); ?>

        <?= $form->field($model, 'training_id')->dropDownList($trainingsArr, [ 'class' => 'user calendar', 'prompt' => 'Выберите один вариант', ]) ?>

        <?= $form->field($model, 'group')->radioList([
                '1' => '1',
                '2' => '2',
        ], ['class' => 'step_2_group']) ?>

        <p>
            <span>*</span> Номер группы указан на вашем бейдже
        </p>

        <div class="button_next_back">
<!--            --><?//= Html::a('<img src = "/public/images/left-arrow.svg">Назад', '/', ['class' => 'button_back'] ) ?>
            <?= Html::submitButton('Далее<img src = "/public/images/right-arrow.svg">', ['class' => 'button_next', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div> <!-- -->

<script>
    window.onload = function () {
        $('.step_2_group .radio').on('click', function () {
            $('.step_2_group .radio').removeClass('active');
            $(this).addClass('active')
        })
    }
</script>
