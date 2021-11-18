<?php

namespace admin\widgets;

use yii\base\ErrorException;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class GridActionSite extends Widget
{
    public bool $add = true;
    public bool $delete = true;
    public bool $sort = false;
    public bool $activate = false;
    public bool $multiple = false;
    public string $context;
    public array $action = [
        'add' => '/create',
        'multiple' => '/multiple',
        'sort' => '/position',
    ];
    public string $textAdd = 'Добавить запись';
    public array $tooltips = [
        'activate' => 'Опубликовать записи',
        'activate_confirm' => 'Вы уверены, что хотите опубликовать записи?',
        'deactivate' => 'Снять записи с публикации',
        'deactivate_confirm' => 'Вы уверены, что хотите снять записи с публикации?',
        'delete' => 'Удалить записи',
        'delete_confirm' => 'Вы уверены, что хотите удалить записи?',
    ];

    public function init()
    {
        parent::init();

        if (empty($this->context)) {
            throw new ErrorException('context property is empty');
        }
    }

    public function run() : string
    {
        $result = '<div class="admin-actions clearfix"><div class="admin-actions_add">';

        if ($this->sort === true) {
            $result .= Html::a(
                '<span class="glyphicon glyphicon-refresh"></span>',
                'javascript:',
                [
                    'onclick' => 'saveGridPosition("' . $this->context . $this->action['sort'] . '")',
                    "class" => "btn btn-primary form-position__refresh",
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
                    'title' => 'Пересчитать позиции'
                ]
            ) . '&nbsp;';
        }
        if ($this->add === true) {
            $result .= Html::a(
                $this->textAdd,
                [$this->context . $this->action['add']],
                ['class' => 'btn btn-success']
            );
        }

        $result .= '</div>';

        if ($this->multiple === true) {
            $result .= '<div class="admin-actions_multiple">';

                if ($this->activate === true) {
                    $result .= Html::submitButton('', [
                            'name' => 'grid_deactivate',
                            'value' => '1',
                            'class' => 'glyphicon glyphicon-ban-circle btn btn-warning',
                            //'data-confirm' => "Вы уверены, что хотите деактивировать записи?",
                            'onClick' => 'sendGridMultiple("' . $this->context . $this->action['multiple'] . '", "deactivate", "' . $this->tooltips['deactivate_confirm'] . '")',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'bottom',
                            'title' => $this->tooltips['deactivate']
                        ]);
                    $result .= ' ';
                    $result .= Html::submitButton('', [
                            'name' => 'grid_activate',
                            'value' => '1',
                            'class' => 'glyphicon glyphicon-check btn btn-success',
                            //'data-confirm' => "Вы уверены, что хотите активировать записи?",
                            'onClick' => 'sendGridMultiple("' . $this->context . $this->action['multiple'] . '", "activate", "' . $this->tooltips['activate_confirm'] . '")',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'bottom',
                            'title' => $this->tooltips['activate']
                        ]);
                    $result .= ' ';
                }

                if ($this->delete === true) {
                    $result .= Html::submitButton('', [
                            'name' => 'grid_delete',
                            'value' => '1',
                            'class' => 'glyphicon glyphicon-trash btn btn-danger',
                            //'data-confirm' => "Вы уверены, что хотите удалить записи?",
                            'onClick' => 'sendGridMultiple("' . $this->context . $this->action['multiple'] . '", "delete", "' . $this->tooltips['delete_confirm'] . '")',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'bottom',
                            'title' => $this->tooltips['delete']
                        ]);
                }

            $result .= '</div>';
        }
        $result .= '</div>';

        return $result;
    }
}
