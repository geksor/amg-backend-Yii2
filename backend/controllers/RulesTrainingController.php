<?php

namespace backend\controllers;

use backend\actions\SetImageFromSettings;
use common\models\RulesTraining;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * CallbackController implements the CRUD actions for Callback model.
 */
class RulesTrainingController extends Controller
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'set-map' => [
                'class' => SetImageFromSettings::className(),
                'folder' => 'rules_img',
                'propImage' => 'map',
                'title' => 'Изображение истории',
                'fromModel' => new RulesTraining(),
                'backLink' => 'rules-training',
                'width' => 1200,
                'height' => 2133,
            ],
        ];
    }


    /**
     * Lists all Callback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new RulesTraining();

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
