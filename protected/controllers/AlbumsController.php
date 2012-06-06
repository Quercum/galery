<?php

class AlbumsController extends Controller
{
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete','admin','upload'),
				'users'=>array('@'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $imagesModel = new Images();
            $images = $imagesModel->getData($id);
            $userId = Albums::getAlbumAuthor($id);
            $this->render('view',array(
		'model'=>$this->loadModel($id),
                'dataProvider'=>$images,
                'id'=>$userId,
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Albums;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Albums']))
		{
			$model->attributes=$_POST['Albums'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
                        'id'=>Yii::app()->user->id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Albums']))
		{
			$model->attributes=$_POST['Albums'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
                        $model = $this->loadModel($id);
			// we only allow deletion via POST request
                        $path = 'images/'.Yii::app()->user->id.'/'.$id;
			$model->cleanAlbum($path);
                        rmdir($path);
                        $model->delete();


			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		$criteria = new CDbCriteria(array(
                    'select'    =>'id,title',
                    'condition' =>'user_id=:id',
                    'order'     =>'id DESC',
                    'params'    =>array(':id'=>$id),
                ));
                $dataProvider = new CActiveDataProvider('Albums',array(
                    'criteria'=>$criteria,
                ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'id'=>$id,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Albums('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Albums']))
			$model->attributes=$_GET['Albums'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionUpload($id)
        {
            $model = new Images('insert');
            if(isset($_POST['Images']))
            {
                $model->attributes = $_POST['Images'];
                $model->album_id = $id;
                $model->user_id = Yii::app()->user->id;
                $model->image = CUploadedFile::getInstance($model, 'filename');
                $model->filename = time().'.'.$model->image->extensionName;
                if($model->validate())
                {
                    if($model->save())
                    {
                        $model->image->saveAs('images'.DS.Yii::app()->user->id.DS.
                                $id.DS.$model->filename);
                        Yii::app()->user->setFlash('success','Файл успешно загружен. '.$backLink);
                        $this->render('upload',array('id'=>$id));
                    }
                }else{
                    Yii::app()->user->setFlash('error','Не все поля заполнены.');
                    $this->refresh();
                }
            }else
                $this->render('upload',array('model'=>$model));
        }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Albums::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='albums-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
