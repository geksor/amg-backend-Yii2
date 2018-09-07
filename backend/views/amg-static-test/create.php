<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AmgStaticTest */

$this->title = 'Создание теста';
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amg-static-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
