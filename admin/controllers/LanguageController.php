<?php

namespace admin\controllers;

use Yii;
use common\models\Language;
use common\models\LanguageSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class LanguageController extends Controller
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => 'admin\actions\DeleteAction',
                'model' => Language::class
            ],
            'multiple' => [
                'class' => 'admin\actions\MultipleAction',
                'model' => Language::class,
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

        $search = new LanguageSearch();
        $model = $search->search(Yii::$app->request->queryParams, $this->getPerPage());

        return $this->render('index', [
            'search' => $search,
            'model' => $model,
            'perPage' => $this->getPerPage(),
        ]);
    }

    public function actionCreate()
    {
        $record  = new Language();

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
        $record  = Language::findOne(['id' => $id]);

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
