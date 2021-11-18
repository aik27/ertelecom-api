<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use <?= $generator->modelClass ?>;
use yii\helpers\Html;
use yii\helpers\Url;
use admin\widgets\GridActionSite;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model yii\data\ActiveDataProvider */
/* @var $search */
/* @var $perPage string */

$this->render('../common/_params.php');

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;

// grid actions
$action = GridActionSite::widget([
    'context' => $this->context->id,
    'add' => true,
    'delete' => true,
    'multiple' => true,
]);

// make grid clickable
$this->registerJs("makeGridClickable('" . $this->context->id . "/update');");

$pagination = $model->getPagination();
$pagination->pageSizeParam = false;
$pagination->forcePageParam = false;
$pagination->route = Yii::$app->request->getPathInfo();

?>
<div class="<?= '<?= $this->context->id ?>' ?>-index form-grid">

    <?php echo "<?php\n";?>
    echo $this->render('_search', [
        'model' => $search,
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
            /*
            [
                'attribute' => 'position',
                'label' => 'Позиция',
                'filter' => false,
                'format' => 'raw',
                'value' => function ($model) {
                    return '<input type="textbox" name="position[' . $model->id . ']" value="' . $model->position . '" class="form-control form-position" style="text-align:center;width:50px;">';
                },
                'headerOptions' => ['style' => 'width:50px; text-align:center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
            ],
            */
            [
                'attribute' => 'id',
                'label' => 'ID',
                'format' => 'raw',
                'contentOptions' => ['style' => 'text-align: center;'],
                'headerOptions' => ['style' => 'width:50px;text-align:center;'],
            ],
            [
                'attribute' => 'name',
                'label' => 'Название',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->name;
                },
                'contentOptions' => ['style' => 'white-space:normal;'],
                'headerOptions' => ['style' => 'text-align:center;width:99%;'],
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
    echo $this->render('../common/_grid-perpage.php', ['perPage' => $perPage]);
?>
</div>
