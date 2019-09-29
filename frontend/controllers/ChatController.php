<?php
namespace frontend\controllers;

use common\models\Chat;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class ChatController extends Controller
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
                        'actions' => [
                            'index',
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
     * Displays chat.
     *
     * @var $userModel User
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect('/');
        }
        if (User::isAdmin(Yii::$app->user->id)){
            return $this->redirect('/admin');
        }

        $userModel = User::findOne(Yii::$app->user->id);

        $messages = Chat::find()
                    ->where(['training_id' => $userModel->training_id])
                    ->with('user')
                    ->orderBy(['create_at' => SORT_ASC])
                    ->all();

        return $this->render('index', [
            'messages' => $messages,
            'userModel' => $userModel,
        ]);
    }

}
