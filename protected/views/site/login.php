<h3>Вход</h3>
<div class="form">
<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
		<?php echo CHtml::activeLabel($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password'); ?>
	</div>
	<div class="row submit">
		<?php echo CHtml::submitButton('Вход'); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div>