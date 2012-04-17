<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $login
 * @property string $pass
 * @property string $email
 * @property string $updated
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('login, pass, email', 'length', 'max'=>45, 'min'=>3),
                        array('login,pass,email','required','on'=>'registration'),
                        array('login,pass','required'),
                        array('email','email'),
                        array('login','unique','message'=>'Такой логин уже занят',
                        	'on'=>'registration'),
                        array('login','match','pattern'=>'/^[A-Za-z0-9А-Яа-я\s,]+$/u',
                         'message' => 'Логин содержит недопустимые символы.'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Логин',
			'pass' => 'Пароль',
			'email' => 'Email',
            'updated'=> 'Обновлен',
		);
	}
        
        public function behaviors()
        {
            return array(
                'AutoTimestampBehavior'=>array(
                    'class'=>'zii.behaviors.CTimestampBehavior',
                    'createAttribute'=>'updated',
                    'updateAttribute'=>'updated',
                ),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('email',$this->email,true);
                $criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}    
}