<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="Description" content="<?php echo $HTML_DESCR; ?>">
	<meta name="Keywords" content="<?php echo $HTML_KEYWORDS; ?>">
	<title><?php echo $TITLE; ?></title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/js/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="/assets/js/slick/slick-theme.css">
	<link rel="shortcut icon" href="/favicon.png" type="image/png">
</head>
<body>
	<div class="header_wrapper">
		<div class="header">
			<div class="header_nav">
				<span class="logo">
					<a href="/">
						<img src="/assets/img/logo.png" alt="">
					</a>
				</span>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/application/views/layouts/cache/menu.html'; ?>
			</div>
		</div>
	</div>
	<div class="main_wrapper"><?php echo $content; ?></div>
	<div class="footer_wrapper">
		<div class="footer">
			<p>© Copyright, 2015 ТК "ТриБас" - Все права защищены.</p><p>При использовании материалов с сайта ссылка на источник обязательна.</p>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="/assets/js/slick/slick.min.js"></script>
	<script src="/assets/js/script.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>