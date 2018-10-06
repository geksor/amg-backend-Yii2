<?php

namespace backend\controllers;

use common\models\ImageUpload;
use common\models\MbuxQuestion;
use common\models\MbuxQuestiontSearch;
use common\models\User;
use Yii;
use common\models\MbuxTest;
use common\models\MbuxTestSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MbuxTestController implements the CRUD actions for MbuxTest model.
 */
class MbuxTestController extends Controller
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
                            'question-view',
                            'question-create',
                            'question-update',
                            'set-photo',
                            'delete',
                            'question-delete',
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
     * Lists all MbuxTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MbuxTestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MbuxTest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new MbuxQuestiontSearch();
        $dataProvider = $searchModel->search(['MbuxQuestiontSearch' => ['mbux_test_id' => $id]]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MbuxTest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuestionView($id)
    {
        return $this->render('question-view', [
            'model' => MbuxQuestion::findOne($id),
        ]);
    }

    /**
     * Creates a new MbuxTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MbuxTest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new MbuxTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionQuestionCreate()
    {
        $model = new MbuxQuestion();

        $model->mbux_test_id = Yii::$app->request->get('parId');
        $parentTitle = Yii::$app->request->get('parTitle');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question-view', 'id' => $model->id]);
        }

        return $this->render('question-create', [
            'model' => $model,
            'parentTitle' => $parentTitle,
        ]);
    }

    /**
     * Updates an existing MbuxTest model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MbuxTest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuestionUpdate($id)
    {
        $model = MbuxQuestion::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question-view', 'id' => $model->id]);
        }

        return $this->render('question-update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MbuxTest model.
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
     * Finds the MbuxTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MbuxTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MbuxTest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetPhoto($id, $image)
    {
        $model = new ImageUpload();
        $question = MbuxQuestion::findOne($id);
        $questImage = '';
        switch ($image){
            case 1:
                $questImage = $question->image_1;
                break;
            case 2:
                $questImage = $question->image_2;
                break;
        }

        if (Yii::$app->request->isPost && Yii::$app->request->post('ImageUpload')['crop_info'])
        {
            $file = UploadedFile::getInstance($model, 'image');
            $cropInfo = Yii::$app->request->post('ImageUpload')['crop_info'];

            if ($question->savePhoto($model->uploadFile($file, $questImage, $cropInfo), $image))
            {
                return $this->redirect(['question-view', 'id' => $question->id]);
            }
        }

        return $this->render('set-photo', [
            'model' => $model,
            'question' => $question,
            'image' => $image,
        ]);
    }
}
