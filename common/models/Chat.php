<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property string $message
 * @property int $create_at
 * @property int $user_id
 * @property int $training_id
 *
 * @property Training $training
 * @property User $user
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['create_at', 'user_id', 'training_id'], 'integer'],
            [['user_id', 'training_id'], 'required'],
            [['training_id'], 'exist', 'skipOnError' => true, 'targetClass' => Training::className(), 'targetAttribute' => ['training_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Сообщение',
            'create_at' => 'Дата создания',
            'user_id' => 'User ID',
            'training_id' => 'Training ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraining()
    {
        return $this->hasOne(Training::className(), ['id' => 'training_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
