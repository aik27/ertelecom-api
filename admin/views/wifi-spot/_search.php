<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WifiSpotSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $cities array */
/* @var $languages array */

$fieldSearch = 'WifiSpotSearch';

?>

<div class="wifi-spot-search">
    <?php $form = ActiveForm::begin([
        'action' => $this->context->id,
        'method' => 'get',
    ]); ?>
    <div class="form-search">
        <div id="form-filter-collapse">
            <div class="form-search__box">
                <?php echo $form->field($model, 'id') ?>
                <?php echo $form->field($model, 'key') ?>
                <?php echo $form->field($model, 'city_id')->widget(Select2::classname(), [
                    'data' => $cities,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите город ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'pluginEvents' => [
                        "change" => 'function() {
                            const url = new URL(window.location.href);
                            if (url.searchParams.get("' . $fieldSearch . '[city_id]") != $(this).val()) {
                                url.searchParams.set("' . $fieldSearch . '[city_id]", $(this).val());
                            }
                            window.location.href = url.href;
                        }',
                    ],
                ])->label('Город'); ?>
                <?php echo $form->field($model, 'language_id')->widget(Select2::classname(), [
                    'data' => $languages,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите язык ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'pluginEvents' => [
                        "change" => 'function() {
                            const url = new URL(window.location.href);
                            if (url.searchParams.get("' . $fieldSearch . '[language_id]") != $(this).val()) {
                                url.searchParams.set("' . $fieldSearch . '[language_id]", $(this).val());
                            }
                            window.location.href = url.href;
                        }',
                    ],
                ])->label('Язык'); ?>
                <div class="form-search__break"></div>
                <div class="form-search__action">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Искать', ['class' => 'btn btn-primary']) ?>
                    <a href="/<?= $this->context->id ?>" class="btn btn-outline-secondary">Очистить</a>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $form = ActiveForm::begin([
        'id' => 'multipleForm',
        'action' => $this->context->id . '/change-language-multiple?' . Yii::$app->request->getQueryString(),
        'method' => 'get',
    ]); ?>
    <label class="control-label" for="multipleForm-action">Массовое действие с выборкой (затронет все записи по условиям фильтрации)</label>
    <div class="form-search">
        <div class="form-search__box pb-5" style="align-items: flex-end;padding-bottom: 10px">
            <div class="form-group field-multipleForm-action" style="flex:0 0 30%;">
                <label class="control-label">Новый язык</label>
                <div>
                    <?php echo Select2::widget([
                        'name' => 'languageId',
                        'data' => $languages,
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите язык ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
            </div>
            <?php echo Html::submitButton('<span class="glyphicon glyphicon-check"></span> Применить', ['class' => 'btn btn-danger', 'onclick' => 'if(confirm("Уверены?")) {return true} else {return false}']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
