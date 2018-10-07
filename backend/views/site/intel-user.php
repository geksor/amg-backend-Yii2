<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yiister\adminlte\widgets\grid\GridView;
use yii\helpers\Html;

$this->title = 'Intelligent drive Список пользователей';
$this->params['breadcrumbs'][] = ['label' => 'Intelligent drive', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-inel-user">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(
                'Выбрать',
                'intel-user-point',
                [
                    'class' => 'btn btn-primary',
                    'id' => 'buttonNext',
                ]) ?>
    </p>
    <div class="box box-primary">
        <div class="box-body">
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //            'id',
                //            'username',
                [
                    'attribute' => 'select',
                    'label'=>'Выбрать',
                    'format' => 'html',
                    'content' => function($model) {
                        /* @var $model \common\models\User */
                        return Html::checkbox('product', false, ['value'=>$model->id,'class'=>'userCheck']);
                    }
                ],

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
                'group',
                //'training_id',
                //'dealer_center_id',
    //            'amgStatic',
    //            'mixStatic',
    //            'mbux',
    //            'xClassDrive',
    //            'amgDrive',
    //            'intelligent',
    //            'mixDrive',
    //            'xClassLine',
    //            'quiz',
    //            'moderatorPoints',
                'totalPoint',
                //'command_id',

    //            ['class' => 'yii\grid\ActionColumn'],
            ],
            "condensed" => true,
            "hover" => true,
        ]); ?>
        </div>
    </div>

</div>

<script>
    window.onload = function () {
        var userCountForCheck = 6; //4 is temp need 6
        $('#buttonNext').on('click', function (ev) {
            ev.preventDefault();
            var arr = [];
            $('.userCheck').each(function () {
                if($(this).prop('checked')){
                    arr.push($(this).val());
                }
            });
            var params = {'checkUsers': arr};
            $(this).attr('data-params', JSON.stringify(params));
            $(this).attr('data-method', 'POST');
        });
    }
</script>

