<?php

namespace common\models;

use common\behaviors\ImgUploadBehavior;
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

    public function behaviors()
    {
        return [
            'ImgUploadBehavior' => [
                'class' => ImgUploadBehavior::className(),
                'noImage' => 'no_image.png',
                'folder' => '/uploads/images/rules_img',
                'propImage' => 'map'
            ],
        ];
    }

    /**
     * @param null $request
     * @return bool
     */
    public function save($request = null){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = json_encode($this->attributes);
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/json_params/rulesTraining.json';
        if (file_put_contents($setPath , $tempParams)){
            return true;
        }
        return false;
    }
}