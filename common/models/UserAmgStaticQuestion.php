<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_amgStatic_question".
 *
 * @property int $user_id
 * @property int $amgStatic_question_id
 *
 * @property AmgStaticQuestion $amgStaticQuestion
 * @property User $user
 */
class UserAmgStaticQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_amgStatic_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amgStatic_question_id'], 'required'],
            [['user_id', 'amgStatic_question_id'], 'integer'],
            [['user_id', 'amgStatic_question_id'], 'unique', 'targetAttribute' => ['user_id', 'amgStatic_question_id']],
            [['amgStatic_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmgStaticQuestion::className(), 'targetAttribute' => ['amgStatic_question_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'amgStatic_question_id' => 'Amg Static Question ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmgStaticQuestion()
    {
        return $this->hasOne(AmgStaticQuestion::className(), ['id' => 'amgStatic_question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
