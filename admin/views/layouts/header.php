<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>

<header class="main-header">

    <?= Html::a('
        <span class="logo-mini">
            <img src="' . Yii::$app->assetManager->getPublishedUrl('@adminDist') . '/i/logo/logo-white-square.png" alt="">
        </span>
        <span class="logo-lg"><img src="' . Yii::$app->assetManager->getPublishedUrl('@adminDist') . '/i/logo/logo-white.png"></span>
    ', '/', ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle admin-sidebar__button" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= Yii::$app->user->getIdentity()->name ?> (<?= Yii::$app->user->getIdentity()->login ?>)</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                            <p>
                                <?= Yii::$app->user->getIdentity()->name ?>
                                <small>Дата регистрации: <?= Yii::$app->formatter->asDatetime(Yii::$app->user->getIdentity()->created_at, "php:d.m.Y"); ?> г.</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выйти',
                                    ['/auth/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <!--
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                -->
            </ul>
        </div>
    </nav>
</header>
