<?php

namespace admin\actions;

use admin\interfaces\PositionInterface;
use ReflectionClass;
use Yii;
use yii\base\Action;
use yii\base\ErrorException;
use yii\helpers\Url;

class PositionAction extends Action
{
    public $model = "";
    public $field = "position";
    public $isDraggable = false;
    public $draggableField = "grid-table";

    public function run()
    {
        if (empty($this->model)) {
            throw new ErrorException('Model name is not defined');
        }

        $reflection = new ReflectionClass($this->model);

        if (!$reflection->implementsInterface(PositionInterface::class)) {
            throw new ErrorException("To use this action model " . $this->model . "  must implement " . PositionInterface::class);
        }

        $position = Yii::$app->request->post($this->field);
        $draggable = Yii::$app->request->post($this->draggableField);

        if (!empty($position)) {
            $this->model::setPositionAll($position);

            return Yii::$app->response->redirect(Url::previous());
        } elseif (!empty($draggable) and $this->isDraggable === true) {
            $data = [];

            foreach ($draggable as $item) {
                $item = str_replace('tr_', '', $item);
                $data[$item] = $item;
            }

            $i = $this->model::find()->where(['IN', 'id', $data])->min('position');

            foreach ($data as $key => $item) {
                $data[$key] = $i;
                $i += 2;
            }

            if (!empty($data)) {
                $this->model::setPositionAll($data);
            }

        } else {
            throw new ErrorException('Empty position variable');
        }

    }
}
