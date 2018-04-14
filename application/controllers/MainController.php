<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller {

	private function render($content){
		$this->view->render($this->model->getTitle($this->route), [$content]);
	}

	public function mainAction() {
		$this->render($this->model->getContent($this->route));
	}

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

	public function contactsAction() {
		$this->render($this->model->getVacancies($this->route));
	}

	public function newsAction() {
		$this->render($this->model->getNews($this->route));
	}

	public function busAction() {
		$this->render($this->model->getContent($this->route));
	}
}