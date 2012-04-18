<?php

/**
 * This is the model class for table "{{albums}}".
 *
 * The followings are the available columns in table '{{albums}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 */
class Albums extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Albums the static model class
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
		return '{{albums}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title', 'safe', 'on'=>'search'),
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
			'user_id' => 'Пользователь',
			'title' => 'Название',
		);
	}
        
        protected function beforeSave()
        {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                {
                    $this->user_id = Yii::app()->user->id;                    
                }
                return true;
            }else
                return false;
        }
        
        protected function afterSave()
        {
            parent::afterSave();           
            $id=$this->getIdByTitle($this->title);
            if(!file_exists('images/'.Yii::app()->user->id.'/'.$id))
            {                    
            if(!mkdir('images/'.Yii::app()->user->id.'/'.$id, 0777))
                Yii::log('Папка не создана', CLogger::LEVEL_ERROR);
            }else{
                Yii::log('Такая папка уже есть', CLogger::LEVEL_ERROR);
            }
            
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getCount($userId)
        {
            return Albums::model()->count(array(
                'condition'=>'user_id=:userId',
                'params'=>array(':userId'=>$userId),
            ));
        }
        
        public function getIdByTitle($title)
        {
            $record = Albums::model()->find(array(
                'select'=>'id',
                'condition'=>'user_id=:user_id AND title=:title',
                'params'=>array(
                    ':user_id'=>Yii::app()->user->id,
                    ':title'=>$title,
                ),
            ));
            return $record->id;
        }
        
        public function cleanAlbum($path)
        {            
            $handle = opendir($path);
            while (!false == ($file = readdir($handle)))
            {
                if(($file!='.') && ($file!='..'))
                {                   
                    unlink($path.'/'.$file);
                }
            }
            closedir($handle);
        }
        
        public function getAlbumAuthor($id)
        {
            $criteria = new CDbCriteria(array(
                'select'=>'user_id',
                'condition'=>'id=:id',
                'params'=>array(
                    ':id'=>$id,
                ),
            ));
              $album = Albums::model()->find($criteria);
              return $album->user_id;
        }
}