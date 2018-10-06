<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use common\models\Timetable;
use common\models\TimetableSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimetableController implements the CRUD actions for Timetable model.
 */
class TimetableController extends Controller
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
                            'table',
                            'delete',
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Timetable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $training = Yii::$app->request->get('trainingDay');
        $day = Yii::$app->request->get('weekday');
        $dayName = $this->getDayName($day);
        $numberTraining = (string) $training == 1 ? '1' : '2';

        return $this->render('index', [
            'training' => $training,
            'day' => $day,
            'dayName' => $dayName,
            'numberTraining' => $numberTraining
        ]);
    }

    public function actionTable()
    {
        $searchModel = new TimetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        VarDumper::dump($dataProvider, 10, true);die;

        $training = Yii::$app->request->get('TimetableSearch')['trainingDay'];
        $day = Yii::$app->request->get('TimetableSearch')['weekday'];
        $dayName = $this->getDayName($day);
        $group = Yii::$app->request->get('TimetableSearch')['group'];
        $numberTraining = (string) $training == 1 ? '1' : '2';

        return $this->render('table', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'training' => $training,
            'day' => $day,
            'dayName' => $dayName,
            'group' => $group,
            'numberTraining' => $numberTraining
        ]);
    }

    public function getDayName ($day)
    {
        switch ($day){
            case 1:
                return 'Понедельник';
            case 2:
                return 'Вторник';
            case 3:
                return 'Среду';
            case 4:
                return 'Четверг';
            case 5:
                return 'Пятницу';
            default:
                return null;
        }
    }

    /**
     * Displays a single Timetable model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $dayName = $this->getDayName($model->weekday);


        return $this->render('view', [
            'model' => $model,
            'dayName' => $dayName,
        ]);
    }

    /**
     * Creates a new Timetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Timetable();

        $training = Yii::$app->request->get('trainingDay');
        $day = Yii::$app->request->get('weekday');
        $dayName = $this->getDayName($day);
        $group = Yii::$app->request->get('group');
        $numberTraining = (string) $training == 1 ? '1' : '2';

//        if ($model->load(Yii::$app->request->post())){
//            VarDumper::dump($model, 10, true);die;
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'training' => $training,
            'day' => $day,
            'dayName' => $dayName,
            'group' => $group,
            'numberTraining' => $numberTraining
        ]);
    }

    /**
     * Updates an existing Timetable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dayName = $this->getDayName($model->weekday);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dayName' => $dayName,
        ]);
    }

    /**
     * Deletes an existing Timetable model.
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
     * Finds the Timetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Timetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timetable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
