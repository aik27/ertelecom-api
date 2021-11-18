<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
    public function goHome()
    {
        return Yii::$app->getResponse()->redirect('/');
    }
}
