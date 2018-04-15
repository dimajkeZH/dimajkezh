<?php

namespace application\controllers;

use application\core\Controller;

class TemplatesController extends Controller {

	private function render(){
		$this->model->setConf($this->route);
		$this->view->render($this->model->pg_type, $this->model->getTitle($this->route), $this->model->getContent($this->route), $this->model->getViews($this->route));
	}

	public function pageAction() {
		$this->render();
	}
	public function servicesAction() {
		$this->render();
	}
	public function busesAction() {
		$this->render();	
	}
	public function minivansAction() {
		$this->render();	
	}
	public function excursionsAction() {
		$this->render();	
	}
	public function contactsAction() {
		$this->render();	
	}
	public function newsAction() {
		$this->render();	
	}
}