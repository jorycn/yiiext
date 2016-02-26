<?php
/* @var $this StatusController */
/* @var $data Status */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->status_id), array('view', 'id'=>$data->status_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>