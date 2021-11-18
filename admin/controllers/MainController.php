<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;

class MainController extends AppController
{
    public function actionError()
    {
        $this->layout = 'blank';

        return $this->render('error','');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
