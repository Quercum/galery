<?php
$this->breadcrumbs=array(
	'Альбомы'=>array('index','id'=>$id),
	'Создать',
);

$this->menu=array(
	array('label'=>'Альбомы', 'url'=>array('index','id'=>$id)),
	array('label'=>'Редактировать альбом', 'url'=>array('admin','id'=>$id)),
);
?>

<h1>Создать альбом</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>