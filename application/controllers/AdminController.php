<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller {

	public function mainAction(){	
		$this->isAuth();
		$this->settings();
		$this->render($this->model->getContent());
	}

	public function authAction(){
		if(!$this->model->isAuth()){
			$this->settings('adminEmpty');
			$this->render();
		}else{
			$this->view->redirect('/admin');
		}
	}

	public function loginAction(){	
		if($this->model->logIn()){
			$this->view->redirect('/admin');
		}else{
			$this->view->redirect('/admin/auth');
		}
	}

	public function logoutAction(){	
		$this->model->logOut();
		$this->view->redirect('/admin/auth');
	}

	public function pageAction(){	
		$this->isAuth();
		$this->settings();
		$this->render();
	}


	private function settings($layout = 'admin'){
		$this->view->layout = $layout;
	}

	private function render($content = []){
		$this->view->renderAdmin($this->model->getHeaders(), $content);
	}

	private function isAuth(){
		if(!$this->model->isAuth()){
			$this->view->redirect('/admin/auth');
		}
	}
}