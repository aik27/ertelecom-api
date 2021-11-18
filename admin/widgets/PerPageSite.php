<?php

namespace admin\widgets;

use yii\base\ErrorException;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class PerPageSite extends Widget
{
    public string $context;
    public int $default = 20;
    public array $range = [10, 20, 50, 100];

    public function init()
    {
        parent::init();

        if (empty($this->context)) {
            throw new ErrorException('Context property is empty');
        }

        if ($this->default <= 0) {
            throw new ErrorException('Default value must be bigger than zero');
        }

        if (empty($this->range)) {
            throw new ErrorException('Range array can\'t be empty');
        }

        foreach ($this->range as $value) {
            if (!is_int($value)) {
                throw new ErrorException('Range item must be an integer');
            }
        }
    }

    public function run() : string
    {
        $result = '<div class="admin-grid__perpage">Выводить по: ';
        $i = 1;
        foreach ($this->range as $item) {
            $result .=
                $this->default == $item ?
                    '<span class="text-bold">' . $item . '</span>' :
                    Html::a($item, $this->context . '/per-page?value=' . $item);

            if ($i < count($this->range)) {
                $result .= ', ';
            }
            $i++;
        }
        $result = trim($result);
        $result .= ' шт.';
        return $result;
    }
}
