<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "XClassDriveAnswerImage".
 *
 * @property int $id
 * @property string $image
 * @property int $user_id
 * @property int $question_id
 *
 * @property XClassDriveQuestion $question
 * @property User $user
 */
class XClassDriveAnswerImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'XClassDriveAnswerImage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'user_id', 'question_id'], 'required'],
            [['user_id', 'question_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => XClassDriveQuestion::className(), 'targetAttribute' => ['question_id' => 'id']],
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
            'image' => 'Image',
            'user_id' => 'User ID',
            'question_id' => 'Question ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(XClassDriveQuestion::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
