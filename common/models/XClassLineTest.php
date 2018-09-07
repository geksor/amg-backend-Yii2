<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xClass_line_test".
 *
 * @property int $id
 * @property string $title
 *
 * @property XClassLineQuestion[] $xClassLineQuestions
 */
class XClassLineTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xClass_line_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassLineQuestions()
    {
        return $this->hasMany(XClassLineQuestion::className(), ['xClass_line_test_id' => 'id']);
    }
}
