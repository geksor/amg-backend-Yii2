<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MbuxQuestion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'MBUX тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mbuxTest->title, 'url' => ['view', 'id' => $model->mbux_test_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mbux-test-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['question-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Выбрать картинку 1', ['set-photo', 'id' => $model->id, 'image' => 1], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Выбрать картинку 2', ['set-photo', 'id' => $model->id, 'image' => 2], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['question-delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'При удалении данной записи будут так же удалены и все дочерние элементы. Продолдить удаление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            [
                'attribute' => 'image_1',
                'format' => 'html',
                'value' => Html::img($model->getPhotos()['thumb_image_1'], ['style' => 'max-width: 200px;'])
            ],
            [
                'attribute' => 'image_2',
                'format' => 'html',
                'value' => Html::img($model->getPhotos()['thumb_image_2'], ['style' => 'max-width: 200px;'])
            ],
        ],
    ]) ?>
</div>
