<?php

namespace backend\controllers;

use common\models\User;
use common\models\VideoUpload;
use Yii;
use common\models\PhotoReport;
use common\models\PhotoReportSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * PhotoReportController implements the CRUD actions for PhotoReport model.
 */
class PhotoReportController extends Controller
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
                            'galleryApi',
                            'set-video',
                            'save-video',
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

    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'photo-report' => PhotoReport::className()
                ]
            ],
        ];
    }

    /**
     * Lists all PhotoReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotoReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhotoReport model.
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
     * Creates a new PhotoReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhotoReport();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PhotoReport model.
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
     * Deletes an existing PhotoReport model.
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
     * Finds the PhotoReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhotoReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhotoReport::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSetVideo($id)
    {
        $model = new VideoUpload();
        $gallery = $this->findModel($id);

        return $this->render('set-video', [
            'model' => $model,
            'gallery' => $gallery,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */

    public function actionSaveVideo($id)
    {
        $model = new VideoUpload();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $gallery = $this->findModel($id);

            $gallery->isVideoLoad = 0;
            $gallery->save();

            $file = UploadedFile::getInstance($model, 'video');
            $title = $model->title;

            if ($gallery->saveVideo($model->uploadFile($file, $gallery->video), $title))
            {
                return $this->render('_form-video', [
                    'model' => $model,
                    'message' => 'Видео загружено на сайт',
                    'id' => $gallery->id,
                ]);
            }else{
                return $this->render('_form-video', [
                    'model' => $model,
                    'message' => 'Не удалось выполнить загрузку',
                    'id' => $gallery->id,
                ]);
            }
        }
        return $this->redirect('index');
    }

}
