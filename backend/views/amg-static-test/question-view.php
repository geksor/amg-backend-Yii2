<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AmgStaticQuestion */
/* @var $searchModel common\models\AmgStaticAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $image_1 \common\models\AmgStaticAnswer*/
/* @var $image_2 \common\models\AmgStaticAnswer*/
/* @var $image_3 \common\models\AmgStaticAnswer*/

$testLink = [
    'label' => $model->amgStaticTest->title,
    'url' => [
        'view',
        'id' => $model->amgStatic_test_id
    ]
];

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'AMG Статика тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $testLink;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['question-index', 'TimetableSearch' => ['amgStatic_test_id' => $model->amgStatic_test_id], 'testTitle' => $model->amgStaticTest->title, 'parId' => $model->amgStatic_test_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amg-static-question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['question-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['question-delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'При удалении записи будут удалены все дочерние элементы. Продолжить удаление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
        ],
    ]) ?>

    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <h2>Картинка 1</h2>
                    <?= Html::a('Выбрать картинку', ['set-photo', 'id' => $model->id, 'image' => 1], ['class' => 'btn btn-primary']) ?>
                    <br>
                    <br>
                    <?= Html::img($model->getPhotos()['thumb_image_1'], ['style' => 'max-height: 210px;']) ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h2>Ответ 1</h2>
                    <p>
                        <? if (!$image_1) {?>
                            <?= Html::a(
                                'Создать ответ',
                                [
                                    'answer-create',
                                    'testLink' => $testLink,
                                    'parId' => $model->id,
                                    'parTitle' => $model->title,
                                    'image' => 1,
                                ],
                                ['class' => 'btn btn-success']) ?>
                        <?}else{?>
                            <?= Html::a(
                                'Редактировать ответ',
                                [
                                    'answer-update',
                                    'id' => $image_1->id,
                                ],
                                ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(
                                'Удалить ответ',
                                [
                                    'answer-delete',
                                    'id' => $image_1->id,
                                ],
                                [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены что хотите удалить запись?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                        <?}?>
                    </p>
                    <br>
                    <br>
                    <h3><?= $image_1 ? $image_1->title : '' ?></h3>
                    <h4><?= $image_1 ? 'Сортировка: ' : '' ?><?= $image_2 ? $image_2->rank : '' ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <h2>Картинка 2</h2>
                    <?= Html::a('Выбрать картинку', ['set-photo', 'id' => $model->id, 'image' => 2], ['class' => 'btn btn-primary']) ?>
                    <br>
                    <br>
                    <?= Html::img($model->getPhotos()['thumb_image_2'], ['style' => 'max-height: 210px;']) ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h2>Ответ 2</h2>
                    <p>
                        <? if (!$image_2) {?>
                            <?= Html::a(
                                'Создать ответ',
                                [
                                    'answer-create',
                                    'testLink' => $testLink,
                                    'parId' => $model->id,
                                    'parTitle' => $model->title,
                                    'image' => 2,
                                ],
                                ['class' => 'btn btn-success']) ?>
                        <?}else{?>
                            <?= Html::a(
                                'Редактировать ответ',
                                [
                                    'answer-update',
                                    'id' => $image_2->id,
                                ],
                                ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(
                                'Удалить ответ',
                                [
                                    'answer-delete',
                                    'id' => $image_2->id,
                                ],
                                [
                                'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены что хотите удалить запись?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                        <?}?>
                    </p>
                    <br>
                    <br>
                    <h3><?= $image_2 ? $image_2->title : '' ?></h3>
                    <h4><?= $image_2 ? 'Сортировка: ' : '' ?><?= $image_2 ? $image_2->rank : '' ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <h2>Картинка 3</h2>
                    <?= Html::a('Выбрать картинку', ['set-photo', 'id' => $model->id, 'image' => 3], ['class' => 'btn btn-primary']) ?>
                    <br>
                    <br>
                    <?= Html::img($model->getPhotos()['thumb_image_3'], ['style' => 'max-height: 210px;']) ?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h2>Ответ 3</h2>
                    <p>
                        <? if (!$image_3) {?>
                            <?= Html::a(
                                'Создать ответ',
                                [
                                    'answer-create',
                                    'testLink' => $testLink,
                                    'parId' => $model->id,
                                    'parTitle' => $model->title,
                                    'image' => 3,
                                ],
                                ['class' => 'btn btn-success']) ?>
                        <?}else{?>
                            <?= Html::a(
                                'Редактировать ответ',
                                [
                                    'answer-update',
                                    'id' => $image_3->id,
                                ],
                                ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(
                                'Удалить ответ',
                                [
                                    'answer-delete',
                                    'id' => $image_3->id,
                                ],
                                [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Вы уверены что хотите удалить запись?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                        <?}?>
                    </p>
                    <br>
                    <br>
                    <h3><?= $image_3 ? $image_3->title : '' ?></h3>
                    <h4><?= $image_3 ? 'Сортировка: ' : '' ?><?= $image_3 ? $image_3->rank : '' ?></h4>
                </div>
            </div>
        </div>
    </div>

</div>
