<?php

namespace admin\controllers;

use common\models\LoginForm;
use Yii;

class AuthController extends AppController
{
    public function actionLogin()
    {
        $this->layout = 'blank';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Yii::$app->user->on(\yii\web\User::EVENT_AFTER_LOGIN, ['common\models\User', 'updateAfterLogin']);

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->on(\yii\web\User::EVENT_AFTER_LOGOUT, function ($event) {
            $user = $event->identity;
            $user->updateBeforeLogout();
        }, ['id' => Yii::$app->user->id]);

        Yii::$app->user->logout();

        return Yii::$app->getResponse()->redirect('/login');
    }
}
