<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WifiSpot */
/* @var $form yii\widgets\ActiveForm */
/* @var $cities array */
/* @var $languages array */

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

<div class="admin-<?= $this->context->id ?>-edit">

    <?php $form = ActiveForm::begin(['id' => $this->context->id . '-form']); ?>

    <div class="form-button__box-top">
        <?php echo  Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?> &nbsp;&nbsp;&nbsp;<a href="<?= Url::previous() ?>">вернуться</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-category" data-id="fc-main">
                <?= $this->params['img_folder'] ?>Основное
            </div>
            <div id="fc-main" class="collapse.in">
                <?php echo $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'city_id')->widget(Select2::classname(), [
                    'data' => $cities,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите город ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('Город'); ?>
                <?php echo $form->field($model, 'language_id')->widget(Select2::classname(), [
                    'data' => $languages,
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите язык ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>
    </div>

    <div class="form-button__box-bottom">
        <?=  Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?> &nbsp;&nbsp;&nbsp;<a href="<?= Url::previous() ?>">вернуться</a>
    </div>

    <?php ActiveForm::end(); ?>
</div>
