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
						<div class="nav_item">
							<a href="/services" >Услуги</a>
							<div class="subnav">
								<a href="#">Автобус на свадьбу</a>
								<a href="#">Автобус в аэропорт</a>
								<a href="#">Автобус межгород</a>
								<a href="#">Срочный заказ автобуса</a>
								<a href="#">Поездка до границы Украины и обратно</a>
								<a href="#">Список документов для заказных автобусов</a>
							</div>
						</div>
						<div class="nav_item">
							<a href="/buses" class="">Автобусы</a>
							<div class="subnav">
								<a href="#">Заказ автобуса 28 мест</a>
								<a href="#">Заказ автобуса 30,32 места</a>
								<a href="#">Заказ автобуса 42-45 мест</a>
								<a href="#">Заказ автобуса 50 мест</a>
								<a href="#">Заказ автобуса 54-59 мест</a>
								<a href="#">Заказ автобуса 74 места</a>
								<a href="#">Каталог автобусов</a>
							</div>
						</div>
						<div class="nav_item">
							<a href="/minivans" class="">Микроавтобусы</a>
							<div class="subnav">
								<a href="#">Заказ микроавтобуса 7-8 мест</a>
								<a href="#">Заказ микроавтобуса 10-12 мест</a>
								<a href="#">Заказ микроавтобуса 18-20 мест</a>
								<a href="#">Заказ микроавтобуса 26 мест</a>
								<a href="#">Минивэн 6 мест</a>
							</div>
						</div>
						<div class="nav_item">	
							<a href="/excursions" class="">Экскурсии</a>
							<div class="subnav">
								<a href="#">Обзорные экскурсии по Москве</a>
								<a href="#">Индивидуальная экскурсия по ночной Москве</a>
								<a href="#">Автотур в Санкт-Петербург, Великий Новгород, Тверь</a>
								<a href="#">Автобусный тур по "Золотому кольцу России"</a>
							</div>
						</div>
						<div class="nav_item">
							<a href="/contacts" class="">Контакты</a>
						</div>
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