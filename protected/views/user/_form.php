<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-form',
		'enableAjaxValidation' => false,
			));
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'login'); ?>
		<?php echo $form->textField($model, 'login', array('size' => 60, 'maxlength' => 100)); ?>
		<?php echo $form->error($model, 'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php
		echo $form->passwordField($model, 'password', array(
			'size' => 60,
			'maxlength' => 100,
			'value' => '',
		));
		?>
		<?php echo $form->error($model, 'password'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model, 'full_name'); ?>
		<?php echo $form->textField($model, 'full_name', array('size' => 60, 'maxlength' => 1000)); ?>
		<?php echo $form->error($model, 'full_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'role_id'); ?>
		<?php echo $form->dropDownList($model, 'role_id', CHtml::listData($model->role->findAll(), 'role_id', 'name')); ?>
		<?php echo $form->error($model, 'role_id'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model, 'is_active'); ?>
		<?php echo $form->checkBox($model, 'is_active') ?>
		<?php echo $form->error($model, 'is_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->