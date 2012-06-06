<div class="form">
    <?php
        $form = $this->beginWidget('CActiveForm',array(
            'id'=>'images-form',
            'enableAjaxValidation'=>false
        ));
    ?>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>