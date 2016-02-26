<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->msg_id,
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'Update Message', 'url'=>array('update', 'id'=>$model->msg_id)),
	array('label'=>'Delete Message', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->msg_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>View Message #<?php echo $model->msg_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'msg_id',
		'msg_text',
		'user_id',
		'msg_date',
		'issue_id',
	),
)); ?>
