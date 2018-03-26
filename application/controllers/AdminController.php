<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller {

	public function indexAction() {
		$this->view->renderIndex('админка', $this->model->getIndexContent());
	}

}