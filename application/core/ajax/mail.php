<?php
require $_SERVER['DOCUMENT_ROOT'].'/application/config/const.php';
// ----------------------------конфигурация-------------------------- // 
$adminemail = "evgenynakoskin@gmail.com";
$date = date("d.m.y");
$time = date("H:i");
// ------------------------------------------------------------------ // 
// Принимаем данные с формы 
// $name = $_POST['name']; 
// $email = $_POST['email']; 
// $msg = $_POST['message'];
$name = $_GET['name']; 
$email = $_GET['email']; 
$msg = $_GET['message'];
// Проверяем валидность e-mail
$to  = "<$adminemail>" ;

$subject = "$name"; 

$msg = "<p>Имя: $name</p><p>E-mail: $email</p><p>Сообщение: $msg</p>";

$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers .= "From: <$email>\r\n"; 
//$headers .= "Reply-To: <$email>\r\n"; 

$mail = mail($to, $subject, $msg, $headers); 

if ($mail){ 
    echo "messege acepted for delivery"; 
}else{ 
    echo "some error happen"; 
} 
// Сохраняем в базу данных 

// Выводим сообщение пользователю 
 
echo "$msg";  
exit;

