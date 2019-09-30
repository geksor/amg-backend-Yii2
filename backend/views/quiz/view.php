<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */

$this->title = "Вопрос ID: $model->id";
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот вопрос?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($data){
                    /* @var $data \common\models\Quiz */
                    if ($data->getImageIsSet('image')){
                        return '<div class="row imageRow">'
                            .'<div class="col-xs-5 col-md-3 col-lg-1">'
                            .Html::img($data->getThumbImage('image'), ['style' => 'max-width: 100%;'])
                            .'</div>'
                            .'<div class="col-xs-3">'
                            .Html::a('Изменить', ['set-image', 'id' => $data->id], ['class' => 'btn btn-warning'])
                            .'</div>'
                            .'</div>';
                    }
                    return Html::a('Установить', ['set-image', 'id' => $data->id], ['class' => 'btn btn-success']);
                }
            ],
            'question',
            'answer_1',
            'answer_2',
            'answer_3',
            'answer_4',
            'isTrue_1',
            'isTrue_2',
            'isTrue_3',
            'isTrue_4',
        ],
    ]) ?>

</div>

<?php
$css= <<< CSS

.imageRow{
    display: flex;
    align-items: center;
}

CSS;

$this->registerCss($css, ["type" => "text/css"], "newsView" );
?>​