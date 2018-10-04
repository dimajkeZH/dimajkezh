<?php

namespace application\controllers;

use application\controllers\UserController;

class MainUserController extends UserController {

	private function render($content){
		$this->view->render(1, $this->model->getTitle($this->route), $content);
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
		$bus = $this->model->getBus($this->route);
		if($bus){
			$this->render($bus);
		}else{
			$this->notFound();
		}
		
	}

}