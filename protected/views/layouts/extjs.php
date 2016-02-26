<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />		
		<!-- ** CSS ** -->
		<!-- base library -->

		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/extjs/resources/css/ext-all.css" />
		<!-- overrides to base library -->
		<!-- ** Javascript ** -->
		<!-- ExtJS library: base/adapter -->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/extjs/adapter/ext/ext-base.js"></script>
		<!-- ExtJS library: all widgets -->
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl ?>/extjs/<?php echo YII_DEBUG ? 'ext-all-debug-w-comments.js' : 'ext-all.js' ?>"></script>
		<!-- overrides to library -->
		<!-- extensions -->
		<!-- page specific -->
		<!--
		<script type="text/javascript" src=""></script>
		-->
		
		<?php if  (!Yii::app()->user->isGuest): ?>
		
		<script type="text/javascript">
			
			Ext.ns('sav');
			
			sav = {
				LOGIN:		'<?php echo Yii::app()->user->name ?>',
				USER_ID:	<?php echo Yii::app()->user->getState(AUTH_CONST::USER_ID) ?>,
				ROLE:		'<?php echo Yii::app()->user->getState(AUTH_CONST::ROLE) ?>',
				FULL_NAME:	'<?php echo Yii::app()->user->getState(AUTH_CONST::FULL_NAME) ?>',
				TITLE:		'<?php echo Yii::app()->user->getState(AUTH_CONST::TITLE_NAME) ?>',
				IS_ACTIVE:	<?php echo Yii::app()->user->getState(AUTH_CONST::IS_ACTIVE) ?>,
				IS_USER:	<?php echo (Yii::app()->user->getState(AUTH_CONST::ROLE) == AUTH_CONST::USER)?'true':'false' ?>,
				IS_SUPPORT:	<?php echo (Yii::app()->user->getState(AUTH_CONST::ROLE) == AUTH_CONST::SUPPORT)?'true':'false' ?>
			};

		</script>
		
		<?php endif; ?>
		
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		

	</head>

	<body>
	</body>

</html>		
