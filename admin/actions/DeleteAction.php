<?php

namespace admin\actions;

use Yii;
use yii\base\Action;
use yii\base\ErrorException;
use yii\helpers\Url;

class DeleteAction extends Action
{
    public $model = "";

    public function run()
    {
        if (empty($this->model)) {
            throw new ErrorException('Model name is not defined');
        }

        $id = Yii::$app->request->get('id');
        $model = $this->model::findOne(['id' => $id]);

        if (!empty($model)) {
            $model->delete();
        }

        return Yii::$app->response->redirect(Url::previous());
    }
}
