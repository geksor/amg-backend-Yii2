<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MbuxTest */

$this->title = 'Создание теста';
$this->params['breadcrumbs'][] = ['label' => 'MBUX тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbux-test-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
