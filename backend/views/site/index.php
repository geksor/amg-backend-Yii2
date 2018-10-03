<?php

/* @var $this yii\web\View */
/* @var $trainingsArr */
/* @var $selectModel \backend\models\IntelligentSelectForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Intelligent drive';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box box-primary">
        <div class="box-body">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="body">
                <?php echo $form->field($selectModel, 'training_id')->dropDownList($trainingsArr, [ 'prompt' => 'Выберите один вариант', ]) ?>
            </div>
            <?php echo Html::submitButton('Далее', [
                'class' => 'btn btn-primary btn-flat btn-block',
                'name' => 'next-button'
            ]) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>

</div>
