<?php

namespace common\models;

use yii\base\Model;

/**
 * This is the model class for table "questPoints".
 *
 * @property string $rules
 * @property string $map
 */
class RulesTraining extends Model
{
    public $rules;
    public $map;

    public function rules()
    {
        return [
            [
                [
                    'rules',
                    'map',
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
            'rules' => 'Правила тренинга',
            'map' => 'Карта',
        ];
    }
}