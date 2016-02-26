<?php
/* @var $this IssueController */
/* @var $data Issue */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->issue_id), array('view', 'id'=>$data->issue_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_subject')); ?>:</b>
	<?php echo CHtml::encode($data->issue_subject); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('client_id')); ?>:</b>
	<?php echo CHtml::encode($data->client()->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('support_id')); ?>:</b>
	<?php echo CHtml::encode($data->support()->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status()->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_date')); ?>:</b>
	<?php echo CHtml::encode($data->issue_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_closed')); ?>:</b>
<!--
	<?php echo CHtml::encode($data->is_closed); ?>
-->
	<?php echo CHtml::encode(Yii::app()->format->formatBoolean($data->is_closed)); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('close_date')); ?>:</b>
	<?php echo CHtml::encode($data->close_date); ?>
	<br />


</div>