<?php
namespace backend\models;

use yii\base\Model;


/**
 * IntelligentSelect form
 *
 * @property int $training_id

 *
 */
class IntelligentSelectForm extends Model
{
    public $training_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['training_id', 'required'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'training_id' => 'Необходимо выбрать тренинг'
        ];
    }
}
