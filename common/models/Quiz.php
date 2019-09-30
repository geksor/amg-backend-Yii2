<?php

namespace common\models;

use common\behaviors\ImgUploadBehavior;
use Yii;

/**
 * This is the model class for table "quiz".
 *
 * @property int $id
 * @property string $image
 * @property string $question
 * @property string $answer_1
 * @property string $answer_2
 * @property string $answer_3
 * @property string $answer_4
 * @property int $isTrue_1
 * @property int $isTrue_2
 * @property int $isTrue_3
 * @property int $isTrue_4
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
     * @return array
     */
    public function behaviors()
    {
        return [
            'ImgUploadBehavior' => [
                'class' => ImgUploadBehavior::className(),
                'noImage' => 'no_image.png',
                'folder' => '/uploads/images/quiz_image',
                'propImage' => 'image',
            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isTrue_1', 'isTrue_2', 'isTrue_3', 'isTrue_4',], 'integer'],
            [['question', 'answer_1', 'answer_2', 'answer_3', 'answer_4'], 'required'],
            [['image', 'question', 'answer_1', 'answer_2', 'answer_3', 'answer_4'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Фоновое изображение вопроса',
            'question' => 'Вопрос',
            'answer_1' => 'Ответ 1',
            'answer_2' => 'Ответ 2',
            'answer_3' => 'Ответ 3',
            'answer_4' => 'Ответ 4',
            'isTrue_1' => 'Правильный ответ',
            'isTrue_2' => 'Правильный ответ',
            'isTrue_3' => 'Правильный ответ',
            'isTrue_4' => 'Правильный ответ',
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
            if ($user->id === $userId)
            {
                return true;
            }
        }
        return false;
    }

    public function isMultiAnswer()
    {
        return ($this->isTrue_1 + $this->isTrue_2 + $this->isTrue_3 + $this->isTrue_4) > 1;
    }

    public function trueAnswerSet()
    {
        return ($this->isTrue_1 + $this->isTrue_2 + $this->isTrue_3 + $this->isTrue_4) > 0;
    }

    public function beforeSave($insert)
    {
        if (!$this->trueAnswerSet()){
            $this->isTrue_1 = 1;
        }
        return parent::beforeSave($insert);
    }
}
