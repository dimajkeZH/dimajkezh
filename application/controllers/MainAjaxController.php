<?php

namespace application\controllers;

use application\controllers\AjaxController;

class MainAjaxController extends AjaxController {

	public function feedbackAction() {
		if(isset($_POST)){
			$post = $_POST;
			if($this->model->feedbackValid($post)){
				if($this->model->feedbackSend($post)){
					$this->model->message(true, 'Сообщение успешно отправлено. Спасибо за обратную связь.');
				}
				$this->model->message(false, 'Ошибка. Сообщение не было отправлено. Попробуйте повторить позже.');
			}
		}
		$this->model->message(false, 'Ошибка. bad values for feedback message');
	}

	public function orderAction() {
		if(isset($_POST)){
			$post = $_POST;
			if($this->model->orderValid($post)){
				if($this->model->orderSend($post)){
					$this->model->message(true, 'Сообщение успешно отправлено. Мы свяжемся с вами в кротчайшие сроки.');
				}
				$this->model->message(false, 'Ошибка. Сообщение не было отправлено. Попробуйте повторить позже или связаться по телефону.');
			}
		}
		$this->model->message(false, 'Ошибка. bad values for order message');
	}

}