<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\XClassLineTest */

$this->title = 'Создание теста';
$this->params['breadcrumbs'][] = ['label' => 'X-class линии исполнения тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xclass-line-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
