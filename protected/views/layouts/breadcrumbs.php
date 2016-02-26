<?php if (isset($this->breadcrumbs)): ?>
	<?php
	$this->widget('zii.widgets.CBreadcrumbs', array(
		'links' => $this->breadcrumbs,
		//'homeLink' => array('index' => array('site/index')),
		'homeLink' => CHtml::link('index', '/'),
		'separator' => ' &rarr; '
	));
	?><!-- breadcrumbs -->
	<?php
 endif ?>