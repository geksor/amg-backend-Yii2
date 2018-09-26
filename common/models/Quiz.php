<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quiz".
 *
 * @property int $id
 * @property string $question
 * @property string $answer_1
 * @property string $answer_2
 * @property string $answer_3
 * @property string $answer_4
 * @property int $trueAnswer
 *
 * @property UserQuiz[] $userQuizzes
 * @property User[] $users
 */
class Quiz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trueAnswer'], 'integer'],
            [['question', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'trueAnswer'], 'required'],
            [['question', 'answer_1', 'answer_2', 'answer_3', 'answer_4'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Вопрос',
            'answer_1' => 'Ответ 1',
            'answer_2' => 'Ответ 2',
            'answer_3' => 'Ответ 3',
            'answer_4' => 'Ответ 4',
            'trueAnswer' => 'Правильный ответ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserQuizzes()
    {
        return $this->hasMany(UserQuiz::className(), ['quiz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_quiz', ['quiz_id' => 'id']);
    }

    /**
     * @param $userId
     * @return bool
     */
    public function isUserAnswer($userId)
    {
        foreach ($this->users as $user)
        {
            if ($user->id == $userId)
            {
                return true;
            }
        }
        return false;
    }

}
