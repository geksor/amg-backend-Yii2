<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mbux_test".
 *
 * @property int $id
 * @property string $title
 *
 * @property MbuxQuestion[] $mbuxQuestions
 */
class MbuxTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mbux_test';
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
    public function getMbuxQuestions()
    {
        return $this->hasMany(MbuxQuestion::className(), ['mbux_test_id' => 'id']);
    }
}
