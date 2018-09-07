<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\MixStatic */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'MIX Статика', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mix-static-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Выбрать фото', ['set-photo', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'При удалении альбома будут удалены все вложенные элементы. Продолжить удаление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'format' => 'html',
                'label' => 'Изображение',
                'value' => function ($data)
                {
                    return Html::img($data->getThumbPhoto(), ['width' => 200]);
                },
            ],
//            'rank',
        ],
    ]) ?>

    <div class="box box-primary">
        <div class="box-body">
            <? if ($model->isNewRecord) {
                echo 'Нельзя загружать изображения до создания галлереи';
            } else {
                echo GalleryManager::widget(
                    [
                        'model' => $model,
                        'behaviorName' => 'galleryBehavior',
                        'apiRoute' => 'mix-static/galleryApi'
                    ]
                );
            }?>
        </div>
    </div>

</div>
