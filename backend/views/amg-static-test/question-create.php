<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AmgStaticQuestion */
/* @var $testLink */

$this->title = 'Создание вопроса';
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $testLink;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['question-index', 'TimetableSearch' => ['amgStatic_test_id' => $model->amgStatic_test_id]]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amg-static-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_question-form', [
        'model' => $model,
    ]) ?>

</div>
