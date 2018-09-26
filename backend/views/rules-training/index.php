<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model \common\models\RulesTraining */
/* @var $form ActiveForm */

$this->title = 'Правила и карта тренинга';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="pointTest-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box box-primary">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'rules')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    'height' => 400,
                    'resize_enabled' => true,
                ],
            ]) ?>
            <?= $form->field($model, 'map') ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- index -->
