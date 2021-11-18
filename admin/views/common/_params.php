<?php

$this->params['dist'] = Yii::$app->assetManager->getPublishedUrl('@adminDist');
$this->params['controller'] = Yii::$app->controller->id;
$this->params['action'] = Yii::$app->controller->action->id;
$this->params['route'] = $this->context->route;
$this->params['path'] = '/' . $this->params['controller'];

$this->params['img_close'] = '<img src="' . $this->params['dist'] . '/i/close_owner.gif">';
$this->params['img_add_owner'] = '<img src="' . $this->params['dist'] . '/i/add_owner.gif">';
$this->params['img_open_owner'] = '<img src="' . $this->params['dist'] . '/i/open_owner.gif">';
$this->params['img_folder'] = '<img src="' . $this->params['dist'] . '/i/folder.gif">';
