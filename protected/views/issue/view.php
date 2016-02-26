<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Issues'=>array('index'),
	$model->issue_id,
);

$this->menu=array(
	array('label'=>'List Issue', 'url'=>array('index')),
	array('label'=>'Create Issue', 'url'=>array('create')),
	array('label'=>'Update Issue', 'url'=>array('update', 'id'=>$model->issue_id)),
	array('label'=>'Delete Issue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->issue_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Issue', 'url'=>array('admin')),
);
?>

<h1>View Issue #<?php echo $model->issue_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'issue_id',
		'issue_subject',
		'client_id',
		'support_id',
		'status_id',
		'issue_date',
		'is_closed',
		'close_date',
	),
)); ?>
