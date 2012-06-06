<?php
$albumTitle = Albums::getTitleById($model->album_id);
$this->breadcrumbs = array(
    'Альбомы'=>array('albums/index','id'=>Yii::app()->user->id),
     $albumTitle->title =>array('albums/view', 'id'=>$model->album_id),
);

?>
<h1>Управление изображениями</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'images-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'type'=>'image',
            'value'=>'"images/".$data->user_id."/".$data->album_id."/".$data->filename',
            'htmlOptions'=>array(
                'id'=>'galery_small_img',
            ),
        ),
        'title',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
        ),
    ),
));
?>