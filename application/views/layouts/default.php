<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../../../assets/js/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="../../../assets/js/slick/slick-theme.css">
	<link rel="shortcut icon" href="favicon.png" type="image/png">
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
				<div class="main_nav">
					<nav class="nav">
						<a href="/services" class="nav_item">Услуги</a>
						<a href="/buses" class="nav_item">Автобусы</a>
						<a href="/minivans" class="nav_item">Микроавтобусы</a>
						<a href="/excursions" class="nav_item">Экскурсии</a>
						<a href="/contacts" class="nav_item">Контакты</a>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="main_wrapper"><?php echo $content; ?></div>
	<div class="footer_wrapper">
		<div class="footer">
			<p>© Copyright, 2015 ТК "ТриБас" - Все права защищены.
			</p>
			<p>
			При использовании материалов с сайта ссылка на источник обязательна.
			</p>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="../../../assets/js/slick/slick.min.js"></script>
	<script src="../../../assets/js/script.js"></script>
</body>
</html>