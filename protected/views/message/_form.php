<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'msg_text'); ?>
		<?php echo $form->textArea($model,'msg_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'msg_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msg_date'); ?>
		<?php echo $form->textField($model,'msg_date'); ?>
		<?php echo $form->error($model,'msg_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'issue_id'); ?>
		<?php echo $form->textField($model,'issue_id'); ?>
		<?php echo $form->error($model,'issue_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->