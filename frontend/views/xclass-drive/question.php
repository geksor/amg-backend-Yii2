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
/* @var $userModel \common\models\User */
/* @var $commandModel \common\models\Command */
/* @var $questionModel \common\models\XClassDriveQuestion */
/* @var $answerForm \frontend\models\XclassDriveAnswerForm */
/* @var $answerImageForm \frontend\models\XclassAnswerImage */
/* @var $captain \common\models\User */

$captain = $commandModel->captain;
$this->title = 'ABS Авто Список членов команды';
?>

<div class = "info">
    <?= $this->render('_top-line', [
        'title' => 'Список членов команды',
        'link' => Yii::$app->homeUrl,
    ]) ?>

    <div class="x-class_content">
        <div class = "mix_ul_p">
            <p><?= $questionModel->title ?></p>
            <p><?= $questionModel->question ?></p>
        </div>
        <img src = "<?= $questionModel->getThumbPhoto() ?>" class = "mix_img">

        <? if ($questionModel->answer_isImage) {?>

            <?php $form = ActiveForm::begin(['id' => 'form-answer', 'options' => ['class' => 'form_step_x']]); ?>

                <?= $form->field($answerImageForm, 'question_id')->hiddenInput()->label(false) ?>

                <?= $form->field($answerImageForm, 'image')->fileInput(['class' => 'user', 'placeholder' => 'Введите правильный ответ'])->label(false) ?>

                <div class="button_next_back">

                    <a class="button_help">Подсказка</a>

                    <?= Html::submitButton('Далее<img src = "/public/images/right-arrow.svg">', ['class' => 'button_next', 'name' => 'signup-button']) ?>

                </div>

            <?php ActiveForm::end(); ?>

        <?}else{?>

            <?php $form = ActiveForm::begin(['id' => 'form-answer', 'options' => ['class' => 'form_step_x']]); ?>

                <?= $form->field($answerForm, 'question_id')->hiddenInput()->label(false) ?>

                <?= $form->field($answerForm, 'answer')->textInput(['class' => 'user', 'placeholder' => 'Введите правильный ответ'])->label(false) ?>

                <div class="button_next_back">

                    <a class="button_help">Подсказка</a>

                    <?= Html::submitButton('Далее<img src = "/public/images/right-arrow.svg">', ['class' => 'button_next', 'name' => 'signup-button']) ?>

                </div>

            <?php ActiveForm::end(); ?>

        <?}?>

    </div>

    <?= $this->render('_footer') ?>
</div>

<? if (Yii::$app->session->hasFlash('trueAnswer')) {?>
    <div class="popupWrap">
        <div class="popup">

            <p class = "popup_p">Координаты следующей точки<br><?= Yii::$app->session->getFlash('trueAnswer') ?></p>

            <?= \yii\helpers\Html::a('Перейти к следующему вопросу', '/xclass-drive/question', ['class' => 'submit']) ?>
        </div>
    </div>
<?}?>

<div id="questHelp" class="popupWrap" style="display: none">
    <div class="popup">
        <p>Подсказка</p>

        <p class = "popup_p"><?= $questionModel->description ?></p>

        <?= \yii\helpers\Html::button('ОК', ['class' => 'submit', 'id' => 'closeHelp']) ?>
    </div>
</div>


<script>
    window.onload = function () {
        $('.button_help').on('click', function () {
            $('#questHelp').show();
        });
        $('#closeHelp').on('click', function () {
            $('#questHelp').hide();
        })
    }
</script>



