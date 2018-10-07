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
    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

    //            'id',
    //            'username',
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
                [
                    'label' => 'Дата тренинга',
                    'value' => function ($data){
                    /* @var $data \common\models\User */
                        if ($data->training_id){
                            return date('d.m.y', $data->training->date);
                        }
                        return null;
                    }
                ],
                'group',
                //'training_id',
                //'dealer_center_id',
                'amgStatic',
                'mixStatic',
                'mbux',
                'xClassDrive',
                'amgDrive',
                'intelligent',
                'mixDrive',
                'xClassLine',
                'quiz',
//                'moderatorPoints',
                'totalPoint',
                //'command_id',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            "condensed" => true,
            "hover" => true,
        ]); ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
