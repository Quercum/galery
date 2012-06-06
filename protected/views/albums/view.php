<?php
$this->breadcrumbs=array(
	'Альбомы'=>array('index','id'=>$id),
	$model->title,
);

$this->menu=array(
        array('label'=>'Добавить картинку', 'url'=>array('upload', 'id'=>$model->id)),
	array('label'=>'Список альбомов', 'url'=>array('index', 'id'=>$id)),
	array('label'=>'Создать альбом', 'url'=>array('create')),
	array('label'=>'Изменить альбом', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить альбом', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление картинками', 'url'=>array('images/admin', 'id'=>$model->id)),
);
?>

<h1>Альбом "<?php echo $model->title; ?>"</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_images',
)); ?>
