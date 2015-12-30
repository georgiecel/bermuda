<!doctype html>
<html <?php language_attributes(); ?> class="site-error">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, width=device-width">
		<title>Oops.</title>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.min.css?<?php echo date('Ymd', filemtime( get_stylesheet_directory() . '/style.min.css' )); ?>" type="text/css" media="screen">
	</head>
	<body class="site-error__inner">
		<div class="site-error__content">
			<h1 role="heading" class="site-error__title">You forgot something&hellip; 😦</h1>
			<p>Did you forget to fill in your name, email address or write a comment? 😊</p>
			<p><a class="site-error__link" href="javascript:history.go(-1)">&larr; Oops let me try again</a></p>
		</div>
	</body>
</html>