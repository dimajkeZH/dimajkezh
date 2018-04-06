<?php
/* require libs */
require $_SERVER['DOCUMENT_ROOT'].'/application/config/const.php';
require $_SERVER['DOCUMENT_ROOT'].'/application/lib/Dev.php';

/* get data */
if(isset($_POST['name'])AND($_POST['name'] != '')){
	$name = $_POST['name'];
}else{
	message(false, 'Нужно заполнить имя');
}
if(isset($_POST['email'])AND($_POST['email'] != '')){
	$email = $_POST['email'];
}else{
	message(false, 'Нужно заполнить email');
}
if(isset($_POST['message'])AND($_POST['message'] != '')){
	$message = $_POST['message'];
}else{
	message(false, 'Сообщение отсутствует');
}
if(isset($_POST['captcha'])AND($_POST['captcha'] != '')){
	$response = $_POST['captcha'];
}else{
	message(false, 'Вы не прошли капчу');
}

/* post to ReCaptcha validation */
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
	'secret' => CAPTCHA_SECRET,
	'response' => $response
);
$query = http_build_query($data);
$options = array(
	'http' => array (
		'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: ".strlen($query)."\r\n",    
		'method' => 'POST',
		'content' => $query
	),
	"ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
	)
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success=json_decode($verify);
/* exit if bad captcha */
if(!$captcha_success->success){
	message(false, 'captcha not passed');
}
/* set mail settings */
$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
//$headers .= "From: \"Test\" <".$email.">\n";
//$headers .= "Reply-To: ".$ReplyTo."\n";
//$headers .= "X-Sender: <".$email.">\n";
$headers .= "X-Mailer: PHP\n"; 
$headers .= "X-Priority: 1\n"; 
$headers .= "Return-Path: <".POST_MAIL.">\n";  
/* try to send message */
$message = wordwrap($message, 70, "\r\n");
if(TRUE/*mail(POST_MAIL, 'Test Subject', $message, $headers)*/){
	/* logging data */
	loger($_SERVER['DOCUMENT_ROOT'].'/application/core/logs/feedback.txt', $_SERVER['REMOTE_ADDR'].'|'.$_SERVER['HTTP_USER_AGENT']);
	message(true, 'Сообщение успешно отправлено. Спасибо за обратную связь.');
}else{
	message(false,'Ошибка. Сообщение не было отправлено. Попробуйте повторить позже.');
}