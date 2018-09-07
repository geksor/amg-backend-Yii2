<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "timetable".
 *
 * @property int $id
 * @property string $title
 * @property int $startTime
 * @property int $stopTime
 * @property int $weekday
 * @property int $trainingDay
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
            [['startTime', 'stopTime', 'weekday', 'trainingDay', 'group'], 'required'],
            [['startTime', 'stopTime', 'weekday', 'trainingDay', 'group'], 'safe'],
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
            'title' => 'Название',
            'startTime' => 'Время начала',
            'stopTime' => 'Время окончания',
            'weekday' => 'День',
            'trainingDay' => 'Тренинг',
            'group' => 'Група',
        ];
    }
}
