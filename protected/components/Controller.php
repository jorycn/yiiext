<?php
/******************************************************************************/
/* Модель, вспомогательные методы											  */
/******************************************************************************/
class Controller extends CController {
//----------------------------------------------------------------------------//
	public $layout = '//layouts/column1'; // layout по умолчанию
//----------------------------------------------------------------------------//	
	// Флаг для view с ExtJS или без, геттер и сеттер
	private $_isExtJS = false; 
	public function setIsExtJS($isExtJS) {
		$this->_isExtJS = $isExtJS;
	}
	public function getIsExtJS() {
		return $this->_isExtJS;
	}
//----------------------------------------------------------------------------//
	// Проверка доступа к Action
	public function accessRules() {
		return array(
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view'),
				'users' => array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('data', 'add', 'edit'),
				'expression' => 
					((Yii::app()->user->getState(AUTH_CONST::ROLE) == AUTH_CONST::SUPPORT) || (Yii::app()->user->getState(AUTH_CONST::ROLE) == AUTH_CONST::USER)) 
					? 'TRUE' : 'FALSE',
			),			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update'),
				'expression' => Yii::app()->user->getState(AUTH_CONST::IS_ADMIN, FALSE) ? 'TRUE' : 'FALSE',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete'),
				'expression' => Yii::app()->user->getState(AUTH_CONST::IS_ADMIN, FALSE) ? 'TRUE' : 'FALSE',
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}
/******************************************************************************/
//!!! АВТОГЕНЕРАЦИЯ !!!/////////////////////////////////////////////////////////
/******************************************************************************/
//----------------------------------------------------------------------------//
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
//----------------------------------------------------------------------------//
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
//----------------------------------------------------------------------------//
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}	
//----------------------------------------------------------------------------//
}
/******************************************************************************/
?>