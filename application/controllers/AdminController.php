<?php

namespace application\controllers;

use application\core\Controller;

abstract class AdminController extends Controller {




	abstract private function settings($layout = 'admin'){
		$this->view->layout = $layout;
	}

	abstract private function render($content = []){
		$this->view->renderAdmin($this->model->getHeaders(), $content);
	}

	private function ajax($content = []){
		$out = $this->view->outputAjax($this->model->getHeaders(), $content);
		$this->model->message(true, $out);
	}

	abstract private function isAuth(){
		if(!$this->model->isAuth()){
			$this->view->redirect('/admin/auth');
		}
	}
}