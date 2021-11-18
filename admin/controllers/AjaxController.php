<?php

namespace admin\controllers;

use Yii;

class AjaxController extends AppController
{
    public function actionSwitcher($element)
    {
        $session = Yii::$app->session;
        switch ($element) {
            case 'sidebar':
                $value = $session->get('admin-switcher-sidebar');
                $value = empty($value) ? 1 : '';
                $session->set('admin-switcher-sidebar', $value);
                break;
            default:
        }
    }
}
