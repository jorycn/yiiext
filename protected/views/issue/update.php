<?php
/* @var $this IssueController */
/* @var $model Issue */

$this->breadcrumbs=array(
	'Issues'=>array('index'),
	$model->issue_id=>array('view','id'=>$model->issue_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Issue', 'url'=>array('index')),
	array('label'=>'Create Issue', 'url'=>array('create')),
	array('label'=>'View Issue', 'url'=>array('view', 'id'=>$model->issue_id)),
	array('label'=>'Manage Issue', 'url'=>array('admin')),
);
?>

<h1>Update Issue <?php echo $model->issue_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>