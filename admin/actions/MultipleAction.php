<?php

namespace admin\actions;

use ReflectionClass;
use Yii;
use yii\base\Action;
use yii\base\ErrorException;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class MultipleAction extends Action
{
    public $model = "";

    public function run()
    {
        if (empty($this->model)) {
            throw new ErrorException('Model name is not defined');
        }

        $selection = Yii::$app->request->post('selection');
        $type = Yii::$app->request->post('type');

        if (!empty($selection)) {
            foreach ($selection as $key) {

                $model = $this->model::findOne(['id' => $key]);

                if (!empty($model)) {
                    switch ($type) {
                        case 'activate':
                            $model->setActive($this->model::ACTIVE_YES);
                            break;
                        case 'deactivate':
                            $model->setActive($this->model::ACTIVE_NO);
                            break;
                        case 'delete':
                            $model->delete();
                            break;
                        default:
                    }
                }

            }
        }

        return Yii::$app->response->redirect(Url::previous());
    }
}
