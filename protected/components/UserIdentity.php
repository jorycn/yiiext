<?php
/******************************************************************************/
/* Авторизация пользоватея                                                    */
/******************************************************************************/
class UserIdentity extends CUserIdentity {
//----------------------------------------------------------------------------//	
	const ERROR_ROLE_INVALID = 1000;
	const ERROR_USER_NOT_ACTIVE = 1001;
//----------------------------------------------------------------------------//
	// Переопределение дистрибутивной аутентификации, на сонове свой таблицы 
	// пользователей и ролей	
	public function authenticate() {

		// По умолчанию - гостевой доступ
		$this->setState(AUTH_CONST::ROLE, AUTH_CONST::GUEST);
		$this->setState(AUTH_CONST::IS_ADMIN, FALSE);

		// получить данные по текущего пользователчя
		$currentUser = User::model()->findByAttributes(array(AUTH_CONST::LOGIN => $this->username));

		// Проверка данных введеных пользователем
		if ($currentUser == NULL)
			$this->errorCode = self::ERROR_USERNAME_INVALID;

		else if ($currentUser->password != sha1($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;

		else if ($currentUser->is_active != 1)
			$this->errorCode = self::ERROR_USER_NOT_ACTIVE;

		else {
			// nick и пароль совпали
			$this->setState('roleID', $currentUser->role_id);
			$currentRole = Role::model()->findByAttributes(array(AUTH_CONST::ROLE_ID => $currentUser->role_id));

			// role не нашлась :(
			if ($currentRole == NULL) {
				$this->errorCode = self::ERROR_ROLE_INVALID;
			} else {
				// Сохранение параметров пользователя в сессию
				$this->setState(AUTH_CONST::FULL_NAME,	$currentUser->full_name);
				$this->setState(AUTH_CONST::USER_ID,	$currentUser->user_id);
				$this->setState(AUTH_CONST::IS_ACTIVE,	$currentUser->is_active);
				$this->setState(AUTH_CONST::ROLE,		$currentRole->name);
				$this->setState(AUTH_CONST::IS_ADMIN,	($currentRole->name == AUTH_CONST::ADMINISTRATOR));
				$this->setState(AUTH_CONST::TITLE_NAME,	($currentUser->full_name != NULL) ? $currentUser->full_name : $this->username);
				$this->errorCode = self::ERROR_NONE;
			}
		}				
		return !$this->errorCode;
	}
//----------------------------------------------------------------------------//	
}
/******************************************************************************/
?>