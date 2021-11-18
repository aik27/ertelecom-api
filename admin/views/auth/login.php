<?php

use common\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model LoginForm */

$this->render('../common/_params.php');

$this->title = 'Вход в систему :: ER-TELECOM';

?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?= Yii::$app->getHomeUrl() ?>"><img src="<?= $this->params['dist'] ?>/i/logo/logo-color.png" alt=""></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Вход в систему</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'login', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
            ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('Логин')]) ?>

        <?= $form
            ->field($model, 'password', [
                'options' => ['class' => 'form-group has-feedback'],
                'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
            ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('Пароль')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->label('Запомнить меня?')->checkbox() ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
