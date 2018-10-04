<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "runDrive".
 *
 * @property int $id
 * @property int $training_id
 * @property int $group
 */
class RunDrive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'runDrive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['training_id', 'group'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'training_id' => 'Training ID',
            'group' => 'Group',
        ];
    }
}
