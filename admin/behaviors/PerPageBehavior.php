<?php

namespace admin\behaviors;

use yii\base\Behavior;

class PerPageBehavior extends Behavior
{
    public $model = "default";
    public $default = 20;

    public function events()
    {
        return [];
    }

    public function setPerPage($value)
    {
        $_SESSION['admin'][__CLASS__][$this->model] = $value;
    }

    public function getPerPage()
    {
        if (!isset($_SESSION['admin'][__CLASS__][$this->model])) {
            return $this->default;
        }
        return $_SESSION['admin'][__CLASS__][$this->model];
    }

    public function clearPerPage()
    {
        unset($_SESSION['admin'][__CLASS__][$this->model]);
    }
}
