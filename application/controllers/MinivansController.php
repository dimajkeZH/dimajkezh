<?php

namespace application\controllers;

use application\core\Controller;

class MinivansController extends Controller {

	public function indexAction() {
		$this->view->render('Микроавтобусы');
	}

}