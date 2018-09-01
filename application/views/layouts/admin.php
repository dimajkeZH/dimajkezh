<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/application/views/mainAdmin/css/style.css">
	<link rel="stylesheet" href="/application/views/mainAdmin/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css" />
	<title><?php echo isset($title) ? $title : 'NoNe title'; ?></title>
	<link rel="icon" type="image/png" sizes="32x32" href="/application/views/mainAdmin/img/favicon.png">
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
								<li><a class="Go" href="/admin/site/content">Редактировать общий контент</a></li>
								<li><a class="Go" href="/admin/site/pages">Добавить страницу</a></li>
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
								<li><a class="Go" href="/admin/report/accounts">Аккаунты</a></li>
								<li><a class="Go" href="/admin/report/sessions">Сессии</a></li>
								<li><a class="Go" href="/admin/report/actions">Действия в сессиях</a></li>
							</ul>
						</li>
					</ul>	
				</div>
			</div>
			<div class="header_settings">
				<div class="logo">
					<img src="/application/views/mainAdmin/img/logo.png" alt="">
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
					<div class="loader_box">
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
						<div class="modal_wnd">
							<div class="modal_wnd_wrapper" id="wrap" onclick="modalClose()"></div>
							<div class="modal_wnd_inner" id="window">
								<div class="modal_wnd_head">
									<div class="buttons">
										<button onclick="modalClose()" class="remove">Отмена</button>
										<button form="" class="save">Добавить</button>
									</div>
								</div>
								<div class="modal_wnd_content">
									<div class="modal_wnd_form">
										<form action="	">
											<select name="block" id="" size="6">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
										</form>
									</div>
									<div class="modal_wnd_info">
										<p class="modal_wnd_info_title">Заголовок</p>
										<p class="modal_wnd_info_content">	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus deleniti facilis quia eum impedit sapiente eaque, eligendi, modi, ab assumenda, aliquam. Sed voluptatem error voluptates? Eligendi mollitia ipsam illo, dolorem aliquam neque excepturi, quasi numquam dicta sed a ducimus, sunt! Labore nisi quibusdam in at, illo voluptas doloremque ea quos?</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
		</div>
	</div>
	<script src="/application/views/mainAdmin/js/jquery.min.js"></script>
	<script src="/application/views/mainAdmin/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.js"></jquery>"></script>
	<script src="/application/views/mainAdmin/js/classes.js"></script>
	<script src="/application/views/mainAdmin/js/script.js"></script>
</body>
</html>