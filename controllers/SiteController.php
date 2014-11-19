<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Employee;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Employee;
        $model->scenario = 'search';
        $dataProvider = $model->search(Yii::$app->request->get());

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
