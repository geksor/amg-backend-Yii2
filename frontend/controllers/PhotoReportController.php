<?php
namespace frontend\controllers;

use common\models\PhotoReport;
use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class PhotoReportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays report.
     *
     * @var $model PhotoReport
     * @return mixed
     */
    public function actionIndex()
    {
        /* @var $model PhotoReport */
        $models = PhotoReport::find()->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    public function actionReport($id)
    {
        /* @var $model PhotoReport */
        $model = PhotoReport::findOne($id);
        $images = $model->getBehavior('galleryBehavior')->getImages();

        return $this->render('report', [
            'model' => $model,
            'images' => $images,
        ]);
    }

}
