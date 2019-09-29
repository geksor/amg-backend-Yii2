<?php

namespace backend\controllers;

use common\models\PointTest;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * CallbackController implements the CRUD actions for Callback model.
 */
class PointTestController extends Controller
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
                            'login',
                        ],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [
                            'error',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isAdmin(Yii::$app->user->id);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Callback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new PointTest();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                if ($model->save()){
                    Yii::$app->session->setFlash('success', 'Операция выполнена успешно');
                }else{
                    Yii::$app->session->setFlash('error', 'Что то пошло не так, попробуйте еще раз.');
                };
                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
