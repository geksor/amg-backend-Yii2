<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xClass_line_question".
 *
 * @property int $id
 * @property string $title
 * @property string $leftColumn
 * @property string $rightColumn
 * @property int $answerCount
 * @property int $xClass_line_test_id
 *
 * @property UserXClassLineQuestion[] $userXClassLineQuestions
 * @property User[] $users
 * @property XClassLineAnswer[] $xClassLineAnswers
 * @property XClassLineTest $xClassLineTest
 */
class XClassLineQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xClass_line_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answerCount', 'xClass_line_test_id'], 'integer'],
            [['title', 'leftColumn', 'rightColumn'], 'string', 'max' => 255],
            [['xClass_line_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => XClassLineTest::className(), 'targetAttribute' => ['xClass_line_test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Задание',
            'leftColumn' => 'Заголовок левой колонки',
            'rightColumn' => 'Заголовок правой колонки',
            'answerCount' => 'Кол-во картинок',
            'xClass_line_test_id' => 'X Class Line Test ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassLineAnswers()
    {
        return $this->hasMany(XClassLineAnswer::className(), ['xClass_line_question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassLineTest()
    {
        return $this->hasOne(XClassLineTest::className(), ['id' => 'xClass_line_test_id']);
    }

    public function deleteChildPhoto()
    {
        if ($this->xClassLineAnswers){
            foreach ($this->xClassLineAnswers as $answer){
                $answer->deletePhoto();
            }
        }
    }

    public function beforeDelete()
    {
        $this->deleteChildPhoto();

        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserXClassLineQuestions()
    {
        return $this->hasMany(UserXClassLineQuestion::className(), ['xClass_line_question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_xClass_line_question', ['xClass_line_question_id' => 'id']);
    }

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
