<?php

namespace common\models;

use yii\base\Model;

/**
 * This is the model class for table "questPoints".
 *
 * @property int $amgDrive
 * @property int $mfaDrive
 * @property int $eqDrive
 *
 * @property int $quizItem
 * @property int $quizItemTime
 *
 * @property int $brainsBattleFirstRound
 * @property int $brainsBattleWin
 * @property int $brainsBattleDrawn
 * @property int $brainsBattleMaxPoints
 * @property int $brainsBattleItemTime
 *
 * @property int $suvChallenge
 * @property int $suvChallengeItem
 * @property int $suvChallengeItemTime
 *
 * @property int $racePlace_1
 * @property int $racePlace_2
 * @property int $racePlace_3
 * @property int $raceItemTime
 */
class PointTest extends Model
{
    public $amgDrive;
    public $mfaDrive;
    public $eqDrive;

    public $quizItem;
    public $quizItemTime;

    public $brainsBattleFirstRound;
    public $brainsBattleWin;
    public $brainsBattleDrawn;
    public $brainsBattleMaxPoints;
    public $brainsBattleItemTime;

    public $suvChallenge;
    public $suvChallengeItem;
    public $suvChallengeItemTime;

    public $racePlace_1;
    public $racePlace_2;
    public $racePlace_3;
    public $raceItemTime;

    public function rules()
    {
        return [
            [
                [
                    'amgDrive',
                    'mfaDrive',
                    'eqDrive',

                    'quizItem',
                    'quizItemTime',

                    'brainsBattleFirstRound',
                    'brainsBattleWin',
                    'brainsBattleDrawn',
                    'brainsBattleMaxPoints',
                    'brainsBattleItemTime',

                    'suvChallenge',
                    'suvChallengeItem',
                    'suvChallengeItemTime',

                    'racePlace_1',
                    'racePlace_2',
                    'racePlace_3',
                    'raceItemTime',
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
            'amgDrive' => 'AMG',
            'mfaDrive' => 'MFA',
            'eqDrive' => 'EQ',

            'quizItem' => 'Викторина баллы за ответ',
            'quizItemTime' => 'Викторина время на ответ',

            'brainsBattleFirstRound' => 'Битва умов баллы за первый раунд',
            'brainsBattleWin' => 'Битва умов баллы за победу',
            'brainsBattleDrawn' => 'Битва умов баллы за ничью',
            'brainsBattleMaxPoints' => 'Битва умов кол-баллов после которого нужно отреагировать',
            'brainsBattleItemTime' => 'Битва умов время на ответ',

            'suvChallenge' => 'Suv Challenge баллы за участие',
            'suvChallengeItem' => 'Suv Challenge баллы за ответ',
            'suvChallengeItemTime' => 'Suv Challenge время на ответ',

            'racePlace_1' => 'Race баллы за первое место',
            'racePlace_2' => 'Race баллы за второе место',
            'racePlace_3' => 'Race баллы за третье место',
            'raceItemTime' => 'Race время на ответ',
        ];
    }

    public function save($request = null){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = json_encode($this->attributes);
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/json_params/testPoint.json';
        if (file_put_contents($setPath , $tempParams)){
            return true;
        }
        return false;
    }
}