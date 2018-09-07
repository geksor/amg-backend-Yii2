<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Training */

$this->title = 'Тренинг от: ' . date('d.m.y', $model->date);
$this->params['breadcrumbs'][] = ['label' => 'Тренинги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'label' => 'День недели',
                'value' => function ($data){
                    $weekday = (integer) date('w', $data->date);
                    if ($weekday === 1){
                        $weekday = 'Понедельник';
                    }
                    if ($weekday === 3){
                        $weekday = 'Среда';
                    }
                    return $weekday;
                }
            ],
        ],
    ]) ?>

</div>
