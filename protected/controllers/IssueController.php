<?php
/******************************************************************************/
/* Контроллер тем (основаная страница поддержки)							  */ 
/******************************************************************************/
/******************************************************************************/
//!!! АВТОГЕНЕРАЦИЯ ////////////////////////////////////////////////////////////
/******************************************************************************/
class IssueController extends Controller {
//----------------------------------------------------------------------------//
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}
//----------------------------------------------------------------------------//
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Issue;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Issue'])) {
			$model->attributes = $_POST['Issue'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->issue_id));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}
//----------------------------------------------------------------------------//
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Issue'])) {
			$model->attributes = $_POST['Issue'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->issue_id));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}
//----------------------------------------------------------------------------//
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
//----------------------------------------------------------------------------//
	/**
	 * Lists all models.
	 */
	public function actionIndex() {

		$dataProvider = new CActiveDataProvider('Issue');

		if (Yii::app()->user->isGuest) {
			$this->redirect('site/login');
		} else {
			if (Yii::app()->user->isAdmin) {
				$this->isExtJS = false;
				$this->render('index', array(
					'dataProvider' => $dataProvider,));
			} /* else {
			  $this->layout = '//layouts/extjs';
			  $this->render(Yii::app()->user->role, array(
			  'dataProvider' => $dataProvider,
			  ));
			  } */ else {
				$this->layout = '//layouts/extjs';
				$this->render('user', array(
					'dataProvider' => $dataProvider,
				));
			}
		}
	}
//----------------------------------------------------------------------------//
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Issue('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Issue']))
			$model->attributes = $_GET['Issue'];

		$this->render('admin', array(
			'model' => $model,
		));
	}
//----------------------------------------------------------------------------//
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model = Issue::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
//----------------------------------------------------------------------------//
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'issue-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
//----------------------------------------------------------------------------//
	// Передача данных в ExtJS через views/issue/extjs/data.php
	public function actionData() {
		$this->renderPartial('extjs/data');
	}
//----------------------------------------------------------------------------//
	// Преобразование запроса в JSON для передачи в ExtJS
	public function toJson() {

		if (!Yii::app()->user->isGuest) {

			$issue = Issue::model();

			$command = Yii::app()->db->createCommand();
			$command->select('*');

			$command->from('v_issue i');

			switch (Yii::app()->user->role) {
				case AUTH_CONST::SUPPORT:
					// issue видит сови и ничьи темы
					$command->where('support_login = :support_login or support_login is null', array(':support_login' => Yii::app()->user->name));
					break;
				case AUTH_CONST::USER:
					// Пользователь види только свои темы
					$command->where('client_login = :client_login', array(':client_login' => Yii::app()->user->name));
					break;
				default:
					// Другии не разрешено
					$this->redirect('/site/index');
					Yii::app()->end();
					break;
			}

			$command->order('is_closed, issue_date desc');

			$result = $command->queryAll();

			return CJSON::encode(array(
						'success' => true,
						'Issue' => $result,
						'total' => count($result)
					));
		}
	}
//----------------------------------------------------------------------------//
	// Создание новоq темы, вызывается из ExtJS
	public function actionAdd() {
		if (Yii::app()->user->role == AUTH_CONST::USER) {

			$modelIssue = new Issue;
			$modelStatus = Status::model()->findByAttributes(array('name' => 'not open'));
			$issue = CJSON::decode($_POST['Issue']);
			$issue['client_id'] = Yii::app()->user->getState(AUTH_CONST::USER_ID);
			$issue['status_id'] = $modelStatus ? $modelStatus->status_id : 1;
			$issue['is_changed'] = 1;

			if ($modelIssue->add($issue)) {
				$modelMessage = new Message;
				$message['issue_id'] = $modelIssue->issue_id;
				$message['user_id'] = $issue['client_id'];
				$message['msg_text'] = $issue['msg_text'];
				$modelMessage->add($message);
			}

			Yii::app()->end();
		}
	}
