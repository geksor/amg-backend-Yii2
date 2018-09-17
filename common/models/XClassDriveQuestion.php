<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xClass_drive_question".
 *
 * @property int $id
 * @property string $question
 * @property string $answer_1
 * @property string $answer_2
 * @property string $answer_3
 * @property string $answer_4
 * @property string $trueAnswer
 * @property int $xClass_drive_test_id
 *
 * @property XClassDriveTest $xClassDriveTest
 */
class XClassDriveQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xClass_drive_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['xClass_drive_test_id'], 'integer'],
            [['question', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'trueAnswer'], 'string', 'max' => 255],
            [['xClass_drive_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => XClassDriveTest::className(), 'targetAttribute' => ['xClass_drive_test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer_1' => 'Answer 1',
            'answer_2' => 'Answer 2',
            'answer_3' => 'Answer 3',
            'answer_4' => 'Answer 4',
            'trueAnswer' => 'True Answer',
            'xClass_drive_test_id' => 'X Class Drive Test ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassDriveTest()
    {
        return $this->hasOne(XClassDriveTest::className(), ['id' => 'xClass_drive_test_id']);
    }

}
