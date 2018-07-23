<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo isset($HTML_TITLE) ? 'ТриБас-М: '.$HTML_TITLE : 'ТриБас-М'; ?></title>
	<meta name="Description" content="<?php echo $HTML_DESCR; ?>">
	<meta name="Keywords" content="<?php echo $HTML_KEYWORDS; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/js/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="/assets/js/slick/slick-theme.css">
	<link rel="shortcut icon" href="/assets/img/favicon.png" type="image/png">
	<link rel="stylesheet" href="/assets/css/media.css">
</head>
<body>
	<div class="header_wrapper">
		<div class="phone_number"><p>8 495 798 90 08</p></div>
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
	<div class="popup">
		<a href="javascript:PopUpShow()"><div class="popup_button"><p> ЗаказON-LINE</p></div></a>
		<div class="popup_window">
			<div class="popup_order_form">
				<a href="javascript:PopUpHide()"><div class="form_close">&#9421;</div></a>
				<div class="order_form_title"><p>Заказ ОN-LINE</p></div>
				<form>
					<div class="forma_group"><input type="text" placeholder="Дата и время подачи" name="to_date"></div>
					<div class="forma_group"><input type="text" placeholder="Адрес подачи" name="addr_from"></div>
					<div class="forma_group"><input type="text" placeholder="Адрес назначения" name="addr_to"></div>
					<div class="forma_group"><input type="text" placeholder="Ваш телефон или email" name="email_phone"></div>
					<div class="forma_group">
						<select name="user_choice">
							<option value="0">---Выбор транспорта---</option>
							<option value="1">6 Мест</option>
							<option value="2">7 Мест</option>
							<option value="3">8 Мест</option>
							<option value="4">9 Мест</option>
							<option value="5">10 Мест</option>
							<option value="6">11 Мест</option>
							<option value="7">18 Мест</option>
							<option value="8">20 Мест</option>
							<option value="9">24 Места</option>
							<option value="10">28 Мест</option>
							<option value="11">31 Место</option>
							<option value="12">42 Мест</option>
							<option value="13">50 Мест</option>
							<option value="14">55 Мест</option>
						</select>
					</div>
					<div class="forma_group"><input type="text" placeholder="Предложите цену" name="cost"></div>
					<div class="forma_group"><input type="text" placeholder="Комментарий" name="message"></div>
					<button onclick="return order('popup_order_form')"><p>Заказать</p></button>
				</form>
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