<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "questPoints".
 *
 * @property int $id
 * @property int $amgStatic
 * @property int $mixStatic
 * @property int $mbux
 * @property int $xClassDrive
 * @property int $amgDrive
 * @property int $intelligent
 * @property int $mixDrive
 * @property int $xClassLine
 * @property int $quizItem
 */
class QuestPoints extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questPoints';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amgStatic', 'mixStatic', 'mbux', 'xClassDrive', 'amgDrive', 'intelligent', 'mixDrive', 'xClassLine', 'quizItem'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amgStatic' => 'AMG статика',
            'mixStatic' => 'MIX статика',
            'mbux' => 'MBUX',
            'xClassDrive' => 'X-Class тест-драйв',
            'amgDrive' => 'AMG тест-драйв',
            'intelligent' => 'Intelligent drive',
            'mixDrive' => 'MIX тест-драйв',
            'xClassLine' => 'X-Class линии исполнения',
            'quizItem' => 'Викторина (очки за один вопрос)',
        ];
    }
}
