<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $user_id
 * @property string $login
 * @property integer $is_active
 * @property string $password
 * @property integer $role_id
 * @property string $full_name
 *
 * The followings are the available model relations:
 * @property Issue[] $issues
 * @property Issue[] $issues1
 * @property Message[] $messages
 * @property Role $role
 */
class User extends ActiveRecord {

	public function init() {
		$this->attachEventHandler('onBeforeSave', array($this, 'beforeSaving'));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, is_active', 'required'),
			array('role_id', 'numerical', 'integerOnly' => true),
			array('is_active', 'boolean', 'trueValue' => 1, 'falseValue' => 0),
			array('login, password', 'length', 'max' => 100),
			array('full_name', 'length', 'max' => 1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, login, is_active, password, role_id, full_name', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'issues_client' => array(self::HAS_MANY, 'Issue', 'client_id'),
			'issues_support' => array(self::HAS_MANY, 'Issue', 'support_id'),
			'messages' => array(self::HAS_MANY, 'Message', 'user_id'),
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'user_id' => 'ИД',
			'login' => 'login',
			'is_active' => 'Вкл.',
			'password' => 'password',
			'role_id' => 'role',
			'full_name' => 'nick',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('login', $this->login, true);
		$criteria->compare('is_active', $this->is_active);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('role_id', $this->role_id);
		$criteria->compare('full_name', $this->full_name, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	/* 	
	  public function save($runValidation = true, $attributes = NULL){
	  parent::save($runValidation, $attributes);
	  }
	 */

	public function beforeSaving() {
		$this->password = sha1($_POST['User']['password']);
		return true;
	}

}