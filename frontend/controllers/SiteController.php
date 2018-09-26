<?php
namespace frontend\controllers;
//WV]rlqm&C4qU!y!M03
use common\models\AmgDrive;
use common\models\AmgStaticAnswer;
use common\models\AmgStaticTest;
use common\models\Contact;
use common\models\DealerCenter;
use common\models\EndQuest;
use common\models\GalleryImage;
use common\models\MbuxTest;
use common\models\MixDrive;
use common\models\MixStatic;
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
                        'actions' => ['signup-step-1', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'logout',
                            'signup-step-2',
                            'signup-step-3',
                            'signup-end',
                            'index',
                            'timetable',
                            'timetable-info',
                            'mix-static',
                            'mix-static-gallery',
                            'amg-static',
                            'mbux',
                            'amg-drive',
                            'mix-drive',
                            'x-class-line',
                            'info',
                            'contact',
                            'training-map',
                            'rules',
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

        if (!$userModel->training_id || !$userModel->group){
            return $this->redirect('site/signup-step-2');
        }

        if (!$userModel->first_name || !$userModel->last_name || !$userModel->surname || !$userModel->dealer_center_id){
            return $this->redirect('signup-step-3');
        }

        return $this->render('index', [
            'userModel' => $userModel,
            'totalCount' => $userModel->totalPoint,
            'place' => $userModel->getPlace(),
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
                Yii::$app->session->remove('images');

                $this->setEndQuest($userModel, 'mixStatic');

                Yii::$app->session->setFlash('popupEndTest', [
                    'point' => $userModel->mixStatic,
                ]);
                return $this->redirect('/site/index');
            }
        }

        return $this->render('mix-static', [
            'models' => $models,
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
     * Displays amg-static Page.
     *
     * @var $models AmgStaticTest
     * @var $model AmgStaticTest
     *
     * @return mixed
     */
    public function actionAmgStatic($questId = null, $img_1 = null, $img_2 = null, $img_3 = null)
    {
        $userModel = User::findOne(Yii::$app->user->id);

        if ($questId){
            $userModel->saveAmgTest($questId);

            $trueAnswer = 0;

            $img_1_answer = AmgStaticAnswer::findOne($img_1);
            $img_2_answer = AmgStaticAnswer::findOne($img_2);
            $img_3_answer = AmgStaticAnswer::findOne($img_3);

            if ((integer)$img_1_answer->trueImage === 1){
                ++$trueAnswer;
            }
            if ((integer)$img_2_answer->trueImage === 2){
                ++$trueAnswer;
            }
            if ((integer)$img_3_answer->trueImage === 3){
                ++$trueAnswer;
            }

            if (Yii::$app->session->has('trueAnswers')){
                $trueAnswerFromSession = Yii::$app->session->get('trueAnswers') + $trueAnswer;
                Yii::$app->session->set('trueAnswers', $trueAnswerFromSession);
            }else{
                Yii::$app->session->set('trueAnswers', $trueAnswer);
            }

        }

        $models = AmgStaticTest::find()
            ->select('id')
            ->with([
                'amgStaticQuestions' => function (\yii\db\ActiveQuery $query) {
                    $query->andWhere(['answerCount' => 3]);
                },
            ])
            ->asArray()
            ->all();

        $tempArr = [];

        foreach ($models as $model){
            if (!empty($model['amgStaticQuestions'])){
                $tempArr[] = $model;
            }
        }

        $idArr = ArrayHelper::index($tempArr, 'id');

        if (empty($idArr))
        {
            return $this->redirect('/');
        }

        $testId = null;

        if (Yii::$app->session->has('amgStaticTestId')){
            $testId = Yii::$app->session->get('amgStaticTestId');
        }else{
            $testId = array_rand($idArr, 1);
        }

        $model = AmgStaticTest::find()
            ->where(['id' => $testId])
            ->with([
                'amgStaticQuestions' => function (\yii\db\ActiveQuery $query) {
                    $query->andWhere(['answerCount' => 3])
                    ->with([
                        'amgStaticAnswers' => function (\yii\db\ActiveQuery $query) {
                            $query->orderBy('rank');
                        }
                    ]);
                },
            ])
            ->one();
        /* @var $model AmgStaticTest */
        if (!Yii::$app->session->has('amgStaticTestId')){
            Yii::$app->session->set('amgStaticTestId', $model->id);
        }

        foreach ($model->amgStaticQuestions as $question){
            if (!$question->isUserAnswer(Yii::$app->user->id)) {
                $questionModel = $question;
                break;
            }
        }

        if (!$questionModel){
            $maxPoint = Yii::$app->params['PointTest']['amgStatic'];

            $totalQuestion = count($model->amgStaticQuestions)*3;

            $pointStep = $maxPoint/$totalQuestion;

            $point = ceil(Yii::$app->session->get('trueAnswers')*$pointStep);

            $this->setEndQuest($userModel, 'amgStatic');

            $userModel->amgStatic = $point;
            $userModel->save();

            Yii::$app->session->setFlash('popupEndTest', [
                'point' => $point,
                'truAnswers' => [
                    'true' => Yii::$app->session->get('trueAnswers'),
                    'total' => $totalQuestion,
                ]
            ]);

            Yii::$app->session->remove('point');
            Yii::$app->session->remove('amgStaticTestId');
            Yii::$app->session->remove('trueAnswers');

            return $this->redirect('/');
        }

        return $this->render('amg-static', [
            'questionModel' => $questionModel,
        ]);
    }

    /**
     * Displays mbux Page.
     *
     * @var $models MbuxTest
     *
     * @return mixed
     */
    public function actionMbux()
    {
        if (Yii::$app->request->post('userId') && Yii::$app->request->post('end')){

            $point = Yii::$app->params['PointTest']['mbux'];

            $userModel = User::findOne(Yii::$app->request->post('userId'));

            $userModel->mbux = $point;

            if ($userModel->save()){
                $this->setEndQuest($userModel, 'mbux');
                Yii::$app->session->setFlash('popupEndTest', [
                    'point' => $point,
                ]);

                return $this->goHome();
            }

            return $this->redirect('/site/mbux');
        }

        $models = MbuxTest::find()
            ->select('id')
            ->with('mbuxQuestions')
            ->asArray()
            ->all();

        $tempArr = [];

        foreach ($models as $model){
            if (!empty($model['mbuxQuestions'])){
                $tempArr[] = $model;
            }
        }

        $idArr = ArrayHelper::index($tempArr, 'id');

        if (empty($idArr))
        {
            return $this->redirect('/');
        }

        $testId = null;

        if (Yii::$app->session->has('mbuxId')){
            $testId = Yii::$app->session->get('mbuxId');
        }else{
            $testId = array_rand($idArr, 1);
        }


            $model = MbuxTest::find()
                ->where(['id' => $testId])
                ->with('mbuxQuestions')
                ->one();
        if (!$model){
            if (Yii::$app->session->has('mbuxId')){
                Yii::$app->session->remove('mbuxId');
            }
            return $this->redirect('/site/mbux');
        }


        /* @var $model AmgStaticTest */
        if (!Yii::$app->session->has('mbuxId')){
            Yii::$app->session->set('mbuxId', $model->id);
        }

        return $this->render('mbux', [
            'model' => $model,
        ]);
    }

    /**
     * Displays mag-drive Page.
     *
     * @var $amgDriveModel AmgDrive
     * @var $model ImageUpload
     *
     * @return mixed
     */
    public function actionAmgDrive()
    {
        if (!$amgDriveModel = AmgDrive::find()->where(['user_id' => Yii::$app->user->id])->one()){
            $amgDriveModel = new AmgDrive();
            $amgDriveModel->user_id = Yii::$app->user->id;
            $amgDriveModel->save();
        }

        $model = new ImageUpload();

        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstance($model, 'image');

            if ($amgDriveModel->savePhoto($model->uploadFile($file, $amgDriveModel->photo)))
            {
                $point = Yii::$app->params['PointTest']['amgDrive'];

                $userModel = $amgDriveModel->user;
                $userModel->amgDrive = $point;

                if ($userModel->save()){
                    $this->setEndQuest($userModel, 'amgDrive');

                    Yii::$app->session->setFlash('popupEndTest', [
                        'point' => $point,
                    ]);

                    return $this->goHome();

                }

                return $this->redirect('/site/amg-drive');
            }
        }

        return $this->render('amg-drive', [
            'model' => $model,
        ]);
    }

    /**
     * Displays mix-drive Page.
     *
     * @var $mixDriveModel MixDrive
     * @var $model ImageUpload
     *
     * @return mixed
     */
    public function actionMixDrive()
    {
        if (!$mixDriveModel = MixDrive::find()->where(['user_id' => Yii::$app->user->id])->one()){
            $mixDriveModel = new MixDrive();
            $mixDriveModel->user_id = Yii::$app->user->id;
            $mixDriveModel->save();
        }

        $model = new ImageUpload();

        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstance($model, 'image');

            if ($mixDriveModel->savePhoto($model->uploadFile($file, $mixDriveModel->photo)))
            {
                $point = Yii::$app->params['PointTest']['mixDrive'];

                $userModel = $mixDriveModel->user;
                $userModel->mixDrive = $point;

                if ($userModel->save()){
                    $this->setEndQuest($userModel, 'mixDrive');

                    Yii::$app->session->setFlash('popupEndTest', [
                        'point' => $point,
                    ]);

                    return $this->goHome();

                }

                return $this->redirect('/site/mix-drive');
            }
        }

        return $this->render('mix-drive', [
            'model' => $model,
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

            if (Yii::$app->session->has('trueAnswers')){
                $trueAnswerFromSession = Yii::$app->session->get('trueAnswers') + $trueAnswer;
                Yii::$app->session->set('trueAnswers', $trueAnswerFromSession);
            }else{
                Yii::$app->session->set('trueAnswers', $trueAnswer);
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

            $point = ceil(Yii::$app->session->get('trueAnswers')*$pointStep);

            $this->setEndQuest($userModel, 'xClassLine');

            $userModel->xClassLine = $point;
            $userModel->save();

            Yii::$app->session->setFlash('popupEndTest', [
                'point' => $point,
                'truAnswers' => [
                    'true' => Yii::$app->session->get('trueAnswers'),
                    'total' => $totalQuestion,
                ]
            ]);

            Yii::$app->session->remove('point');
            Yii::$app->session->remove('xClassLineTestId');
            Yii::$app->session->remove('trueAnswers');

            return $this->redirect('/');
        }

        return $this->render('x-class-line', [
            'questionModel' => $questionModel,
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
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignupStep1()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('signup-step-2');
                }
            }
        }

        return $this->render('signup-step-1', [
            'model' => $model,
        ]);
    }

    public function actionSignupStep2()
    {
        $model = new SignupFormStep2();
        $trainings = Training::find()->select(['id', 'date'])->asArray()->all();

        $trainingsArr = [];

        if (!empty($trainings)){
            foreach ($trainings as $training){
                $value = date("d.m.Y", (integer) $training['date']);
                $trainingsArr[$training['id']] = $value;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->setValue(Yii::$app->user->id)) {
                return $this->redirect('signup-step-3');
            }
        }

        return $this->render('signup-step-2', [
            'model' => $model,
            'trainingsArr' => $trainingsArr,
        ]);
    }

    public function actionSignupStep3()
    {
        $model = new SignupFormStep3();
        $dealerCenters = DealerCenter::find()->select(['id', 'title'])->asArray()->all();

        $dealerCentersArr = [];

        if (!empty($dealerCenters)){
            foreach ($dealerCenters as $training){
                $value = $training['title'];
                $dealerCentersArr[$training['id']] = $value;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->setValue(Yii::$app->user->id)) {

                return $this->redirect('signup-end');
            }
        }

        return $this->render('signup-step-3', [
            'model' => $model,
            'dealerCentersArr' => $dealerCentersArr,
        ]);
    }

    public function actionSignupEnd()
    {
        return $this->render('signup-end');
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
