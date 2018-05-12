<?php

namespace application\controllers;

use application\core\Controller;

abstract class AdminController extends Controller {

	public function isAuth(){
		if(!$this->model->isAuth()){
			$this->view->redirect('/admin/auth');
		}
	}

}