<?php

namespace admin\controllers;

use Yii;
use common\models\City;
use common\models\CitySearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class CityController extends Controller
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => 'admin\actions\DeleteAction',
                'model' => City::class
            ],
            'multiple' => [
                'class' => 'admin\actions\MultipleAction',
                'model' => City::class,
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

        $search = new CitySearch();
        $model = $search->search(Yii::$app->request->queryParams, $this->getPerPage());

        return $this->render('index', [
            'search' => $search,
            'model' => $model,
            'perPage' => $this->getPerPage(),
        ]);
    }

    public function actionCreate()
    {
        $record  = new City();
        if ($record->load(Yii::$app->request->post()) && $record->validate()) {
            if ($record->save()) {
                return $this->goBack();
            }
        }
        return $this->render('_form', [
            'model' => $record,
        ]);
    }

    public function actionUpdate($id)
    {
        $record  = City::findOne(['id' => $id]);

        if ($record->load(Yii::$app->request->post()) && $record->validate()) {
            if ($record->save()) {
                return $this->goBack();
            }
        }
        return $this->render('_form', [
            'model' => $record,
        ]);
    }

    public function actionPerPage(int $value)
    {
        $this->setPerPage($value);
        return $this->goBack();
    }
}
