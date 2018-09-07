<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xClass_line_answer".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $column
 * @property int $xClass_line_question_id
 *
 * @property XClassLineQuestion $xClassLineQuestion
 */
class XClassLineAnswer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xClass_line_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['column', 'xClass_line_question_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['xClass_line_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => XClassLineQuestion::className(), 'targetAttribute' => ['xClass_line_question_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'column' => 'Column',
            'xClass_line_question_id' => 'X Class Line Question ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassLineQuestion()
    {
        return $this->hasOne(XClassLineQuestion::className(), ['id' => 'xClass_line_question_id']);
    }
}
