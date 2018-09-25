<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_xClass_line_question".
 *
 * @property int $user_id
 * @property int $xClass_line_question_id
 *
 * @property User $user
 * @property XClassLineQuestion $xClassLineQuestion
 */
class UserXClassLineQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_xClass_line_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'xClass_line_question_id'], 'required'],
            [['user_id', 'xClass_line_question_id'], 'integer'],
            [['user_id', 'xClass_line_question_id'], 'unique', 'targetAttribute' => ['user_id', 'xClass_line_question_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['xClass_line_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => XClassLineQuestion::className(), 'targetAttribute' => ['xClass_line_question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'xClass_line_question_id' => 'X Class Line Question ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassLineQuestion()
    {
        return $this->hasOne(XClassLineQuestion::className(), ['id' => 'xClass_line_question_id']);
    }
}
