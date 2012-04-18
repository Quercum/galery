<div class="form">
    <?php $form = $this->beginWidget('CActiveForm',array(
        'id'=>'albums-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data')
    )); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'filename'); ?>
        <?php echo $form->fileField($model,'filename'); ?>
        <?php echo $form->error($model,'filename'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>
    
    <div class="row submit">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>