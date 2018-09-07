<?php

namespace backend\controllers;

use common\models\ImageUpload;
use Yii;
use common\models\MixStatic;
use common\models\MixStaticSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

/**
 * MixStaticController implements the CRUD actions for MixStatic model.
 */
class MixStaticController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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
                    'mix-static' => MixStatic::className()
                ]
            ],
        ];
    }

    /**
     * Lists all MixStatic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MixStaticSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MixStatic model.
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
     * Creates a new MixStatic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MixStatic();

        $maxRank = MixStatic::find()->max('rank');

        if ($maxRank){
            $model->rank = ++$maxRank;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MixStatic model.
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
     * Deletes an existing MixStatic model.
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
     * Finds the MixStatic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MixStatic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MixStatic::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetPhoto($id)
    {
        $model = new ImageUpload();
        $gallery = $this->findModel($id);

        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstance($model, 'image');
            $cropInfo = Yii::$app->request->post('ImageUpload')['crop_info'];

            if ($gallery->savePhoto($model->uploadFile($file, $gallery->image, $cropInfo)))
            {
                return $this->redirect(['view', 'id' => $gallery->id]);
            }
        }

        return $this->render('set-photo', [
            'model' => $model,
            'gallery' => $gallery,
        ]);
    }

    public function actionOrder($id, $order, $up)
    {
        if (Yii::$app->request->isAjax){
            $maxOrder = MixStatic::find()->max('rank');

            if ($order <= $maxOrder){

                $model = $this->findModel($id);

                $model->rank = (integer) $order;

                while (!$modelReplace = MixStatic::find()->where(['order' => $order])->one()){
                    $up ? $order-- : $order++;
                }

                $modelReplace->rank = $up ? ++$modelReplace->rank : --$modelReplace->rank;
                if ($modelReplace->rank === $model->rank){
                    $modelReplace->rank = $up ? ++$modelReplace->rank : --$modelReplace->rank;
                }

                if ($model->save() && $modelReplace->save()){
                    return $this->redirect(['index']);
                }
            }
            return $this->redirect(['index']);
        }
        return false;
    }
}
