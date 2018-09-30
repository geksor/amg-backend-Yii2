<?php
namespace frontend\controllers;

use common\models\Command;
use common\models\EndQuest;
use common\models\User;
use common\models\XClassDriveQuestion;
use frontend\models\XclassAnswerImage;
use frontend\models\XclassDriveAnswerForm;
use Yii;
use yii\db\StaleObjectException;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;


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
        /* @var $answerForm XclassDriveAnswerForm */
        $answerForm = new XclassDriveAnswerForm();
        $answerImageForm = new XclassAnswerImage();

        if ($answerForm->load(Yii::$app->request->post())){
            if ($answerForm->validate()){
                if ( $request = $commandModel->saveQuestion($answerForm->question_id)){
                    Yii::$app->session->setFlash('trueAnswer', $request);

                    $questionModel = XClassDriveQuestion::findOne($answerForm->question_id);

                    return $this->render('question', [
                        'commandModel' => $commandModel,
                        'questionModel' => $questionModel,
                        'answerForm' => $answerForm,
                        'answerImageForm' => $answerImageForm,
                    ]);

                }
            }
        }

        if ($answerImageForm->load(Yii::$app->request->post())){
            if ($answerImageForm->validate()){

                $file = UploadedFile::getInstance($answerImageForm, 'image');

                if ( $request = $commandModel->saveQuestionIsImage($answerForm->question_id, $answerImageForm->uploadFile($file, $commandModel->image))){
                    Yii::$app->session->setFlash('trueAnswer', $request);

                    $questionModel = XClassDriveQuestion::findOne($answerImageForm->question_id);

                    return $this->render('question', [
                        'commandModel' => $commandModel,
                        'questionModel' => $questionModel,
                        'answerForm' => $answerForm,
                        'answerImageForm' => $answerImageForm,
                    ]);

                }
            }
        }

        if ($userModel->id != $commandModel->capitan_id){
            return $this->redirect('index');
        }

        $questionModels = XClassDriveQuestion::find()->all();

        $questionModel = null;

        foreach ($questionModels as $question){

            if (!$question->isCommandAnswer($commandModel->id)){
                /* @var $questionModel XClassDriveQuestion */
                $questionModel = $question;
                break;
            }
        }

        if ($questionModel === null){
            $commandUser = User::find()->where(['command_id' => $commandModel->id]);
            foreach ($commandUser as $user){
                $this->setEndQuest($user, 'xClassDrive');
            }

            Yii::$app->session->setFlash('popupEndTest', [
                'point' => Yii::$app->params['PointTest']['xClassDrive'],
                'truAnswers' => null
            ]);

        }

        $answerForm->question_id = $questionModel->id;
        $answerImageForm->question_id = $questionModel->id;

        return $this->render('question', [
            'commandModel' => $commandModel,
            'questionModel' => $questionModel,
            'answerForm' => $answerForm,
            'answerImageForm' => $answerImageForm,
        ]);
    }

    /**
     * @param $userModel
     * @param $testName
     */
    public function setEndQuest($userModel, $testName)
    {
        /* @var $userModel User */
        /* @var $endQuestsModel EndQuest */
        if (!empty($userModel->endQuests)){
            $endQuestsModel = EndQuest::findOne($userModel->endQuests->id);
            if (!$endQuestsModel->$testName){
                $endQuestsModel->$testName = 1;
                $endQuestsModel->save();
            }
        }else{
            $endQuestsModel = new EndQuest();
            $endQuestsModel->user_id = Yii::$app->user->id;
            $endQuestsModel->$testName = 1;
            $endQuestsModel->save();
        }
    }

}
