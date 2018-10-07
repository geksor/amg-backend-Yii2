<?php
namespace frontend\models;

use common\models\XClassDriveQuestion;
use yii\base\Model;


/**
 * AmswerForm form
 *
 * @property int $question_id
 * @property string $answer

 *
 */
class XclassDriveAnswerForm extends Model
{
    public $question_id;
    public $answer;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['answer', 'required'],
            ['answer', 'trim'],
            ['answer', 'validateAnswer', 'skipOnEmpty' => false, 'skipOnError' => false],
            ['question_id', 'safe'],
        ];
    }

    public function validateAnswer($attribute, $params)
    {
        /* @var $question XclassDriveAnswerForm */
        $question = XClassDriveQuestion::findOne($this->question_id);
        $answerArr = [
            mb_strtolower ($question->answer_var_1),
            mb_strtolower ($question->answer_var_2),
            mb_strtolower ($question->answer_var_3),
            mb_strtolower ($question->answer_var_4),
            mb_strtolower ($question->answer_var_5),
            mb_strtolower ($question->answer_var_6),
        ];

        if (!in_array(mb_strtolower ($this->$attribute), $answerArr)) {
            $this->addError($attribute, 'Ответ неверный');
        }
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'answer' => 'Ответ'
        ];
    }

    /**
     * checked answer.
     *
     * @return true|false
     */
    public function checkAnswer()
    {
        if (!$this->validate()) {
            return false;
        }

        return true;
    }
}
