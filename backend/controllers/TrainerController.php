<?php

namespace backend\controllers;

use backend\models\ChangePassword;
use common\models\DealerCenter;
use common\models\Training;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],

                    ],
                    [
                        'actions' => [
                            'logout',
                            'error',
                            'index',
                            'view',
                            'create',
                            'update',
                            'change-password',
                        ],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = User::find()->where(['role' => 2]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * change-password
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionChangePassword($id)
    {
        $modelForm = new ChangePassword();

        $modelForm->userId = $id;

        if ($modelForm->load(Yii::$app->request->post())){
            if ($modelForm->setPassword()){
                return $this->redirect(['view', 'id' => $modelForm->userId]);
            }
        }

        return $this->render('change-password', [
            'model' => $this->findModel($id),
            'modelForm' => $modelForm,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $trainings = Training::find()->select(['id', 'date'])->asArray()->all();

        $trainingsArr = [];

        if (!empty($trainings)){
            foreach ($trainings as $training){
                $value = date("d.m.Y", (integer) $training['date']);
                $trainingsArr[$training['id']] = $value;
            }
        }

        return $this->render('update', [
            'model' => $model,
            'trainingsArr' => $trainingsArr,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Заправшиваемая страница не найдена.');
    }
}
