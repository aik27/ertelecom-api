<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{
    public function actions()
    {
        return [
            'activate' => [
                'class' => 'admin\actions\ActivateAction',
                'model' => <?= $modelClass ?>::class,
                //'field' => 'active'
            ],
            'delete' => [
                'class' => 'admin\actions\DeleteAction',
                'model' => <?= $modelClass ?>::class
            ],
            'multiple' => [
                'class' => 'admin\actions\MultipleAction',
                'model' => <?= $modelClass ?>::class,
                //'fieldActive' => 'active',
            ],
            'position' => [
                'class' => 'admin\actions\PositionAction',
                'model' => <?= $modelClass ?>::class,
                'field' => 'position',
                'isDraggable' => true,
                'draggableField' => 'grid-table',
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'PerPage' => [
                'class' => 'admin\behaviors\PerPageBehavior',
                'model' => self::class,
                'default' => 20,
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'multiple' => ['post'],
                    'position' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        Url::remember();

<?php if (!empty($generator->searchModelClass)): ?>
        $search = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        $model = $search->search(Yii::$app->request->queryParams, $this->getPerPage());

        return $this->render('index', [
            'search' => $search,
            'model' => $model,
            'perPage' => $this->getPerPage(),
        ]);
<?php else: ?>
        $model = new ActiveDataProvider([
            'query' => <?= $modelClass ?>::find(),
        ]);

        return $this->render('index', [
            'model' => $model,
            'perPage' => $this->getPerPage(),
        ]);
<?php endif; ?>
    }

    public function actionCreate()
    {
        $record  = new <?= $modelClass ?>();

        if ($record->load(Yii::$app->request->post()) && $record->validate()) {
            if ($record->save()) {
                /*
                $record->setPosition();
                */
                return $this->goBack();
            }
        }
        return $this->render('_form', [
            'model' => $record,
        ]);
    }

    public function actionUpdate($id)
    {
        $record  = <?= $modelClass ?>::findOne(['id' => $id]);

        if ($record->load(Yii::$app->request->post()) && $record->validate()) {
            if ($record->save()) {
                return $this->goBack();
            }
        }
        return $this->render('_form', [
            'model' => $record,
        ]);
    }

    public function actionPerPage(int $value)
    {
        $this->setPerPage($value);
        return $this->goBack();
    }
}
