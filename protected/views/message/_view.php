<?php
/* @var $this MessageController */
/* @var $data Message */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->msg_id), array('view', 'id'=>$data->msg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_text')); ?>:</b>
	<?php echo CHtml::encode($data->msg_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_date')); ?>:</b>
	<?php echo CHtml::encode($data->msg_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_id')); ?>:</b>
	<?php echo CHtml::encode($data->issue_id); ?>
	<br />


</div>