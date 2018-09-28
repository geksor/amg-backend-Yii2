<?php
namespace frontend\controllers;

use common\models\Command;
use common\models\User;
use common\models\XClassDriveQuestion;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class XclassDriveController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'captain-command',
                            'select-command',
                            'question',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays index.
     *
     * @var $userModel User
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect('/');
        }

        $userModel = User::findOne(Yii::$app->user->id);

        if ($userModel->role === 3){
            return $this->redirect('captain-command');
        }

        $commandCount = Command::find()->where(['training_id' => $userModel->training_id, 'group' => $userModel->group])->count();

        if ($userModel->role === 4 && $commandCount >= 1){//1 is temp use 6
            if ($userModel->command_id != null){
                return $this->redirect('captain-command');
            }
            return $this->redirect('select-command');
        }


        return $this->render('index', [
            'userModel' => $userModel,
        ]);
    }

    /**
     * Displays captain-command.
     *
     * @var $userModel User
     * @var $commandModel Command
     * @return mixed
     */
    public function actionCaptainCommand()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect('/');
        }

        $userModel = User::findOne(Yii::$app->user->id);

        if ($userModel->command_id === null){
            return $this->redirect('select-command');
        }

        $commandModel = Command::find()->with(['captain','player1','player2','player3',])->where(['id' => $userModel->command_id])->one();


        return $this->render('captain-command', [
            'userModel' => $userModel,
            'commandModel' => $commandModel,
        ]);
    }

    /**
     * Displays select-command.
     *
     * @var $userModel User
     * @var $commandModels Command
     * @return mixed
     */
    public function actionSelectCommand()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect('/');
        }

        $userModel = User::findOne(Yii::$app->user->id);

        if ($userModel->role === 3){
            return $this->redirect('captain-command');
        }

        $commandQuery = Command::find()->with(['captain',])->where(['training_id' => $userModel->training_id, 'group' => $userModel->group]);
        $countCommandQuery = clone $commandQuery;
        $commandFullCount = $countCommandQuery->andWhere(['isFull' => 1])->count();

        if ($commandFullCount === 1){//1 is temp use 6
            Yii::$app->session->setFlash('commandsFull');
            return $this->redirect('/');
        }

        $commandModels = $commandQuery->all();


        return $this->render('select-command', [
            'userModel' => $userModel,
            'commandModels' => $commandModels,
        ]);
    }

    /**
     * Displays question.
     *
     * @var $userModel User
     * @var $commandModel Command
     * @return mixed
     */
    public function actionQuestion()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect('/');
        }

        /* @var $userModel User */
        $userModel = User::findOne(Yii::$app->user->id);
        /* @var $commandModel Command */
        $commandModel = Command::findOne($userModel->command_id);

        if ($userModel->id != $commandModel->capitan_id){
            return $this->redirect('index');
        }

        $questionModels = XClassDriveQuestion::find()->all();

        $questionModel = null;

        foreach ($questionModels as $question){
            if ($question->isCommandAnswer($commandModel->id)){
                $questionModel = $question;
                break;
            }
        }

        return $this->render('question', [
            'userModel' => $userModel,
            'commandModel' => $commandModel,
            'questionModel' => $questionModel,
        ]);
    }
}
