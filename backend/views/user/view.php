<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'surname',
            'first_name',
            'last_name',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
//            'status',
            'role',
            'created_at',
            'updated_at',
            'group',
//            'training_id',
            'dealer_center_id',
            'amgStatic',
            'mixStatic',
            'mbux',
            'xClassDrive',
            'amgDrive',
            'intelligent',
            'mixDrive',
            'xClassLine',
            'quiz',
            'moderatorPoints',
            'totalPoint',
//            'command_id',
        ],
    ]) ?>

</div>
