<?php

namespace application\models;

use application\models\User;

class AjaxUser extends User {

	const EOL = "\r\n";
	const order_title = 'Новый заказ';
	const feedback_title = 'Новое сообщение';

	public function __construct(){
		parent::__construct();
		include $_SERVER['DOCUMENT_ROOT'].'/application/config/const.php';
	}

	public function orderValid($post){
		if(isset($_POST['to_date'])AND($_POST['to_date'] != '') && isset($_POST['addr_from'])AND($_POST['addr_from'] != '') && isset($_POST['addr_to'])AND($_POST['addr_to'] != '') && isset($_POST['email_phone'])AND($_POST['email_phone'] != '') && isset($_POST['user_choice'])AND($_POST['user_choice'] != '')AND($_POST['user_choice'] != 0) && isset($_POST['cost'])AND($_POST['cost'] != '')){
			return true;
		}
		return false;
	}

	public function orderSend($post){
			$this->order_mail = '19jenia96@mail.ru';

			$to_date = $this->wrapData($_POST['to_date']);
			$addr_from = $this->wrapData($_POST['addr_from']);
			$addr_to = $this->wrapData($_POST['addr_to']);
			$email_phone = $this->wrapData($_POST['email_phone']);
			$user_choice = $this->wrapData($_POST['user_choice']);
			$user_choice = $this->db->column('SELECT CHOICE_TITLE FROM PAGES WHERE ID = :ID', ['ID' => $user_choice]);
			$cost = $this->wrapData($_POST['cost']);
			$comments = $this->wrapData($_POST['message']);
			
			/*
			if(isset($_POST['message'])AND($_POST['message'] != '')){
				$message = '';
			}else{
				$message = "";
			}
			*/
		
			$message = '';
			$message .= 'Дата и время подачи: '.$to_date.self::EOL;
			$message .= 'Адрес подачи: '.$addr_from.self::EOL;
			$message .= 'Адрес назначения: '.$addr_to.self::EOL;
			$message .= 'Выбор: '.$user_choice.self::EOL.self::EOL;
			$message .= 'Почта/телефон: '.$email_phone.self::EOL;
			$message .= 'Предполагаемая стоимость: '.$cost.self::EOL.self::EOL;
			$message .= 'Комментарии: '.$comments.self::EOL;
			#debug($message);
			#
			/*
			if(isset($_POST['captcha'])AND($_POST['captcha'] != '')){
				$response = $_POST['captcha'];
			}else{
				message(false, 'Вы не прошли капчу');
			}

			/* post to ReCaptcha validation */
			/*
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
			*/
			/* exit if bad captcha */
			/*
			if(!$captcha_success->success){
				message(false, 'captcha not passed');
			}
			*/
			/* set mail settings */
			//$headers  = "MIME-Version: 1.0\n";
			//$headers .= "Content-type: text/html; charset=iso-8859-1\n";
			//$headers .= "From: \"Test\" <".$email.">\n";
			//$headers .= "Reply-To: ".$ReplyTo."\n";
			//$headers .= "X-Sender: <".$email.">\n";
			//$headers .= "X-Mailer: PHP\n"; 
			//$headers .= "X-Priority: 1\n"; 
			//$headers .= "Return-Path: <".POST_MAIL.">\n";  
			/* try to send message */
			$message = wordwrap($message, 70, "\r\n");
			try{
				$status = mail($this->order_mail, self::order_title, $message);
			}catch(Exception $e){
				$status = false;
			}finally{
				if($status){
					loger($_SERVER['DOCUMENT_ROOT'].'/application/core/logs/order.txt', 'good | '.$_SERVER['REMOTE_ADDR'].'|'.$_SERVER['HTTP_USER_AGENT'].' | '.$message);
					return true;
				}else{
					loger($_SERVER['DOCUMENT_ROOT'].'/application/core/logs/order.txt', 'bad | '.$_SERVER['REMOTE_ADDR'].'|'.$_SERVER['HTTP_USER_AGENT'].' | '.$message);
				}
			}
		return false;
	}

	public function feedbackValid($post){
		/* get data */
		if(isset($_POST['name'])AND($_POST['name'] != '') && isset($_POST['email'])AND($_POST['email'] != '') && isset($_POST['message'])AND($_POST['message'] != '') && isset($_POST['captcha'])AND($_POST['captcha'] != '')){
			return true;
		}
		return false;
	}

	public function feedbackSend($post){
			$this->feedback_mail = '19jenia96@mail.ru';

			$name = $this->clear($_POST['name']);
			$email = $this->clear($_POST['email']);
			$message = $this->clear($_POST['message']);
			$response = $_POST['captcha'];
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
			if($captcha_success->success){				
				/* set mail settings */
				//$headers  = "MIME-Version: 1.0\n";
				//$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				//$headers .= "From: \"Test\" <".$email.">\n";
				//$headers .= "Reply-To: ".$ReplyTo."\n";
				//$headers .= "X-Sender: <".$email.">\n";
				//$headers .= "X-Mailer: PHP\n"; 
				//$headers .= "X-Priority: 1\n"; 
				//$headers .= "Return-Path: <".POST_MAIL.">\n";  
				/* try to send message */
				$message = wordwrap($message, 70, "\r\n");
				try{
					$status = mail($this->feedback_mail, self::feedback_title, $message);
				}catch(Exception $e){
					$status = false;
				}finally{
					if($status){
						loger($_SERVER['DOCUMENT_ROOT'].'/application/core/logs/feedback.txt', 'good | '.$_SERVER['REMOTE_ADDR'].'|'.$_SERVER['HTTP_USER_AGENT'].' | '.$message);
						return true;
					}else{
						loger($_SERVER['DOCUMENT_ROOT'].'/application/core/logs/feedback.txt', 'bad | '.$_SERVER['REMOTE_ADDR'].'|'.$_SERVER['HTTP_USER_AGENT'].' | '.$message);
					}
				}
			}
		return false;
	}

	public function wrapData($str){
		return wordwrap($this->clear($str), 70, "\r\n");
	}
}