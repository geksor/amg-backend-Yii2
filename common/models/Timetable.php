<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $startTime
 * @property int $stopTime
 * @property int $weekday
 * @property int $group
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['startTime', 'stopTime', 'weekday', 'group'], 'required'],
            [['startTime', 'stopTime', 'weekday', 'group'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'startTime' => 'Время начала',
            'stopTime' => 'Время окончания',
            'weekday' => 'День',
            'group' => 'Група',
        ];
    }
}
