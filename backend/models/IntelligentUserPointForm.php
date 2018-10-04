<?php
namespace backend\models;

use yii\base\Model;


/**
 * IntelligentPoint form
 *
 * @property string $usersId
 * @property int $point

 *
 */
class IntelligentUserPointForm extends Model
{
    public $usersId;
    public $point;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['point', 'required'],
            ['usersId', 'safe'],
            ['point', 'number', 'max' => \Yii::$app->params['PointTest']['intelligent']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'point' => 'Укажите количетво очков'
        ];
    }
}
