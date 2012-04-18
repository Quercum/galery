<?php

class ImagesController extends Controller
{
        public function accessRules()
        {
            return array(
                array('allow',
                        'actions'=>array('admin'),
                        'users'=>array('@'),
                ),
                array('deny','users'=>array('*')),
            );
        }
    
	public function actionAdmin()
	{
            
	}
}