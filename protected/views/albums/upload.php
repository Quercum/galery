<h3>Добавить картинку</h3>
<?php if(Yii::app()->user->hasFlash('error')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('success'); ?><br>
        <?php echo CHtml::link('Вернуться в альбом',array('view','id'=>$id)); ?>
    </div>
<?php else: ?>
    <?php $this->renderPartial('/albums/_upload',array('model'=>$model)); ?>
<?php endif; ?>
