<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use <?= $generator->modelClass ?>;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">
    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => $this->context->id,
        'method' => 'get',
<?php if ($generator->enablePjax): ?>
        'options' => [
            'data-pjax' => 1
        ],
<?php endif; ?>
    ]); ?>
    <div class="form-search">
        <div id="form-filter-collapse">
            <div class="form-search__box">
                <?php echo "<?php echo"?> $form->field($model, 'id') ?>
                <?php echo "<?php echo"?> $form->field($model, 'name')->label('Название') ?>
                <?php /*echo "<?php echo" ?> $form->field($model, 'active')
                    ->dropDownList([
                            <?= StringHelper::basename($generator->modelClass) ?>::ACTIVE_YES => 'Да',
                            <?= StringHelper::basename($generator->modelClass) ?>::ACTIVE_NO => 'Нет',
                        ], ['prompt' => [
                        'text' => '---',
                        'options' => [
                            'value' => '',
                            'selected' => 'selected'
                        ],
                    ]])
                    ->label('Активность')*/ ?>
                <?php echo "<?php /*echo" ?> $form->field($model, 'complex_id')->widget(Select2::classname(), [
                    'data' => $complexes,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите ЖК ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('ЖК');*/ ?>
                <?php echo "<?php /*echo" ?> $form->field($model, 'date_start')->widget(DatePicker::class, [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ],
                ])->label('Дата');*/ ?>
                <?php
                foreach ($generator->getColumnNames() as $attribute) {
                    echo "                  <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n";
                }
                ?>
                <div class="form-search__break"></div>
                <div class="form-search__action">
                    <?= "<?= " ?>Html::submitButton('<span class="glyphicon glyphicon-search"></span> Искать', ['class' => 'btn btn-primary']) ?>
                    <a href="/<?= "<?= " ?>$this->context->id ?>" class="btn btn-outline-secondary">Очистить</a>
                </div>
            </div>
        </div>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
