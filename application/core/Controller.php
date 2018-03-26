<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $model;
	//public $acl;

	public function __construct($route) {
		$this->route = $route;
		/*
		if (!$this->checkAcl()) {
			View::errorCode(403);
		}
		*/
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
	}

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	public function pageAction() {
		$this->view->renderPage('kek','application/views/services/bus_air.php');
		/*
		$this->view->renderPage(
			$this->model->getTitle($this->route),
			$this->model->getContent($this->route)
		);
		*/
	}

/*
	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		}
		elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
			return true;
		}
		elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
			return true;
		}
		elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
			return true;
		}
		return false;
	}

	public function isAcl($key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}
*/
}