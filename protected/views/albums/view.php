<?php
$this->breadcrumbs=array(
	'Альбомы'=>array('index','id'=>$id),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список альбомов', 'url'=>array('index', 'id'=>$id)),
	array('label'=>'Создать альбом', 'url'=>array('create')),
	array('label'=>'Изменить альбом', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить альбом', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление альбомами', 'url'=>array('admin')),
);
?>

<h1>Альбом "<?php echo $model->title; ?>"</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_images',
)); ?>
