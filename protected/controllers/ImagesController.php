<?php

class ImagesController extends Controller
{
        public $layout = '//layouts/column2';

        public function filters()
        {
            return array('accessControl');
        }


        public function accessRules()
        {
            return array(
                array('allow',
                        'actions'=>array('admin','update','delete'),
                        'users'=>array('@'),
                ),
                array('deny','users'=>array('*')),
            );
        }

	public function actionAdmin($id)
	{
            $model = new Images('search');
            $model->unsetAttributes();
            if(isset($_GET['Images']))
                $model->attributes = $_GET['Images'];
            $model->album_id = $id;
            $this->render('index',array(
                'model'=>$model,
            ));
	}

        public function actionUpdate($id)
        {
            $model = $this->loadModel($id);
            if(isset($_POST['Images']))
            {
                $model->title = $_POST['Images']['title'];
                if($model->save(true, array('title')))
                        $this->redirect(array('admin', 'id'=>$model->album_id));
            }
            $this->render('update',array(
                    'model'=>$model,
            ));
        }

        public function actionDelete($id)
        {
            $model = $this->loadModel($id);
            $path = './images/'.Yii::app()->user->id.'/'.$model->album_id.'/';
            unlink($path.$model->filename);
            $model->delete();
        }

        public function loadModel($id)
        {
            $model = Images::model()->findByPk($id);
            if($model === null)
                throw new CHttpException(404, 'Страница не найдена');
            return $model;
        }
}