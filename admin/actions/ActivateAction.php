<?php

namespace admin\actions;

use admin\interfaces\ActivateInterface;
use ReflectionClass;
use Yii;
use yii\base\Action;
use yii\base\ErrorException;
use yii\helpers\Url;

class ActivateAction extends Action
{
    public $model = "";

    public function run()
    {
        if (empty($this->model)) {
            throw new ErrorException('Model name is not defined');
        }

        $reflection = new ReflectionClass($this->model);

        if (!$reflection->implementsInterface(ActivateInterface::class)) {
            throw new ErrorException("To use this action model " . $this->model . "  must implement " . ActivateInterface::class);
        }

        $id = Yii::$app->request->get('id');
        $model = $this->model::findOne(['id' => $id]);

        if (!empty($model)) {
            $model->switchActive();
        }

        return Yii::$app->response->redirect(Url::previous());
    }
}
