<?php

namespace backend\controllers;

use common\models\ImageUpload;
use common\models\User;
use common\models\XClassLineAnswer;
use common\models\XClassLineQuestion;
use common\models\XClassLineQuestionTestSearch;
use Yii;
use common\models\XClassLineTest;
use common\models\XClassLineTestSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * XClassLineTestController implements the CRUD actions for XClassLineTest model.
 */
class XclassLineController extends Controller
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
                            'answer-create',
                            'answer-update',
                            'set-photo',
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
     * Lists all XClassLineTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new XClassLineTestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single XClassLineTest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new XClassLineQuestionTestSearch();
        $dataProvider = $searchModel->search(['XClassLineQuestionTestSearch' => ['xClass_line_test_id' => $id]]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single XClassLineQuestion model.
     * @param integer $id
     * @return mixed
     */
    public function actionQuestionView($id)
    {
        return $this->render('question-view', [
            'model' => XClassLineQuestion::findOne($id),
        ]);
    }

    /**
     * Creates a new XClassLineTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new XClassLineTest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new XClassLineQuestion model.
     * @param integer $parId
     * @param string $parTitle
     * If creation is successful, the browser will be redirected to the 'question-view' page.
     * @return mixed
     */
    public function actionQuestionCreate($parId, $parTitle)
    {
        $model = new XClassLineQuestion();
        $model->xClass_line_test_id = $parId;
        $model->answerCount = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question-view', 'id' => $model->id]);
        }

        return $this->render('question-create', [
            'model' => $model,
            'parentTitle' => $parTitle,
        ]);
    }

    /**
     * Creates a new XClassLineAnswer model.
     * @param integer $parId
     * @param string $parTitle
     * @param string $testTitle
     * @param integer $testId
     * @param integer $column
     * If creation is successful, the browser will be redirected to the 'question-view' page.
     * @return mixed
     */
    public function actionAnswerCreate($parId, $parTitle, $testTitle, $testId, $column)
    {
        $model = new XClassLineAnswer();
        $model->xClass_line_question_id = $parId;
        $model->column = $column;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            ++$model->xClassLineQuestion->answerCount;
            $model->xClassLineQuestion->save();

            return $this->redirect(['set-photo', 'id' => $model->id]);
        }

        return $this->render('answer-create', [
            'model' => $model,
            'parentTitle' => $parTitle,
            'testTitle' => $testTitle,
            'testId' => $testId,
        ]);
    }

    /**
     * Updates an existing XClassLineTest model.
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
     * Updates an existing XClassLineQuestion model.
     * If update is successful, the browser will be redirected to the 'question-view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuestionUpdate($id)
    {
        $model = $this->findQuestionModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question-view', 'id' => $model->id]);
        }

        return $this->render('question-update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing XClassLineTest model.
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
     * Deletes an existing XClassLineQuestion model.
     * If deletion is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuestionDelete($id)
    {
        $model = $this->findQuestionModel($id);
        $parId = $model->xClass_line_test_id;
        $model->delete();

        return $this->redirect(['view', 'id' => $parId]);
    }

    /**
     * Deletes an existing XClassLineAnswer model.
     * If deletion is successful, the browser will be redirected to the 'question-view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAnswerDelete($id)
    {
        $model = $this->findAnswerModel($id);
        $parId = $model->xClass_line_question_id;
        $model->delete();

        return $this->redirect(['question-view', 'id' => $parId]);
    }

    /**
     * Updates an existing XClassLineQuestion model.
     * If set is successful, the browser will be redirected to the 'question-view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSetPhoto($id)
    {
        $model = new ImageUpload();
        $answer = $this->findAnswerModel($id);

        if (Yii::$app->request->isPost && Yii::$app->request->post('ImageUpload')['crop_info'])
        {
            $file = UploadedFile::getInstance($model, 'image');
            $cropInfo = Yii::$app->request->post('ImageUpload')['crop_info'];

            if ($answer->savePhoto($model->uploadFile($file, $answer->image, $cropInfo)))
            {
                return $this->redirect(['question-view', 'id' => $answer->xClass_line_question_id]);
            }
        }

        return $this->render('set-photo', [
            'model' => $model,
            'answer' => $answer,
        ]);
    }

    /**
     * Finds the XClassLineTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return XClassLineTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = XClassLineTest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the XClassLineQuestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return XClassLineQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findQuestionModel($id)
    {
        if (($model = XClassLineQuestion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the XClassLineAnswer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return XClassLineAnswer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAnswerModel($id)
    {
        if (($model = XClassLineAnswer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Updates an existing XClassLineAnswer model.
     * If set is successful, the browser will be redirected to the 'question-view' page.
     * @param integer $id
     * @param integer $column
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionChangeColumn($id, $column)
    {
        $model = $this->findAnswerModel($id);
        $model->column = $column;

        $model->save();

        return $this->redirect(['question-view', 'id' => $model->xClass_line_question_id]);
    }
}
