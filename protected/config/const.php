<?php
/******************************************************************************/
/* Константы подключения к БД (используются в config.php)                     */
/******************************************************************************/
class DB_CONST {

	const HOST = 'localhost';
	const NAME = 'demo_yiiext';
	const USER = 'root';
	const PASSWORD = '';

}
/******************************************************************************/
/* Константы авторизации для хранения данных о пользвателе                    */
/******************************************************************************/
class AUTH_CONST {

	const ADMINISTRATOR	= 'Administrator';
	const SUPPORT		= 'Support';
	const USER			= 'User';
	const GUEST			= 'Guest';
	const IS_ADMIN		= 'isAdmin';
	const TITLE_NAME	= 'titleName';
	const LOGIN			= 'login';	
	const ROLE			= 'role';
	const ROLE_ID		= 'role_id';	
	const FULL_NAME		= 'full_Name';	
	const USER_ID		= 'user_id';
	const IS_ACTIVE		= 'is_active';

}
/******************************************************************************/
/* Разные константы                                                           */
/******************************************************************************/
class PARAMS_CONST {

	const EXT_JS_PATH = 'extJSPath';
	const CHANGED_ROWS = 'changedRows';

}
/******************************************************************************/
/* Константы для манипулрования данными в UI ExtJS                            */
/******************************************************************************/
class ACTION_CONST {
	
	const UPDATE_ACTION	= 'updateAction';
	const ACTION_OPEN	= 'Open';
	const VALUE_OPEN	= 'open';
	const CHANGED_ROWS	= 'changedRows';
	const BEFORE_ACTION	= 'beforeAction';
	const AFTER_ACTION	= 'afterAction';
	const ACTION_CLOSE	= 'Close';
	const VALUE_CLOSE	= 'close';
	const ACTION_ACCEPT	= 'Accept';
	
}
/******************************************************************************/
?>
