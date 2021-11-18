<?php

use yii\helpers\Html;
use yii\grid\GridView;
use admin\widgets\PerPageSite;
use admin\widgets\GridActionSite;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model yii\data\ActiveDataProvider */
/* @var $search common\models\WifiSpotSearch */
/* @var $perPage string */
/* @var $cities array */
/* @var $languages array */

$this->render('../common/_params.php');

$this->title = 'Wi-Fi точки доступа';
$this->params['breadcrumbs'][] = $this->title;

// grid actions
$action = GridActionSite::widget([
    'context' => $this->context->id,
    'add' => true,
    'delete' => true,
    'multiple' => true,
    'textAdd' => 'Добавить точку доступа',
]);

// make grid clickable
$this->registerJs("makeGridClickable('" . $this->context->id . "/update');");

$pagination = $model->getPagination();
$pagination->pageSizeParam = false;
$pagination->forcePageParam = false;
$pagination->route = Yii::$app->request->getPathInfo();

?>
<div class="<?= $this->context->id ?>-index form-grid">

    <?php
    echo $this->render('_search', [
        'model' => $search,
        'cities' => $cities,
        'languages' => $languages,
    ]);
    echo GridView::widget([
        'id' => 'grid',
        'dataProvider' => $model,
        //'filterModel' => $search,
        'tableOptions' => ['id' => 'grid-table', 'class' => 'table table-striped table-bordered'],
        'showHeader' => true,
        'showFooter' => false,
        'showOnEmpty' => true,
        'emptyCell' => '',
        'layout' => "{summary}{pager}" . $action . "{items}" . $action . "{pager}{summary}",
        'rowOptions' => function ($model, $key, $index, $grid) {
            $class = $index % 2 ? 'odd' : 'even';
            return ['id' => 'tr_' . $key, 'key' => $key, 'index' => $index, 'class' => $class];
        },
        'pager' => [
            'pagination' => $pagination,
            'firstPageLabel' => '< в начало',
            'lastPageLabel' => 'в конец >',
            'nextPageLabel' => 'вперёд >',
            'prevPageLabel' => '< назад',
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['style' => 'width:50px;text-align:center;'],
            ],
            [
                'attribute' => 'key',
                'format' => 'raw',
                'contentOptions' => ['style' => 'white-space:normal;'],
                'headerOptions' => ['style' => 'text-align:center;width:99%;'],
            ],
            [
                'attribute' => 'city_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->city->name;
                },
                'contentOptions' => ['style' => 'text-align:center;white-space:nowrap;'],
                'headerOptions' => ['style' => 'text-align:center;width:1%;'],
            ],
            [
                'attribute' => 'language_id',
                'label' => 'Язык',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->language->name;
                },
                'contentOptions' => ['style' => 'text-align:center;white-space:normal;'],
                'headerOptions' => ['style' => 'text-align:center;width:5%;'],
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'selection[]',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['style' => 'width:50px;text-align:center;'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{view}&nbsp;&nbsp;&nbsp;{activate}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}',
                'buttons' => [
                    'activate' => function ($url, $model, $key) {
                        return false;
                    },
                    'view' => function ($url, $model, $key) {
                        return false;
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            $url,
                            [
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => 'Редактировать'
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove text-danger"></span>',
                            $url,
                                [
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'bottom',
                                    'data-confirm' => "Вы уверены, что хотите удалить записи?",
                                    'title' => 'Удалить'
                                ]
                        );
                    },
                ]
            ],
        ],
    ]);
    echo PerPageSite::widget([
        'context' => $this->context->id,
        'default' => $perPage
    ]);
?>
</div>
