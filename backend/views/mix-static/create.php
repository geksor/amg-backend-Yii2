<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MixStatic */

$this->title = 'Создание альбома';
$this->params['breadcrumbs'][] = ['label' => 'MIX Статика', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mix-static-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