//----------------------------------------------------------------------------//
/*	
	private function updateIssue($issue) {

		Yii::log(print_r($issue, TRUE));

		$model = $this->loadModel($issue['issue_id']);

		if ($issue[ACTION_CONST::UPDATE_ACTION] == ACTION_CONST::ACTION_OPEN) {
			$modelStatus = Status::model()->findByAttributes(array('name' => ACTION_CONST::VALUE_OPEN));
			//$beforeStatus = $model->status_id;
			$model->status_id = $modelStatus->status_id;
			$model->support_id = Yii::app()->user->getState(AUTH_CONST::USER_ID);
			$model->is_changed = 1;
		}

		if ($issue[ACTION_CONST::UPDATE_ACTION] == ACTION_CONST::ACTION_CLOSE) {
			$modelStatus = Status::model()->findByAttributes(array('name' => ACTION_CONST::VALUE_CLOSE));
			$model->status_id = $modelStatus->status_id;
			$model->close_date = date('Y-m-d H:i:s');
			$model->is_closed = TRUE;
			$model->is_changed = 1;
		}

		if ($issue[ACTION_CONST::UPDATE_ACTION] == ACTION_CONST::ACTION_ACCEPT) {
			$model->is_changed = 0;
		}

		$model->save();
	}
  */
//----------------------------------------------------------------------------//
	// Запросы из ExtJS На открытие, закрытие тем
	public function actionEdit() {

		if ($_POST['Issue']) {
			$issue = CJSON::decode($_POST['Issue']);

			//Yii::log(print_r($data, TRUE));
			/*
			  if (array_key_exists('issue_id', $data)) {
			  $this->updateIssue($data);
			  } else {
			  foreach ($data as $issue) {
			  $this->updateIssue($issue);
			  }
			  }
			 */

			$model = $this->loadModel($issue['issue_id']);
			// Support "взял тему"
			if ($issue[ACTION_CONST::UPDATE_ACTION] == ACTION_CONST::ACTION_OPEN) {
				$modelStatus = Status::model()->findByAttributes(array('name' => ACTION_CONST::VALUE_OPEN));
				//$beforeStatus = $model->status_id;
				$model->status_id = $modelStatus->status_id;
				$model->support_id = Yii::app()->user->getState(AUTH_CONST::USER_ID);
				//$model->is_changed = 1;
			}
			// User  закрыл тему
			if ($issue[ACTION_CONST::UPDATE_ACTION] == ACTION_CONST::ACTION_CLOSE) {
				$modelStatus = Status::model()->findByAttributes(array('name' => ACTION_CONST::VALUE_CLOSE));
				$model->status_id = $modelStatus->status_id;
				$model->close_date = date('Y-m-d H:i:s');
				$model->is_closed = TRUE;
				//$model->is_changed = 1;
			}

			if ($issue[ACTION_CONST::UPDATE_ACTION] == ACTION_CONST::ACTION_ACCEPT) {
				$model->is_changed = 0;
			}

			if (!$model->save()){
				Yii::log(print_r($model->errors, TRUE));
			}
		}

		Yii::app()->end();
	}	
//----------------------------------------------------------------------------//	
	// Инициализация
	public function init() {
		$this->layout = '//layouts/column2';
		//$this->extJSScript = " Ext.Msg.alert('Наше пробное сообщение','Hello, World!' ); ";
		// Добавим ExtJS на страницу
		if (Yii::app()->user->getState(AUTH_CONST::ROLE) == AUTH_CONST::SUPPORT || Yii::app()->user->getState(AUTH_CONST::ROLE) == AUTH_CONST::USER) {
			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/utils.js', CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/issue.js', CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/issueGrid.js', CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/issueForm.js', CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/messageGrid.js', CClientScript::POS_HEAD);
			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/messageForm.js', CClientScript::POS_HEAD);
			$this->isExtJS = TRUE;
		}
	}	
//----------------------------------------------------------------------------//
}
/******************************************************************************/
?>
