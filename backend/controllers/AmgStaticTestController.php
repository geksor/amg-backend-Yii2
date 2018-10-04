<?php

namespace backend\controllers;

use common\models\AmgStaticAnswer;
use common\models\AmgStaticAnswerSearch;
use common\models\AmgStaticQuestion;
use common\models\AmgStaticQuestionSearch;
use common\models\ImageUpload;
use common\models\User;
use Yii;
use common\models\AmgStaticTest;
use common\models\AmgStaticTestSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AmgStaticTestController implements the CRUD actions for AmgStaticTest model.
 */
class AmgStaticTestController extends Controller
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
                            'question-index',
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
     * Lists all AmgStaticTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AmgStaticTestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all AmgStaticTest models.
     * @return mixed
     */
    public function actionQuestionIndex()
    {
        $searchModel = new AmgStaticQuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $testTitle = Yii::$app->request->get('testTitle');
        $parentId = Yii::$app->request->get('parId');

        return $this->render('question-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'testTitle' => $testTitle,
            'parentId' => $parentId,
        ]);
    }

    /**
     * Displays a single AmgStaticTest model.
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
     * Displays a single AmgStaticTest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuestionView($id)
    {
        $model = AmgStaticQuestion::findOne($id);

        $image_1 = $model->getAmgStaticAnswers()->where(['trueImage' => 1])->one();
        $image_2 = $model->getAmgStaticAnswers()->where(['trueImage' => 2])->one();
        $image_3 = $model->getAmgStaticAnswers()->where(['trueImage' => 3])->one();

        return $this->render('question-view', [
            'model' => $model,
            'image_1' => $image_1,
            'image_2' => $image_2,
            'image_3' => $image_3,
        ]);
    }

    /**
     * Creates a new AmgStaticTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AmgStaticTest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new AmgStaticTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionQuestionCreate()
    {
        $model = new AmgStaticQuestion();

        $testLink = Yii::$app->request->get('testLink');

        $model->amgStatic_test_id = $testLink['url']['id'];
        $model->answerCount = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question-view', 'id' => $model->id]);
        }

        return $this->render('question-create', [
            'model' => $model,
            'testLink' => $testLink,
        ]);
    }

    /**
     * Creates a new AmgStaticTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAnswerCreate()
    {
        $model = new AmgStaticAnswer();

        $testLink = Yii::$app->request->get('testLink');
        $parId = Yii::$app->request->get('parId');
        $parTitle = Yii::$app->request->get('parTitle');

        $model->amgStatic_question_id = $parId;
        $model->trueImage = Yii::$app->request->get('image');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->amgStaticQuestion->answerCount = ++$model->amgStaticQuestion->answerCount;
            $model->amgStaticQuestion->save();

            return $this->redirect(['question-view', 'id' => $parId]);
        }

        return $this->render('answer-create', [
            'model' => $model,
            'testLink' => $testLink,
            'parTitle' => $parTitle,
        ]);
    }

    /**
     * Updates an existing AmgStaticTest model.
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
     * Updates an existing AmgStaticTest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuestionUpdate($id)
    {
        $model = AmgStaticQuestion::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question-view', 'id' => $model->id]);
        }

        return $this->render('question-update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AmgStaticTest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAnswerUpdate($id)
    {
        $model = AmgStaticAnswer::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question-view', 'id' => $model->amgStaticQuestion->id]);
        }

        return $this->render('answer-update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AmgStaticTest model.
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
     * Deletes an existing AmgStaticTest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuestionDelete($id)
    {
        $model = AmgStaticQuestion::findOne($id);

        $testId = $model->amgStatic_test_id;
        $testTitle = $model->amgStaticTest->title;

        $model->delete();

        return $this->redirect(['question-index', 'TimetableSearch' => ['amgStatic_test_id' => $testId], 'testTitle' => $testTitle, 'parId' => $testId]);
    }

    /**
     * Deletes an existing AmgStaticTest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAnswerDelete($id)
    {
        $model = AmgStaticAnswer::findOne($id);

        $questId = $model->amgStatic_question_id;

        $model->delete();

        return $this->redirect(['question-view', 'id' => $questId]);
    }

    /**
     * Finds the AmgStaticTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AmgStaticTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AmgStaticTest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetPhoto($id)
    {
        $model = new ImageUpload();
        $question = AmgStaticQuestion::findOne($id);
        $image = Yii::$app->request->get('image');
        $questImage = '';
        switch ($image){
            case 1:
                $questImage = $question->image_1;
                break;
            case 2:
                $questImage = $question->image_2;
                break;
            case 3:
                $questImage = $question->image_3;
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
