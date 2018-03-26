<?php

namespace application\controllers;

use application\core\Controller;

class ContactsController extends Controller {

	public function indexAction() {
		$this->view->renderIndex('Контакты', $this->model->getIndexContent());
	}

}