<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Language */
/* @var $form yii\widgets\ActiveForm */

$this->render('../common/_params.php');

if ($model->isNewRecord) {
    $this->title = 'Добавление языка';
    $buttonName = 'Добавить язык';
} else {
    $this->title = 'Редактирование языка';
    $buttonName = 'Редактировать';
}

$this->params['breadcrumbs'][] = [
    'label' => 'Языки',
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
                <?php echo  $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?php echo  $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="form-button__box-bottom">
        <?=  Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?> &nbsp;&nbsp;&nbsp;<a href="<?= Url::previous() ?>">вернуться</a>
    </div>

    <?php ActiveForm::end(); ?>
</div>
