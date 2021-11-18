<?php

namespace api\controllers\wifi;

use common\models\WifiSpot;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class SpotController extends Controller
{
    public function actionIndex() : ActiveDataProvider
    {
        $query = WifiSpot::find()->with(['city', 'language']);
        return  new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [0, 100]
            ]
        ]);
    }

    public function actionView($id) : WifiSpot
    {
        $spot = WifiSpot::find()
            ->with(['city', 'language'])
            ->where(['id' => $id])
            ->limit(1)
            ->one();

        if (empty($spot)) {
            throw new NotFoundHttpException('Record not found');
        }

        return $spot;
    }

    public function actionLanguage($id) : string
    {
        $spot = WifiSpot::find()
            ->with(['city', 'language'])
            ->where(['id' => $id])
            ->limit(1)
            ->one();

        if (empty($spot)) {
            throw new NotFoundHttpException('Record not found');
        }

        return $spot->language->code;
    }
}
