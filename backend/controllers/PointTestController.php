<?php

namespace backend\controllers;

use common\models\PointTest;
use Yii;
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
            if ($model->validate() && Yii::$app->request->post()) {
                $tempParams = json_encode(Yii::$app->request->post('PointTest'));
                $setPath = dirname(dirname(__DIR__)).'/common/config/testPoint.json';
                file_put_contents($setPath , $tempParams);
                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
