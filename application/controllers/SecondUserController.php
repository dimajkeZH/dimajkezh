<?php

namespace application\controllers;

use application\controllers\UserController;

class SecondUserController extends UserController {

	public function servicesAction() {
		$this->render($this->model->getContent($this->route));
	}

	public function busesAction() {
		$this->render($this->model->getContent($this->route));
	}

	public function minivansAction() {
		$this->render($this->model->getContent($this->route));	
	}

	public function excursionsAction() {
		$this->render($this->model->getContent($this->route));
	}

}