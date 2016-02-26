<?php
/* @var $this IssueController */
/* @var $model Issue */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issue-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'issue_subject'); ?>
		<?php echo $form->textField($model,'issue_subject',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'issue_subject'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'client_id'); ?>
		<?php //echo $form->textField($model,'client_id'); ?>
		<?php echo $form->dropDownList($model, 'client_id', CHtml::listData($model->client->findAll(), 'user_id', 'login')); ?>
		<?php echo $form->error($model,'client_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'support_id'); ?>
		<?php //echo $form->textField($model,'support_id'); ?>
		<?php echo $form->dropDownList($model, 'support_id', CHtml::listData($model->support->findAll(), 'user_id', 'login')); ?>
		<?php echo $form->error($model,'support_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php //echo $form->textField($model,'status_id'); ?>
		<?php echo $form->dropDownList($model, 'status_id', CHtml::listData($model->status->findAll(), 'status_id', 'name')); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'issue_date'); ?>
		<?php //echo $form->textField($model,'issue_date'); ?>
		<?php //echo $form->error($model,'issue_date'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'is_closed'); ?>
		<?php echo $form->checkBox($model,'is_closed'); ?>
		<?php echo $form->error($model,'is_closed'); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->labelEx($model,'close_date'); ?>
		<?php //echo $form->textField($model,'close_date'); ?>
		<?php //echo $form->error($model,'close_date'); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->