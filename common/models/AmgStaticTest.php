<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "amgStatic_test".
 *
 * @property int $id
 * @property string $title
 *
 * @property AmgStaticQuestion[] $amgStaticQuestions
 */
class AmgStaticTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amgStatic_test';
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
            'title' => 'Название теста',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmgStaticQuestions()
    {
        return $this->hasMany(AmgStaticQuestion::className(), ['amgStatic_test_id' => 'id']);
    }
}
