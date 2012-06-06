<?php
    $albumTitle = Albums::getTitleById($model->album_id);
    $this->breadcrumbs = array(
        'Альбомы'=>array('albums/index','id'=>Yii::app()->user->id),
        $albumTitle->title => array('albums/view', 'id'=>$model->album_id),
        'Управление альбомом'=>array('images/admin', 'id'=>$model->album_id),
    );

    $this->renderPartial('_update',array('model'=>$model));
?>
