<?php

namespace application\controllers;

use application\core\Controller;

class ServicesController extends Controller {

	public function indexAction() {
		$this->view->renderIndex('Услуги', $this->model->getIndexContent());
	}

	public function pageAction() {
		debug(1);
		$this->view->renderPage(
								$this->model->getTitle($this->route['param']),
								$this->model->getContent($this->route['param'])
								);
	}

}