<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\XClassDriveQuestion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'X-Class Тест драйв', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="xclass-drive-question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Выбрать картинку', ['set-photo', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'question:ntext',
            [
                'format' => 'html',
                'label' => 'Изображение',
                'value' => function ($data)
                {
                    /* @var $data \common\models\XClassDriveQuestion */
                    return Html::img($data->getThumbPhoto(), ['width' => 200]);
                },
            ],
            'description:ntext',
            'answer_var_1',
            'answer_var_2',
            'answer_var_3',
            'answer_var_4',
            'answer_var_5',
            'answer_var_6',
            [
                'format' => 'ntext',
                'label' => 'Ответ в виде фото',
                'value' => function ($data)
                {
                    /* @var $data \common\models\XClassDriveQuestion */
                    return $data->answer_isImage ? 'да' : 'Нет';
                },
            ],

        ],
    ]) ?>

</div>
