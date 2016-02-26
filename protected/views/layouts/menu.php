<?php

$this->widget('zii.widgets.CMenu', array(
	'items' => array(
		array('label' => 'index', 'url' => array('/site/index')),
		/* 				
		  array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
		  array('label'=>'Contact', 'url'=>array('/site/contact')),
		 */
		array('label' => 'role', 'url' => array('/role'), 'visible' => Yii::app()->user->getState(AUTH_CONST::IS_ADMIN, FALSE)),
		array('label' => 'user', 'url' => array('/user'), 'visible' => Yii::app()->user->getState(AUTH_CONST::IS_ADMIN, FALSE)),
		array('label' => 'status', 'url' => array('/status'), 'visible' => Yii::app()->user->getState(AUTH_CONST::IS_ADMIN, FALSE)),
		array('label' => 'issue', 'url' => array('/issue'), 'visible' => !Yii::app()->user->isGuest),
		array('label' => 'message', 'url' => array('/message'), 'visible' => Yii::app()->user->getState(AUTH_CONST::IS_ADMIN, FALSE)),
		array('label' => 'login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
		array('label' => 'logout (' . Yii::app()->user->getState(AUTH_CONST::TITLE_NAME, Yii::app()->user->name) . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
		)));
?>