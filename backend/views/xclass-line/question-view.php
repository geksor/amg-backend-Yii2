<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\XClassLineQuestion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'X-class линии исполнения тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->xClassLineTest->title, 'url' => ['view', 'id' => $model->xClass_line_test_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xclass-line-test-view">

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
            'leftColumn',
            'rightColumn',
        ],
    ]) ?>

    <h2>Картинки</h2>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <h3><?= $model->leftColumn ?></h3>
                    <? if ($model->answerCount < 3) {?>
                        <p>
                            <?= Html::a(
                                'Добавить фото',
                                [
                                    'answer-create',
                                    'parId' => $model->id,
                                    'parTitle' => $model->title,
                                    'testTitle' => $model->xClassLineTest->title,
                                    'testId' => $model->xClassLineTest->id,
                                    'column' => 1,
                                ],
                                ['class' => 'btn btn-success']) ?>
                        </p>
                    <?}?>
                    <? if ($model->xClassLineAnswers) {?>
                        <?foreach ($model->xClassLineAnswers as $answer) {?>
                            <? if ($answer->column) {?>
                                <div class="row" style="margin-bottom: 30px">
                                    <div class="col-xs-12" style="margin-bottom: 10px">
                                        <?= Html::a('Редактировать', ['set-photo', 'id' => $answer->id], ['class' => 'btn btn-primary']) ?>
                                        <?= Html::a('Удалить', ['answer-delete', 'id' => $answer->id], [
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => 'Вы уверены что хотите удалить запись?',
                                                'method' => 'post',
                                            ],
                                        ]) ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?= Html::img($answer->getPhotos()['thumb_image'], ['style' => 'max-width: 100%;']) ?>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <?= Html::a('&#9654;', ['change-column', 'id' => $answer->id, 'column' => 0], ['class' => 'btn btn-default']) ?>
                                    </div>
                                </div>
                            <?}?>
                        <?}?>
                    <?}?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h3><?= $model->rightColumn ?></h3>
                    <? if ($model->answerCount < 3) {?>
                    <p>
                        <?= Html::a(
                            'Добавить фото',
                            [
                                'answer-create',
                                'parId' => $model->id,
                                'parTitle' => $model->title,
                                'testTitle' => $model->xClassLineTest->title,
                                'testId' => $model->xClassLineTest->id,
                                'column' => 0,
                            ],
                            ['class' => 'btn btn-success']) ?>
                    </p>
                    <?}?>
                    <? if ($model->xClassLineAnswers) {?>
                        <?foreach ($model->xClassLineAnswers as $answer) {?>
                            <? if (!$answer->column) {?>
                                <div class="row" style="margin-bottom: 30px">
                                    <div class="col-xs-12" style="margin-bottom: 10px">
                                        <?= Html::a('Редактировать', ['set-photo', 'id' => $answer->id], ['class' => 'btn btn-primary']) ?>
                                        <?= Html::a('Удалить', ['answer-delete', 'id' => $answer->id], [
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => 'Вы уверены что хотите удалить запись?',
                                                'method' => 'post',
                                            ],
                                        ]) ?>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <?= Html::a('&#9664;', ['change-column', 'id' => $answer->id, 'column' => 1], ['class' => 'btn btn-default']) ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?= Html::img($answer->getPhotos()['thumb_image'], ['style' => 'max-width: 100%;']) ?>
                                    </div>
                                </div>
                            <?}?>
                        <?}?>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>
