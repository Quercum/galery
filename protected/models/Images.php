<?php

/**
 * This is the model class for table "{{images}}".
 *
 * The followings are the available columns in table '{{images}}':
 * @property integer $id
 * @property integer $album_id
 * @property integer $user_id
 * @property string $title
 * @property string $filename
 */
class Images extends CActiveRecord
{
    public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Images the static model class
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
		return '{{images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('album_id', 'numerical', 'integerOnly'=>true),
                        array('title','required', 'on'=>'edit'),
			array('title', 'length', 'max'=>90),
			array('filename', 'length', 'max'=>255),
                        array('image','file','types'=>'jpg, jpeg, png'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, album_id, title, filename', 'safe', 'on'=>'search'),
                        array('title, filename','required', 'on'=>'insert'),
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
			'album_id' => 'Альбом',
                        'user_id' => 'Пользователь',
			'title' => 'Название',
			'filename' => 'Путь к файлу',
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
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('filename',$this->filename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /**
         * Путь к последней сохраненной картинке
         * @param integer $userId Id пользователя
         * @return String
         */
        public function getLast($userId)
        {
            $criteria = new CDbCriteria(array(
                'select' => 'album_id,filename',
                'condition'=>'user_id=:user_id',
                'order' => 'id DESC',
                'params'=> array(':user_id'=>$userId),
            ));
            $image = Images::model()->find($criteria);
            $count = Images::model()->count($criteria);
            if($count>=1)
                return Yii::app()->baseUrl.'/images/'.$userId.'/'.$image->album_id.
                    '/'.$image->filename;
            else
                return Yii::app()->baseUrl.'/images/nopic.jpg';

        }

        /**
         * Возвращает путь к последней картинке
         * в альбоме
         * @param integer $albumId
         * @return string
         */
        public function getLastFromAlb($albumId)
        {
            $criteria = new CDbCriteria(array(
                'select'=> 'user_id,filename',
                'condition'=>'album_id=:album_id',
                'order'=>'id DESC',
                'limit'=>1,
                'params'=>array(':album_id'=>$albumId),
            ));
            $image = Images::model()->find($criteria);
            if(Images::model()->count($criteria)!=0)
                return Yii::app()->baseUrl.'/images/'.$image->user_id.
                    '/'.$albumId.'/'.$image->filename;
            else
                return Yii::app()->baseUrl.'/images/nopic.jpg';
        }

        public function getData($albumId)
        {
            $criteria = new CDbCriteria(array(
                'select' => 'id,user_id,title,filename',
                'condition'=>'album_id=:albumId',
                'order'=>'id DESC',
                'params'=>array(':albumId'=>$albumId),
            ));
            return new CActiveDataProvider('Images', array(
                'pagination'=>array(
                    'pageSize'=>20,
                ),
                'criteria'=>$criteria,
            ));
        }

        public function getFilePath($id)
        {
            $criteria = new CDbCriteria(array(
                'select'=>'user_id,album_id,filename',
                'condition'=>'id=:id',
                'params'=>array(':id'=>$id),
            ));
            $image = Images::model()->find($criteria);
            return Yii::app()->baseUrl.'/images/'.$image->user_id.'/'.$image->album_id.
                    '/'.$image->filename;
        }
}