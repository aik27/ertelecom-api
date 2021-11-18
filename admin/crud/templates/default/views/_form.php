<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use <?= $generator->modelClass ?>;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */

$this->render('../common/_params.php');

if ($model->isNewRecord) {
    $this->title = 'Добавление записи';
    $buttonName = 'Добавить запись';
} else {
    $this->title = 'Редактирование записи';
    $buttonName = 'Редактировать запись';
}

$this->params['breadcrumbs'][] = [
    'label' => 'Страницы',
    'url' => '/' . $this->params['controller'],
];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="admin-<?= '<?= '?>$this->context->id ?>-edit">

    <?= "<?php " ?>$form = ActiveForm::begin(['id' => $this->context->id . '-form']); ?>

    <div class="form-button__box-top">
        <?= "<?php echo " ?> Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?> &nbsp;&nbsp;&nbsp;<a href="<?= '<?= '?>Url::previous() ?>">вернуться</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-category" data-id="fc-main">
                <?= '<?= '?>$this->params['img_folder'] ?>Основное
            </div>
            <div id="fc-main" class="collapse.in">
                <?= '<?php echo '?> $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название') ?>
                <?= '<?php /*echo '?> $form->field($model, 'description')->textarea(['rows' => 2])*/ ?>
                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo "    <?php //echo " . $generator->generateActiveField($attribute) . " ?>\n\n";
                    }
                } ?>
                <?= '<?php /*echo echo '?>$form->field($model, 'active')->checkbox(['label' => '- Активность записи']);*/ ?>
                <?= '<?php /*echo echo '?>$form->field($model, 'project_id')->label('Проект')->dropDownList($projects, ['prompt' => '---']);*/ ?>
                <?= '<?php /*echo '?> $form->field($model, 'date')->widget(DatePicker::class, [
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ])->label('Дата');*/ ?>
                <?= '<?php /*echo '?> $form->field($model, 'timer_date')->widget(DateTimePicker::class, [
                        'type' => DateTimePicker::TYPE_INPUT,
                        'pluginOptions' => [
                        'autoclose'=> true,
                        'format' => 'yyyy-mm-dd hh:ii:ss',
                    ]
                ])->label('Дата и время')*/ ?>
            </div>
        </div>
    </div>

    <div class="form-button__box-bottom">
        <?= '<?= '?> Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?> &nbsp;&nbsp;&nbsp;<a href="<?= '<?= '?>Url::previous() ?>">вернуться</a>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
