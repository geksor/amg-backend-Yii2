<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $intelPointForm \backend\models\IntelligentUserPointForm */

use yii\widgets\ActiveForm;
use yiister\adminlte\widgets\grid\GridView;
use yii\helpers\Html;

$this->title = 'Intelligent drive Начисление балов';
$this->params['breadcrumbs'][] = ['label' => 'Intelligent drive', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Intelligent drive Список пользователей', 'url' => Yii::$app->request->referrer];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-inel-user">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'surname',
                'first_name',
                'last_name',
            ],
            "condensed" => true,
            "hover" => true,
        ]); ?>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?php echo $form->field($intelPointForm, 'usersId')->hiddenInput()->label(false) ?>
            <?php echo $form->field($intelPointForm, 'point')->input('number') ?>

            <?php echo Html::submitButton('Начислить', [
                'class' => 'btn btn-primary btn-flat btn-block',
                'name' => 'submit-button'
            ]) ?>

            <?php ActiveForm::end() ?>

        </div>
    </div>

</div>

