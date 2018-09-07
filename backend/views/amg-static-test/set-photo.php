<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ImageUpload */
/* @var $question \common\models\AmgStaticQuestion */
/* @var $image */

$this->title = "Выбор картинки: $image";
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $question->amgStaticTest->title, 'url' => ['view', 'id' => $question->amgStatic_test_id]];
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['question-index', 'TimetableSearch' => ['amgStatic_test_id' => $question->amgStatic_test_id], 'testTitle' => $question->amgStaticTest->title, 'parId' => $question->amgStatic_test_id]];
$this->params['breadcrumbs'][] = ['label' => $question->title, 'url' => ['question-view', 'id' => $question->id]];
$this->params['breadcrumbs'][] = 'Выбор картинки';
?>
<div class="amg-static-set-photo">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-photo', [
        'model' => $model,
    ]) ?>


</div>
