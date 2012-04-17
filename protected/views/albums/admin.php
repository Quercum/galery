<?php
$this->breadcrumbs=array(
	'Альбомы'=>array('index', 'id'=>Yii::app()->user->id),
	'Управление альбомами',
);

$this->menu=array(
	array('label'=>'Альбомы', 'url'=>array('index','id'=>Yii::app()->user->id)),
	array('label'=>'Создать альбом', 'url'=>array('create')),
);
?>

<h1>Управление альбомами</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'albums-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
