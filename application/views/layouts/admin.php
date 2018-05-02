<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/application/views/admin/css/style.css">
	<link rel="stylesheet" href="/application/views/admin/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css" />
	<title><?php echo isset($title) ? $title : 'NoNe title'; ?></title>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="header_nav" id="tabs">
				<div class="header_nav_list">
					<ul>
						<li class="header_nav_list_item"><a href="#">Главная</a></li>
						<li class="header_nav_list_item"><a href="/site/settings">Настройки</a></li>
						<li class="header_nav_list_item"><a href="#">Отчёты</a></li>
					</ul>
				</div>
				<div class="header_nav_content">
					<ul>
						<li class="header_nav_content_item">
							<ul>
								<li><a href="/site">Сайт</a></li>
								<li><a href="/site/pagegr">Страницы</a></li>
								<li><a href="/site/casegr">Группы кейсов</a></li>
								<li><a href="/site/cases">Кейсы</a></li>
							</ul>
						</li>
						<li class="header_nav_content_item">
						</li>
						<li class="header_nav_content_item">
							<ul>
								<li><a href="#">Content3</a></li>
								<li><a href="#">Content3</a></li>
								<li><a href="#">Content3</a></li>
								<li><a href="#">Content3</a></li>
								<li><a href="#">Content3</a></li>
							</ul>
						</li>
					</ul>	
				</div>
			</div>
			<div class="header_settings">
				<div class="logo">
					<img src="/application/views/admin/img/logo.png" alt="">
					<div class="logo_text">
						<p><?php echo isset($title) ? $title : 'NoNe cms name'; ?></p>
						<p><span><?php echo isset($ver) ? $ver : 'NoNe version'; ?></span></p>
					</div>
				</div>
				<p class="name"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'NoNe name admin'; ?></p>
				<a href="/admin/settings" class="settings">Настройки</a>
				<a href="/admin/logout" class="logaut">Выход</a><a href=""></a>
			</div>
		</div>
		<div class="main_wrapper">
			<div class="main">
				<div class="main_nav">
					<?php if(isset($SITETREE)AND(count($SITETREE)>0)): foreach($SITETREE as $key => $val): ?>
					<ul class="main_nav_list" id="main_nav_list"><a class="main_nav_list_title" href="/admin/site/<?php echo $val['URI']; ?>/<?php echo $val['ID']; ?>"><b><?php echo $val['NAME']; ?></b></a>
						<?php if(isset($val['SUBMENU'])AND(count($val['SUBMENU'])>0)): foreach($val['SUBMENU'] as $subkey => $subval): ?>
							<li class="main_nav_list_item"><a href="/admin/site/<?php echo $subval['URI']; ?>/<?php echo $subval['ID']; ?>"><?php echo $subval['NAME']; ?></a></li>
							<?php endforeach; endif; ?>
						<li class="main_nav_list_item"><a href="/admin/site/<?php echo $subval['URI']; ?>/?group=<?php echo $val['ID']; ?>">Добавить..</a></li>
					</ul>
					<?php endforeach; endif;?>
					<ul class="main_nav_list" id="main_nav_list"><a class="main_nav_list_title" href="/admin/site/<?php echo $val['URI']; ?>/">Добавить..</a></ul>
				</div>
				<div class="main_content">
				<?php include echo $content; ?>
				</div>
			</div>
		</div>
		<div class="footer">
		</div>
	</div>
	<script src="/application/views/admin/js/jquery.min.js"></script>
	<script src="/application/views/admin/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.js"></jquery>"></script>
	<script src="/application/views/admin/js/script.js"></script>
</body>
</html>