<?php

/**
 * This is the model class for table "tbl_issue".
 *
 * The followings are the available columns in table 'tbl_issue':
 * @property integer $issue_id
 * @property string $issue_subject
 * @property integer $client_id
 * @property integer $support_id
 * @property integer $status_id
 * @property string $issue_date
 * @property boolean $is_closed
 * @property string $close_date
 *
 * The followings are the available model relations:
 * @property User $client
 * @property Status $status
 * @property User $support
 * @property Message[] $messages
 */
class Issue extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Issue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_issue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('issue_subject, client_id', 'required'),
			array('client_id, support_id, status_id', 'numerical', 'integerOnly'=>true),
			array('issue_subject', 'length', 'max'=>1000),
			//array('issue_date, close_date', 'date'),			
			array('issue_date, is_closed, close_date, is_changed', 'safe'),
			array('issue_subject', 'filter', 'filter'=>array($this,'htmlEncode')),
			array('issue_id, issue_subject, client_id, support_id, status_id, issue_date, is_closed, close_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'client' => array(self::BELONGS_TO, 'User', 'client_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'support' => array(self::BELONGS_TO, 'User', 'support_id'),
			'messages' => array(self::HAS_MANY, 'Message', 'issue_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'issue_id' => 'ИД',
			'issue_subject' => 'Тема',
			'client_id' => 'Автор',
			'support_id' => 'issue',
			'status_id' => 'Статус',
			'issue_date' => 'Дата',
			'is_closed' => 'Состояние',
			'close_date' => 'Дата закрытия',
			'is_changed' => 'Изменено',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('issue_id',$this->issue_id);
		$criteria->compare('issue_subject',$this->issue_subject,true);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('support_id',$this->support_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('issue_date',$this->issue_date,true);
		$criteria->compare('is_closed',$this->is_closed);
		$criteria->compare('close_date',$this->close_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}