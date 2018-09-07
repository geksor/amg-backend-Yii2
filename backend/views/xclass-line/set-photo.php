<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ImageUpload */
/* @var $answer \common\models\XClassLineAnswer */
/* @var $image */

$this->title = "Выбор картинки";
$this->params['breadcrumbs'][] = ['label' => 'X-class линии исполнения тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $answer->xClassLineQuestion->xClassLineTest->title, 'url' => ['view', 'id' => $answer->xClassLineQuestion->xClass_line_test_id]];
$this->params['breadcrumbs'][] = ['label' => $answer->xClassLineQuestion->title, 'url' => ['question-view', 'id' => $answer->xClass_line_question_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xClass-answer-set-photo">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-photo', [
        'model' => $model,
    ]) ?>

</div>
