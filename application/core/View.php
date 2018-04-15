<?php

namespace application\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	public function __construct($route) {
		$this->route = $route;
		$this->path = $route['action'].'/index';
		$this->admpath = $route['controller'].'/'.$route['action'];
	}

	public function render($type, $headers, $vars = [], $views = []){
		if(count($views) == 0){
			$views = $this->path;
		}
		$content = '';
		switch($type){
			case 1:
				$content = $this->fullRender($vars, $views);
				break;
			case 2:
				$content = $this->tmplRender($vars, $views);
				break;
		}
		extract($headers);
		require 'application/views/layouts/'.$this->layout.'.php';
	}

	public function renderAdmin($title, $vars = []){
		$path = 'application/views/'.$this->admpath.'.php';
		if(file_exists($path)) {
			extract($vars);
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'application/views/layouts/'.$this->layout.'.php';
		}
	}

	private function fullRender($vars, $views){
		$path = 'application/views/'.$views.'.php';
		if(file_exists($path)) {
			extract($vars);
			if(isset($CONTENT[0])){
				$CONTENT = $CONTENT[0];
			}
			ob_start();
			require $path;
			return ob_get_clean();
		}
	}

	private function tmplRender($vars, $views){
		$content = '';
		for($i = 0; $i < max(count($views), count($vars)); $i++){
			$content .= $this->fullRender($vars[$i], $views[$i]);
		}
		return $content;
	}

	public function redirect($url) {
		header('location: '.$url);
		exit;
	}

	public static function errorCode($code){
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