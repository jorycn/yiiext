<?php
/* @var $this IssueController */
/* @var $model Issue */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'issue_subject'); ?>
		<?php echo $form->textField($model,'issue_subject',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_id'); ?>
		<?php echo $form->textField($model,'client_id'); ?>
		<?php //echo $form->dropDownList($model, 'client_id', CHtml::listData($model->client->findAll(), 'user_id', 'login')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'support_id'); ?>
		<?php echo $form->textField($model,'support_id'); ?>
		<?php //echo $form->dropDownList($model, 'support_id', CHtml::listData($model->support->findAll(), 'user_id', 'login')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->textField($model,'status_id'); ?>
		<?php //echo $form->dropDownList($model, 'status_id', CHtml::listData($model->status->findAll(), 'status_id', 'name')); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->label($model,'issue_date'); ?>
		<?php //echo $form->textField($model,'issue_date'); ?>
		<?php //echo $form->dateField($model,'issue_date'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'is_closed'); ?>
		<?php echo $form->checkBox($model,'is_closed'); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->label($model,'close_date'); ?>
		<?php //echo $form->textField($model,'close_date'); ?>
		<?php //echo $form->dateField($model,'close_date'); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->