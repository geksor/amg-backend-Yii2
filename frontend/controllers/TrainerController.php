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
use common\models\Timetable;
use common\models\Training;
use common\models\User;
use common\models\XClassLineAnswer;
use common\models\XClassLineTest;
use frontend\models\ImageUpload;
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
                        'actions' => [
                            'logout',
                            'index',
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
                            'info',
                            'contact',
                            'training-map',
                            'rules',
                            'quiz',
                            'xclass-drive',
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

        return $this->render('index', [
            'userModel' => $userModel,
        ]);
    }

    /**
     * @param $trainingId
     *
     */
    public function setTraining($trainingId)
    {
        /* @var $userModel User */
        $userModel = User::findOne(Yii::$app->user->id);

        $userModel->training_id = $trainingId;
        $userModel->save();
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
     * Displays infoPage.
     *
     * @return mixed
     */
    public function actionInfo()
    {

        return $this->render('info');
    }

    /**
     * Displays contactPage.
     * @var $models Contact
     *
     * @return mixed
     */
    public function actionContact()
    {
        $models = Contact::find()->all();

        return $this->render('contact', [
            'models' => $models
        ]);
    }

    /**
     * Displays training-map Page.
     * @var $map
     *
     * @return mixed
     */
    public function actionTrainingMap()
    {
        $map = Yii::$app->params['RulesTraining']['map'];

        return $this->render('training-map', [
            'map' => $map
        ]);
    }

    /**
     * Displays training-map Page.
     * @var $map
     *
     * @return mixed
     */
    public function actionRules()
    {
        $rules = Yii::$app->params['RulesTraining']['rules'];

        return $this->render('rules', [
            'rules' => $rules
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
     * @var $mixDriveModel MixDrive
     * @var $models XClassLineTest
     *
     * @return mixed
     */
    public function actionXClassLine()
    {
        $userModel = User::findOne(Yii::$app->user->id);

        if (Yii::$app->request->isPost){
            $userModel->saveQuestion(Yii::$app->request->post('questId'));

            $trueAnswer = 0;

            $colLeft_answer = XClassLineAnswer::findOne(Yii::$app->request->post('colLeft'));
            $colRight_answer = XClassLineAnswer::findOne(Yii::$app->request->post('colRight'));

            if ((integer)$colLeft_answer->column === 1){
                ++$trueAnswer;
            }
            if ((integer)$colRight_answer->column === 0){
                ++$trueAnswer;
            }

            if (Yii::$app->session->has('trueAnswersXClassLine')){
                $trueAnswerFromSession = Yii::$app->session->get('trueAnswersXClassLine') + $trueAnswer;
                Yii::$app->session->set('trueAnswersXClassLine', $trueAnswerFromSession);
            }else{
                Yii::$app->session->set('trueAnswersXClassLine', $trueAnswer);
            }

        }

        $models = XClassLineTest::find()
            ->select('id')
            ->with([
                'xClassLineQuestions' => function (\yii\db\ActiveQuery $query) {
                    $query->andWhere('answerCount > 1');
                },
            ])
            ->asArray()
            ->all();

        $tempArr = [];

        foreach ($models as $model){
            if (!empty($model['xClassLineQuestions'])){
                $tempArr[] = $model;
            }
        }

        $idArr = ArrayHelper::index($tempArr, 'id');

        if (empty($idArr))
        {
            return $this->redirect('/');
        }

        $testId = null;

        if (Yii::$app->session->has('xClassLineTestId')){
            $testId = Yii::$app->session->get('xClassLineTestId');
        }else{
            $testId = array_rand($idArr, 1);
        }

        $model = XClassLineTest::find()
            ->where(['id' => $testId])
            ->with([
                'xClassLineQuestions' => function (\yii\db\ActiveQuery $query) {
                    $query->andWhere('answerCount > 1')
                        ->with([ 'xClassLineAnswers' ]);
                },
            ])
            ->one();
        /* @var $model XClassLineTest */
        if (!Yii::$app->session->has('xClassLineTestId')){
            Yii::$app->session->set('xClassLineTestId', $model->id);
        }

        $questionModel = null;

        foreach ($model->xClassLineQuestions as $question){
            if (!$question->isUserAnswer(Yii::$app->user->id)) {
                $questionModel = $question;
                break;
            }
        }

        if (!$questionModel){
            $maxPoint = Yii::$app->params['PointTest']['xClassLine'];

            $totalQuestion = count($model->xClassLineQuestions)*2;

            $pointStep = $maxPoint/$totalQuestion;

            $point = ceil(Yii::$app->session->get('trueAnswersXClassLine')*$pointStep);

            $this->setEndQuest($userModel, 'xClassLine');

            $userModel->xClassLine = $point;
            $userModel->save();

            Yii::$app->session->setFlash('popupEndTest', [
                'point' => $point,
                'truAnswers' => [
                    'true' => Yii::$app->session->get('trueAnswersXClassLine'),
                    'total' => $totalQuestion,
                ]
            ]);

            Yii::$app->session->remove('point');
            Yii::$app->session->remove('xClassLineTestId');
            Yii::$app->session->remove('trueAnswersXClassLine');

            return $this->redirect('/');
        }

        return $this->render('x-class-line', [
            'questionModel' => $questionModel,
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

        return $this->render('xclass-drive', [
            'commandModels' => $commandModels,
        ]);
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

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}
