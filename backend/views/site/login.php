<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */
Yii::$app->controller->layout = 'empty';
$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">
    <div class="login-logo">
        <?php echo Html::encode($this->title) ?>
    </div><!-- /.login-logo -->
    <div class="header"></div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="body">
            <?php echo $form->field($model, 'username')->label('Имя пользователя') ?>
            <?php echo $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
            <?php echo $form->field($model, 'rememberMe')->checkbox(['class'=>'simple'])->label('Запомнить меня') ?>
        </div>
        <?php echo Html::submitButton('Войти', [
            'class' => 'btn btn-primary btn-flat btn-block',
            'name' => 'login-button'
        ]) ?>
        <?php ActiveForm::end() ?>
    </div>

</div>
