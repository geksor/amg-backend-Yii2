<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ImageUpload */
/* @var $question \common\models\MbuxQuestion */
/* @var $image */

$this->title = "Выбор картинки: $image";
$this->params['breadcrumbs'][] = ['label' => 'MBUX тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $question->mbuxTest->title, 'url' => ['view', 'id' => $question->mbux_test_id]];
$this->params['breadcrumbs'][] = ['label' => $question->title, 'url' => ['question-view', 'id' => $question->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbux-test-set-photo">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-photo', [
        'model' => $model,
    ]) ?>

</div>
