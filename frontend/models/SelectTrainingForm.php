<?php
namespace frontend\models;

use common\models\XClassDriveQuestion;
use yii\base\Model;


/**
 * AmswerForm form
 *
 * @property int $training_id

 *
 */
class SelectTrainingForm extends Model
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
