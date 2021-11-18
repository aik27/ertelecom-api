<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\City;
use common\models\Language;
use common\models\WifiSpot;
use common\models\WifiSpotSearch;

class WifiSpotController extends Controller
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => 'admin\actions\DeleteAction',
                'model' => WifiSpot::class
            ],
            'multiple' => [
                'class' => 'admin\actions\MultipleAction',
                'model' => WifiSpot::class,
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'PerPage' => [
                'class' => 'admin\behaviors\PerPageBehavior',
                'model' => self::class,
                'default' => 20,
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'multiple' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        Url::remember();

        $search = new WifiSpotSearch();
        $model = $search->search(Yii::$app->request->queryParams, $this->getPerPage());

        return $this->render('index', [
            'search' => $search,
            'model' => $model,
            'cities' => City::getList(),
            'languages' => Language::getList(),
            'perPage' => $this->getPerPage(),
        ]);
    }

    public function actionCreate()
    {
        $record  = new WifiSpot();

        if ($record->load(Yii::$app->request->post()) && $record->validate()) {
            if ($record->save()) {
                return $this->goBack();
            }
        }
        return $this->render('_form', [
            'model' => $record,
            'cities' => City::getList(),
            'languages' => Language::getList(),
        ]);
    }

    public function actionUpdate($id)
    {
        $record  = WifiSpot::findOne(['id' => $id]);

        if ($record->load(Yii::$app->request->post()) && $record->validate()) {
            if ($record->save()) {
                return $this->goBack();
            }
        }
        return $this->render('_form', [
            'model' => $record,
            'cities' => City::getList(),
            'languages' => Language::getList(),
        ]);
    }

    public function actionChangeLanguageMultiple($languageId)
    {
        $search = new WifiSpotSearch();
        $conditions = $search->getGridConditions(Yii::$app->request->queryParams);

        WifiSpot::updateAll(['language_id' => $languageId], $conditions);

        return $this->goBack();
    }

    public function actionPerPage(int $value)
    {
        $this->setPerPage($value);
        return $this->goBack();
    }
}
