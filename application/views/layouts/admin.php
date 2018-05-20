<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/application/views/mainadmin/css/style.css">
	<link rel="stylesheet" href="/application/views/mainadmin/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css" />
	<title><?php echo isset($title) ? $title : 'NoNe title'; ?></title>
	<link rel="icon" type="image/png" sizes="32x32" href="/application/views/mainadmin/img/favicon.png">
</head>
<body>
	<div class="popup__message"></div>
	<div class="wrapper">
		<div class="header">
			<div class="header_nav" id="tabs">
				<div class="header_nav_list">
					<ul>
						<li class="header_nav_list_item"><a>Главная</a></li>
						<li class="header_nav_list_item"><a>Каталоги</a></li>
						<li class="header_nav_list_item"><a class="Go" href="/admin/site/settings">Настройки</a></li>
						<li class="header_nav_list_item"><a>Отчёты</a></li>
					</ul>
				</div>
				<div class="header_nav_content">
					<ul>
						<li class="header_nav_content_item">
							<ul>
								<li><a class="Go" href="/admin/site/content">Сайт</a></li>
								<li><a class="Go" href="/admin/site/pages">Страницы</a></li>
							</ul>
						</li>
						<li class="header_nav_content_item">
							<ul>
								<li><a class="Go" href="/admin/catalog/cities">Города автобусов</a></li>
								<li><a class="Go" href="/admin/catalog/buses">Автобусы</a></li>
								<li><a class="Go" href="/admin/catalog/news">Новости</a></li>
								<li><a class="Go" href="/admin/catalog/vacancies">Вакансии</a></li>
							</ul>
						</li>
						<li class="header_nav_content_item">
							<ul>
							</ul>
						</li>
						<li class="header_nav_content_item">
							<ul>
								<li><a class="Go" href="#">Content3</a></li>
								<li><a class="Go" href="#">Content3</a></li>
								<li><a class="Go" href="#">Content3</a></li>
								<li><a class="Go" href="#">Content3</a></li>
								<li><a class="Go" href="#">Content3</a></li>
							</ul>
						</li>
					</ul>	
				</div>
			</div>
			<div class="header_settings">
				<div class="logo">
					<img src="/application/views/mainadmin/img/logo.png" alt="">
					<div class="logo_text">
						<p><?php echo isset($title) ? $title : 'NoNe cms name'; ?> <span><?php echo isset($ver) ? $ver : 'NoNe version'; ?></span></p>
					</div>
				</div>
				<p class="name"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'NoNe name admin'; ?></p>
				<a class="Go" href="/admin/config" class="settings">Настройки</a>
				<a href="/admin/logout" class="logaut">Выход</a>
			</div>
		</div>
		<div class="main_wrapper">
			<div class="main">
				<div class="main_nav">
					<?php echo $TREE; ?>
				</div>
				<div class="content_box">
					<div class="loader_box hide">
					  <div class="loader">
					  	<div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div><!--
					    --><div class="element_box"><div class="element"></div></div>
					  </div>
					</div>
					<div class="main_content">
						<?php echo $content; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
		</div>
	</div>
	<script src="/application/views/mainadmin/js/jquery.min.js"></script>
	<script src="/application/views/mainadmin/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.js"></jquery>"></script>
	<script src="/application/views/mainadmin/js/script.js"></script>
</body>
</html>