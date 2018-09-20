<?php
namespace frontend\controllers;
//WV]rlqm&C4qU!y!M03
use common\models\DealerCenter;
use common\models\GalleryImage;
use common\models\MixStatic;
use common\models\Timetable;
use common\models\User;
use vova07\console\ConsoleRunner;
use console\controllers\ServerController;
use Yii;
use yii\base\InvalidParamException;
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


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'timetable', 'timetable-info', 'mix-static', 'mix-static-gallery'],
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
            'totalCount' => $userModel->getTotalCount(),
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
                'group' => $userModel->group,
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
     * Displays timetable-info Page.
     *
     * @var $model Timetable
     * @return mixed
     */
    public function actionTimetableInfo($id)
    {
        $model = Timetable::findOne($id);

        return $this->render('timetable-info', [
            'model' => $model,
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
        $models = MixStatic::find()->with('users')->all();
        $viewedCount = 0;
        foreach ($models as $model)
        {
        /* @var $model MixStatic */
            if (!empty($model->users)) {
                foreach ($model->users as $user){
                    if ($user->id == Yii::$app->user->id && $user->isMixStaticViewed($model->id)){
                        ++$viewedCount;
                        break;
                    }
                }
            }
        }

        if ($viewedCount === 3){
            $userModel = User::findOne(Yii::$app->user->id);
            $userModel->mixStatic = Yii::$app->params['PointTest']['mixStatic'];
            if ($userModel->save()){
                return $this->redirect('/site/index');
            }
        }

        return $this->render('mix-static', [
            'models' => $models,
        ]);
    }


    /**
     * Displays mix-static-gallery Page.
     *
     * @var $model Timetable
     * @var $images GalleryImage
     * @var $userModel User
     *
     * @return mixed
     */
    public function actionMixStaticGallery($id, $step = 0, $imageId = null, $stars = null)
    {
        $model = MixStatic::findOne($id);
        $images = $model->getBehavior('galleryBehavior')->getImages();
        $userModel = User::findOne(Yii::$app->user->id);
        if (ArrayHelper::toArray($images)){
            Yii::$app->session->set('images', ArrayHelper::toArray($images));
        }

        if ($imageId !== null && $stars !== null){
            if (!$this->isImageVote($imageId, $userModel)){
                $this->setRatingImage($imageId, $stars);
                $userModel->saveGalleryImage($imageId);
            }
        }

        if (count(ArrayHelper::toArray($images)) == $step){
            $userModel->saveMixStatic($id);
            $this->redirect('/site/mix-static');
        }

        return $this->render('mix-static-gallery', [
            'model' => $model,
            'images' => $images,
            'step' => $step,
        ]);
    }

    public function setRatingImage($id, $stars)
    {
        $model = GalleryImage::findOne($id);

        $model->rating = $model->rating + (int) $stars;
        $model->voteCount = ++$model->voteCount;

        if ($model->save()){
            return true;
        };

        return false;
    }

    /**
     * isImageVote ?
     *
     * @var $userModel User
     *
     * @return boolean
     *
     */
    public function isImageVote($imageId, $userModel)
    {
        if (!empty($userModel->galleryImages)){
            foreach ($userModel->galleryImages as $image)
            {
                if ($image->id === (integer)$imageId)
                {
                    return true;
                }
            }
        }
        return false;
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
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
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

    public function actionRun()
    {
//        Yii::$app->consoleRunner->run('server/start');
//        $cr = new ConsoleRunner(['file' => Yii::getAlias('@app/yii.php')]);
//        $cr->run('server/start');
    }
}
