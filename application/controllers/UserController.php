<?php

namespace application\controllers;

use application\core\Controller;

abstract class UserController extends Controller {

	public function render($content = []){
		$this->view->render(
			$this->model->getHeaders($this->route), 
			$content, 
			$this->model->getView($this->route)
		);
	}

	public function notFound(){
		$this->view::errorCode(404);
	}

	public function notFormed(){
		$this->view::errorCode(423);
	}

}