<?php

namespace common\models;

use yii\base\Model;

/**
 * This is the model class for table "questPoints".
 *
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
class PointTest extends Model
{
    public $amgStatic;
    public $mixStatic;
    public $mbux;
    public $xClassDrive;
    public $amgDrive;
    public $intelligent;
    public $mixDrive;
    public $xClassLine;
    public $quizItem;



    public function rules()
    {
        return [
            [
                [
                    'amgStatic',
                    'mixStatic',
                    'mbux',
                    'xClassDrive',
                    'amgDrive',
                    'intelligent',
                    'mixDrive',
                    'xClassLine',
                    'quizItem',
                ],
                'safe'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
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