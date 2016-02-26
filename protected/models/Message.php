<?php

/**
 * This is the model class for table "tbl_message".
 *
 * The followings are the available columns in table 'tbl_message':
 * @property integer $msg_id
 * @property string $msg_text
 * @property integer $user_id
 * @property string $msg_date
 * @property integer $issue_id
 *
 * The followings are the available model relations:
 * @property Issue $issue
 * @property User $user
 */
class Message extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return 'tbl_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('msg_text, issue_id', 'required'),
			array('user_id, issue_id', 'numerical', 'integerOnly'=>true),
			//array('msg_text', 'filter', 'filter'=>array($obj=new CHtmlPurifier(),'purify')),
			array('msg_text', 'filter', 'filter'=>array($this,'htmlEncode')),
			array('msg_id, msg_text, user_id, msg_date, issue_id', 'safe', 'on'=>'search'),
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
			'issue' => array(self::BELONGS_TO, 'Issue', 'issue_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'msg_id' => 'Msg',
			'msg_text' => 'Msg Text',
			'user_id' => 'User',
			'msg_date' => 'Msg Date',
			'issue_id' => 'Issue',
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

		$criteria->compare('msg_id',$this->msg_id);
		$criteria->compare('msg_text',$this->msg_text,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('msg_date',$this->msg_date,true);
		$criteria->compare('issue_id',$this->issue_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}