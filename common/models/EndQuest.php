<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "endQuest".
 *
 * @property int $id
 * @property int $user_id
 * @property int $xClassDrive
 * @property int $mixStatic
 * @property int $amgStatic
 * @property int $mbux
 * @property int $amgDrive
 * @property int $mixDrive
 * @property int $xClassLine
 * @property int $quiz
 *
 * @property User $user
 */
class EndQuest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'endQuest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'xClassDrive', 'mixStatic', 'amgStatic', 'mbux', 'amgDrive', 'mixDrive', 'xClassLine', 'quiz'], 'integer'],
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
            'user_id' => 'User ID',
            'xClassDrive' => 'X Class Drive',
            'mixStatic' => 'Mix Static',
            'amgStatic' => 'Amg Static',
            'mbux' => 'Mbux',
            'amgDrive' => 'Amg Drive',
            'mixDrive' => 'Mix Drive',
            'xClassLine' => 'X Class Line',
            'quiz' => 'Quiz',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
