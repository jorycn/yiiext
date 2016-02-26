<?php
/******************************************************************************/
/* Контроллер сообщений														  */
/******************************************************************************/
/******************************************************************************/
//!!! АВТОГЕНЕРАЦИЯ ////////////////////////////////////////////////////////////
/******************************************************************************/
class MessageController extends Controller {
//----------------------------------------------------------------------------//
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
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

		$model = new Message;
		if ($model->add($_POST['Message'])) {
			$this->redirect(array('view', 'id' => $model->msg_id));
		}
		$this->render('create', array('model' => $model,));
	}
//----------------------------------------------------------------------------//
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);
		if ($model->add($_POST['Message'])){
			$this->redirect(array('view', 'id' => $model->msg_id));
		}
		$this->render('update', array('model' => $model,));
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
		$dataProvider = new CActiveDataProvider('Message');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}
//----------------------------------------------------------------------------//
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Message('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Message']))
			$model->attributes = $_GET['Message'];

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
		$model = Message::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'message-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
//----------------------------------------------------------------------------//
	// Запрос из ExtJS, запись сообщения в БД
	public function actionAdd() {
		$model = new Message;
		$message = CJSON::decode($_POST['Message']);
		$message['user_id'] = Yii::app()->user->user_id;
		$model->add($message);
		Yii::app()->end();
	}	
//----------------------------------------------------------------------------//
	// Запрос данных из ExtJS (через views/message/extjs/data.php)	
	public function actionData($issue_id) {
		$this->renderPartial('extjs/data', array('issue_id' => $issue_id));
	}
//----------------------------------------------------------------------------//
	// Формирование запроса и преобразование в JSON формат	
	public function toJSON($issue_id) {

		
		if (!Yii::app()->user->isGuest) {
			
			// Данные могут получить только авторизованные
			$message = Message::model();

			$command = Yii::app()->db->createCommand();
			$command->select('*');
			$command->from('v_message m');
			$command->where('m.issue_id = :issue_id', array('issue_id' => $issue_id));
			$command->order('m.msg_date desc, m.msg_id desc');

			$result = $command->queryAll();

			return CJSON::encode(array(
						'success' => true,
						'Message' => $result,
						'total' => count($result)
					));
		} else {
			// Иначе редирект на главную страницу			
			$this->redirect('/site/index');
		}
	}	
//----------------------------------------------------------------------------//
}
/******************************************************************************/
?>