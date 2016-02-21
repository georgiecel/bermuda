<!doctype html>
<html <?php language_attributes(); ?> class="site-error">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, width=device-width">
		<title>Oops.</title>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/error.css?<?php echo date('Ymd', filemtime( get_stylesheet_directory() . '/error.css' )); ?>" type="text/css" media="screen">
	</head>
	<body class="site-error__inner">
		<div class="site-error__content">
			<h1 class="site-error__title">The bermuda triangle doesn’t exist&hellip;</h1>
			<p>And neither does this page. 😢</p>
			<p><script>document.write('<a class="site-error__link" href="' + document.referrer + '">Go back</a>');</script>, or <a class="site-error__link" href="mailto:404@georgie.nu">let me know</a>.</p>
		</div>
	</body>
</html>