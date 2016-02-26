<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_id), array('view', 'id'=>$data->user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php //echo CHtml::encode($data->is_active?'Да':'Нет'); ?>
	<?php echo CHtml::encode(Yii::app()->format->formatBoolean($data->is_active)); ?>
	<br />
<!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::encode($data->role_id); ?>
	<br />
-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::encode($data->role()->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('full_name')); ?>:</b>
	<?php echo CHtml::encode($data->full_name); ?>
	<br />


</div>