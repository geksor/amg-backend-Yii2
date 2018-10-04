<?php
namespace frontend\controllers;

use common\models\AmgDrive;
use common\models\AmgStaticAnswer;
use common\models\AmgStaticTest;
use common\models\Command;
use common\models\Contact;
use common\models\DealerCenter;
use common\models\EndQuest;
use common\models\GalleryImage;
use common\models\MbuxTest;
use common\models\MixDrive;
use common\models\MixStatic;
use common\models\Quiz;
use common\models\RulesTraining;
use common\models\RunDrive;
use common\models\RunXclassDrive;
use common\models\Timetable;
use common\models\Training;
use common\models\User;
use common\models\XClassLineAnswer;
use common\models\XClassLineTest;
use frontend\models\ImageUpload;
use frontend\models\SelectTrainingForm;
use frontend\models\SignupFormStep2;
use frontend\models\SignupFormStep3;
use vova07\console\ConsoleRunner;
use console\controllers\ServerController;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;


/**
 * Site controller
 */
class TrainerController extends Controller
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
                        'actions' => ['error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [
                            'logout',
                            'error',
                            'index',
                            'select-training',
                            'user-table',
                            'timetable',
                            'mix-static',
                            'mix-static-gallery',
                            'amg-static',
                            'mbux',
                            'amg-drive',
                            'mix-drive',
                            'mix-drive-view',
                            'amg-drive-view',
                            'x-class-line',
                            'quiz',
                            'xclass-drive',
                            'intelligent',
                            'run-xclass-drive',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isTrainer(Yii::$app->user->identity->username);
                        }
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @var $userModel User
     * @return mixed
     */
    public function actionIndex()
    {
        $userModel = User::findOne(Yii::$app->user->id);

        if ($userModel->training_id === null){
            return $this->redirect('select-training');
        }

        return $this->render('index', [
            'userModel' => $userModel,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @var $userModel User
     * @return mixed
     */
    public function actionSelectTraining()
    {
        $selectModel = new SelectTrainingForm();

        if ($selectModel->load(Yii::$app->request->post())){
            if ($this->setTraining($selectModel->training_id)){
                return $this->redirect('index');
            }
        }

        $trainings = Training::find()->select(['id', 'date'])->asArray()->all();

        $trainingsArr = [];

        if (!empty($trainings)){
            foreach ($trainings as $training){
                $value = date("d.m.Y", (integer) $training['date']);
                $trainingsArr[$training['id']] = $value;
            }
        }

        return $this->render('select-training', [
            'trainingsArr' => $trainingsArr,
            'selectModel' => $selectModel,
        ]);
    }

    /**
     * @param $trainingId
     *
     * @return bool
     */
    public function setTraining($trainingId)
    {
        /* @var $userModel User */
        $userModel = User::findOne(Yii::$app->user->id);

        $userModel->training_id = $trainingId;
        if ($userModel->save()){
            return true;
        }
        return false;
    }

    /**
     * Displays homepage.
     *
     * @var $userModelsGroup1 User
     * @var $userModelsGroup2 User
     * @return mixed
     */
    public function actionUserTable()
    {
        $userModelsGroup1 = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => 1,
                'role' => [4,3],
            ])->orderBy(['totalPoint' => SORT_DESC])->all();

        $userModelsGroup2 = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => 2,
                'role' => [4,3],
                ])->orderBy(['totalPoint' => SORT_DESC])->all();

        $quizCount = Quiz::find()->count();

        $maxPoint = (integer)Yii::$app->params['PointTest']['amgStatic']
            + (integer)Yii::$app->params['PointTest']['mixStatic']
            + (integer)Yii::$app->params['PointTest']['mbux']
            + (integer)Yii::$app->params['PointTest']['xClassDrive']
            + (integer)Yii::$app->params['PointTest']['intelligent']
            + (integer)Yii::$app->params['PointTest']['mixDrive']
            + (integer)Yii::$app->params['PointTest']['xClassLine']
            + ((integer)Yii::$app->params['PointTest']['quizItem'] * $quizCount);

        return $this->render('user-table', [
            'userModelsGroup1' => $userModelsGroup1,
            'userModelsGroup2' => $userModelsGroup2,
            'maxPoint' => $maxPoint,
        ]);
    }

    /**
     * Displays tablePage.
     *
     * @var $timetableModels Timetable
     * @return mixed
     */
    public function actionTimetable()
    {
        $userModel = User::findOne(Yii::$app->user->id);
        $traningDay = (integer) date('w', $userModel->training->date);
        $timetableModels = Timetable::find()
            ->where([
                'trainingDay' => $traningDay,
            ])
            ->orderBy('startTime')
            ->all();
        return $this->render('timetable', [
            'timetableModels' => $timetableModels,
            'traningDay' => $traningDay,
        ]);
    }

    /**
     * Displays mix-static Page.
     *
     * @var $models MixStatic
     *
     * @return mixed
     */
    public function actionMixStatic()
    {
        $models = MixStatic::find()->with('mixStaticUsers')->all();

        return $this->render('mix-static', [
            'models' => $models,
        ]);
    }

    /**
     * Displays mix-static-gallery Page.
     *
     * @var $model MixStatic
     * @var $images GalleryImage
     *
     * @return mixed
     */
    public function actionMixStaticGallery($id)
    {
        $model = MixStatic::findOne($id);
        $images = $model->getBehavior('galleryBehavior')->getImages();

        return $this->render('mix-static-gallery', [
            'images' => $images,
        ]);
    }

    /**
     * Displays amg-static Page.
     *
     * @var $userModels User
     * @var $maxPoint
     *
     * @return mixed
     */
    public function actionAmgStatic()
    {
        $userModels = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
                'role' => [4,3],
            ])
            ->orderBy(['amgStatic' => SORT_DESC])->all();

        $maxPoint = (integer)Yii::$app->params['PointTest']['amgStatic'];


        return $this->render('amg-static', [
            'userModels' => $userModels,
            'maxPoint' => $maxPoint,
        ]);
    }

    /**
     * Displays mbux Page.
     *
     * @var $userModels User
     *
     * @return mixed
     */
    public function actionMbux()
    {
        $userModels = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
                'role' => [4,3],
            ])
            ->orderBy(['mbux' => SORT_DESC])->all();

        $maxPoint = (integer)Yii::$app->params['PointTest']['mbux'];


        return $this->render('mbux', [
            'userModels' => $userModels,
            'maxPoint' => $maxPoint,
        ]);
    }

    /**
     * Displays x-class-line Page.
     *
     * @var $userModels User
     *
     * @return mixed
     */
    public function actionXClassLine()
    {
        $userModels = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
                'role' => [4,3],
            ])
            ->orderBy(['xClassLine' => SORT_DESC])->all();

        $maxPoint = (integer)Yii::$app->params['PointTest']['xClassLine'];


        return $this->render('x-class-line', [
            'userModels' => $userModels,
            'maxPoint' => $maxPoint,
        ]);

    }

    /**
     * Displays intelligent Page.
     *
     * @var $userModels User
     *
     * @return mixed
     */
    public function actionIntelligent()
    {
        $userModels = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
                'role' => [4,3],
            ])
            ->orderBy(['intelligent' => SORT_DESC])->all();

        $maxPoint = (integer)Yii::$app->params['PointTest']['intelligent'];


        return $this->render('intelligent', [
            'userModels' => $userModels,
            'maxPoint' => $maxPoint,
        ]);

    }

    /**
     * Displays amg-drive Page.
     *
     * @var $userModels User
     *
     * @return mixed
     */
    public function actionAmgDrive()
    {
        $userModels = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
                'role' => [4,3],
            ])
            ->with(['endQuests', 'amgDrives'])
            ->orderBy(['totalPoint' => SORT_DESC])->all();

        return $this->render('amg-drive', [
            'userModels' => $userModels,
        ]);
    }

    /**
     * Displays mix-drive Page.
     *
     * @var $userModels User
     *
     * @return mixed
     */
    public function actionMixDrive()
    {
        $userModels = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
                'role' => [4,3],
            ])
            ->with(['endQuests', 'mixDrives'])
            ->orderBy(['totalPoint' => SORT_DESC])->all();

        return $this->render('mix-drive', [
            'userModels' => $userModels,
        ]);
    }

    /**
     * Displays mix-drive-view Page.
     *
     * @var $userModel User
     * @var $driveModel MixDrive
     *
     * @param $driveId
     * @param $userId
     *
     * @return mixed
     */
    public function actionMixDriveView($id)
    {
        $userModel = User::findOne($id);

        $driveModel = MixDrive::findOne(['user_id' => $id]);

        return $this->render('drive-view', [
            'userModel' => $userModel,
            'driveModel' => $driveModel,
            'title' => 'MIX Тест-Драйв',
        ]);
    }

    /**
     * Displays amg-drive-view Page.
     *
     * @var $userModel User
     * @var $driveModel MixDrive
     *
     * @param $driveId
     * @param $userId
     *
     * @return mixed
     */
    public function actionAmgDriveView($id)
    {
        $userModel = User::findOne($id);

        $driveModel = AmgDrive::findOne(['user_id' => $id]);

        return $this->render('drive-view', [
            'userModel' => $userModel,
            'driveModel' => $driveModel,
            'title' => 'AMG Тест-Драйв',
        ]);
    }

    /**
     * Displays xclass-drive Page.
     *
     * @var $commandModels Command
     *
     * @return mixed
     */
    public function actionXclassDrive()
    {
        $commandModels = Command::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
            ])
            ->with(['captain'])
            ->all();

        $modelsRunDrive = RunDrive::find()
            ->where(['training_id' => Yii::$app->user->identity->training_id, 'group' => Yii::$app->user->identity->group])
            ->all();
        $isRunDrive = false;
        if (!empty($modelsRunDrive)){
            $isRunDrive = true;
        }

        return $this->render('xclass-drive', [
            'commandModels' => $commandModels,
            'isRunDrive' => $isRunDrive,
        ]);
    }

    /**
     * Displays run-xclass-drive Page.
     *
     * @var $commandModels Command
     *
     * @return mixed
     */
    public function actionRunXclassDrive()
    {
        $modelsRunDrive = RunDrive::find()
            ->where(['training_id' => Yii::$app->user->identity->training_id, 'group' => Yii::$app->user->identity->group])
            ->one();

        if ($modelsRunDrive !== null){
            return $this->redirect('index');
        }

        $newRun = new RunDrive();
        $newRun->training_id = Yii::$app->user->identity->training_id;
        $newRun->group = Yii::$app->user->identity->group;
        $newRun->save();
        return $this->redirect('xclass-drive');
    }

    /**
     * Displays quiz Page.
     *
     * @var $userModels User
     *
     * @return mixed
     */
    public function actionQuiz()
    {
        $userModels = User::find()
            ->where([
                'training_id' => Yii::$app->user->identity->training_id,
                'group' => Yii::$app->user->identity->group,
                'role' => [4,3],
            ])
            ->with('userQuizzes')
            ->orderBy(['quiz' => SORT_DESC])->all();

        $quizCount = Quiz::find()->count();

        $maxPoint = (integer)Yii::$app->params['PointTest']['quizItem'] * $quizCount;


        return $this->render('quiz', [
            'userModels' => $userModels,
            'maxPoint' => $maxPoint,
            'quizCount' => $quizCount,
        ]);
    }

}
