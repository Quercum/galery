<?php
$this->breadcrumbs=array(
	'Альбомы',
);
if($id==Yii::app()->user->id)
{
$this->menu=array(
	array('label'=>'Создать альбом', 'url'=>array('create')),
	array('label'=>'Редактировать альбом', 'url'=>array('admin')),
);
}
?>

<h1>Альбомы</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
