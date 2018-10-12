<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\models\PhotoReport */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Фотоотчет', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Выбрать видео', ['set-video', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить данную запись?',
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
                'attribute' => 'video',
                'format' => 'raw',
                'value' => function ($data){
                    /* @var $data \common\models\PhotoReport */
                    if ($data->isVideoLoad){
                        $poster = $data->video ? $data->getVideo().'.gif': $data->getVideo();
                        $mp4 = $data->video ? $data->getVideo().'.mp4':'';
                        $webm = $data->video ? $data->getVideo().'.webm':'';

                        $video = '<video controls width="400" height="auto" poster="'.$poster.'" preload="none">
                                <source src="'.$mp4.'" type="video/mp4">
                                <source src="'.$webm.'" type="video/webm">
                            </video>';
                        return $video;
                    }
                    return Html::img('/no_video.jpg', ['style' => 'max-width: 400px']);
                },
            ],
            'videoTitle:ntext'
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
                        'apiRoute' => 'photo-report/galleryApi'
                    ]
                );
            }?>
        </div>
    </div>

</div>
