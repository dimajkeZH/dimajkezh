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
										<button onclick="return addBlock(this)" class="save">Добавить</button>
									</div>
								</div>
								<div class="modal_wnd_content">
									<div class="modal_wnd_form">
										<form>
											<select name="block" id="selectedBlock" size="5" onchange="changeDescr(this)">
												<option selected value="-1">- - - - - Выберите блок для добавления - - - - -</option>
												<option value="H1">H1</option>
												<option value="H2">H2</option>
												<option value="B1">B1</option>
												<option value="B2">B2</option>
												<option value="B3">B3</option>
												<option value="B4">B4</option>
												<option value="B5">B5</option>
												<option value="EXC1">EXC1</option>
											</select>
										</form>
									</div>
									<div class="modal_wnd_info">
										<p class="modal_wnd_info_title">--</p>
										<p class="modal_wnd_info_content">--</p>
									</div>
									<script>
										function changeDescr(THIS){
											let box_title = $('.modal_wnd_info_title');
											let box_descr = $('.modal_wnd_info_content');
											let box_type = $('#selectedBlock').val();

											switch(box_type){
												case '-1':
													box_title.text('');
													box_descr.text('');
													break;
												case 'H1':
													box_title.text('Заголовок с формой заявки');
													box_descr.text('Самый верхний блок на странице (хидер)');
													break;
												case 'H2':
													box_title.text('Заголовок с картинками');
													box_descr.text('Самый верхний блок на странице (хидер)');
													break;
												case 'B1':
													box_title.text('Блок с таблицей');
													box_descr.text('Таблица с заголовком и текстом');
													break;
												case 'B2':
													box_title.text('Блок с мультитаблицей');
													box_descr.text('Таблица с кнопками переключения между вкладками');
													break;
												case 'B3':
													box_title.text('Текстовый блок');
													box_descr.text('Блок с текстом и подзаголовокм');
													break;
												case 'B4':
													box_title.text('Блок с картинками');
													box_descr.text('Набор картинок с описанием');
													break;
												case 'B5':
													box_title.text('Блок с ссылками');
													box_descr.text('(Пока что не доступен)');
													break;
												case 'EXC1':
													box_title.text('Уникальный блок для страниц Экскурсии');
													box_descr.text('Заменяет все блоки и используется один для всей страницы');
													break;
												default:
													box_title.text('---');
													box_descr.text('---');
													break;
											}
										}
									</script>
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