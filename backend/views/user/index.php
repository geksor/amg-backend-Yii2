<?php

use yii\helpers\Html;
use yiister\adminlte\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

    //            'id',
                'username',
                'surname',
                'first_name',
                'last_name',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                //'email:email',
                //'status',
                //'role',
                //'created_at',
                //'updated_at',
                //'group',
                //'training_id',
                //'dealer_center_id',
                //'command_id',
                //'amgStatic',
                //'mixStatic',
                //'mbux',
                //'xClassDrive',
                //'amgDrive',
                //'intelligent',
                //'mixDrive',
                //'xClassLine',
                //'quiz',
                //'moderatorPoints',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            "condensed" => true,
            "hover" => true,
        ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
