<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PhotoReport */

$this->title = 'Создание фотоотчета';
$this->params['breadcrumbs'][] = ['label' => 'Фотоотчет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
