<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Quiz */

$this->title = 'Создание вопроса';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы викторины', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
