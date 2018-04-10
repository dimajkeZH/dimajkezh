<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller {

	public function mainAction(){	
		$this->model->isAuth();
		$this->view->layout = 'admin';
		$this->view->renderAdmin($this->model->title);
	}

	public function authAction(){
		$this->view->layout = 'admin';
		$this->view->renderAdmin($this->model->title);
	}

	public function loginAction(){	
		$this->model->login();
	}

	public function logoutAction(){	
		$this->model->logOut();
	}

	public function pageAction(){	
		$this->model->isAuth();
		$this->view->layout = 'admin';
		$this->view->renderAdmin($this->model->title);
	}

}