<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LanguageSearch */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="language-search">
    <?php $form = ActiveForm::begin([
        'action' => $this->context->id,
        'method' => 'get',
    ]); ?>
    <div class="form-search">
        <div id="form-filter-collapse">
            <div class="form-search__box">
                <?php echo $form->field($model, 'id') ?>
                <?php echo $form->field($model, 'name') ?>
                <?php echo  $form->field($model, 'code')->textInput(['maxlength' => true])->label('Код языка') ?>
                <div class="form-search__break"></div>
                <div class="form-search__action">
                    <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> Искать', ['class' => 'btn btn-primary']) ?>
                    <a href="/<?= $this->context->id ?>" class="btn btn-outline-secondary">Очистить</a>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
