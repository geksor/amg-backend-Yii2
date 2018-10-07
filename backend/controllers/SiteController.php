<?php
namespace backend\controllers;

use backend\models\IntelligentSelectForm;
use backend\models\IntelligentUserPointForm;
use common\models\Training;
use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],

                    ],
                    [
                        'actions' => [
                            'logout',
                            'index',
                            'intel-user',
                            'intel-user-point',
                            'error',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isAdmin(Yii::$app->user->identity->username);
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @var $selectModel IntelligentSelectForm
     *
     * @return string
     */
    public function actionIndex()
    {
        $trainings = Training::find()->select(['id', 'date'])->asArray()->all();

        $selectModel = new IntelligentSelectForm();

        if ($selectModel->load(Yii::$app->request->post())){
            return $this->redirect(['intel-user', 'trainingId' => $selectModel->training_id]);
        }

        $trainingsArr = [];

        if (!empty($trainings)){
            foreach ($trainings as $training){
                $value = date("d.m.Y", (integer) $training['date']);
                $trainingsArr[$training['id']] = $value;
            }
        }

        return $this->render('index', [
            'trainingsArr' => $trainingsArr,
            'selectModel' => $selectModel,
        ]);
    }

    /**
     * Displays intel-user.
     *
     *
     * @return string
     */
    public function actionIntelUser($trainingId = null)
    {

        $query = User::find()->where(['role' => [3,4], 'moderatorPoints' => 0]);
        if ($trainingId){
            $query->andwhere(['training_id' => $trainingId]);
        }
        $query->orderBy(['surname'=> SORT_ASC, 'totalPoint' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        Yii::$app->session->set('backIntelUser', ['intel-user', 'trainingId' => $trainingId]);

        return $this->render('intel-user', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays intel-user-point.
     *
     * @var $selectModel IntelligentSelectForm
     *
     * @return string
     */
    public function actionIntelUserPoint()
    {
        $intelPointForm = new IntelligentUserPointForm();
        if (Yii::$app->request->post('checkUsers')){
            $usersId = explode(',', Yii::$app->request->post('checkUsers'));

            $intelPointForm->usersId = Yii::$app->request->post('checkUsers');

            $query = User::find()->where(['role' => [3,4], 'id' => $usersId]);
            $query->orderBy(['totalPoint' => SORT_DESC]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }

        if ($intelPointForm->load(Yii::$app->request->post())){

            $usersId = explode(',', $intelPointForm->usersId);

            $userModels = User::find()->where(['id' => $usersId])->all();

            foreach ($userModels as $userModel){
                /* @var $userModel User */
                $userModel->moderatorPoints = $intelPointForm->point;
                $userModel->save();
            }

            return $this->redirect(Yii::$app->session->get('backIntelUser'));

        }

        return $this->render('intel-user-point', [
            'dataProvider' => $dataProvider,
            'intelPointForm' => $intelPointForm,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
