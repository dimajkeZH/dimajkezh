<?php

namespace application\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['action'].'/index';
	}

	public function renderIndex($header, $vars = []) {
		extract($header);
		extract($vars);
		$path = 'application/views/'.$this->path.'.php';
		if(file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'application/views/layouts/'.$this->layout.'.php';
		}
	}

	public function renderPage($header, $content) {
		extract($header);
		require 'application/views/layouts/'.$this->layout.'.php';
	}

	public function redirect($url) {
		header('location: '.$url);
		exit;
	}

	public static function errorCode($code) {
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			$title = 'Страница не существует.';
			require 'application/views/layouts/default.php';
		}
		exit;
	}
}	