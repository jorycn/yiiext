<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />		

		<?php
		
			$this->beginContent('//layouts/css');
			$this->endContent();


			if ($this->isExtJS) {
				$this->beginContent('//layouts/extjs');
				$this->endContent();
			}
			
		?>

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	</head>

	<body>

		<div class="container" id="page">

			<!-- header -->
			<div id="header">
				<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
			</div>
			<!-- End header -->

			<!-- mainmenu -->
			<div id="mainmenu">
				<?php $this->beginContent('//layouts/menu'); ?>
				<?php $this->endContent(); ?>
			</div>
			<!-- End mainmenu -->

			<!-- breadcrumbs -->
			<?php $this->beginContent('//layouts/breadcrumbs'); ?>
			<?php $this->endContent(); ?>			
			<!-- End breadcrumbs -->

			<!-- view -->
			<?php echo $content; ?>
			<!-- End view -->

		</div>
		<!-- footer -->

		</div>
		<!-- page -->

	</body>
</html>
