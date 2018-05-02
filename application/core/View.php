<?php

namespace application\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	const VIEW_DIR = 'application/views/';

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
		$layout = self::VIEW_DIR."layouts/$this->layout.php";
		if(file_exists($layout)){
			require $layout;
		}
	}

	public function renderAdmin($headers, $vars = []){
		$path = self::VIEW_DIR."$this->admpath.php";
		if(file_exists($path)) {
			extract($vars);
			ob_start();
			require $path;
			$content = ob_get_clean();
			$layout = self::VIEW_DIR."layouts/$this->layout.php";
			if(file_exists($layout)){
				extract($headers);
				require $layout;
			}
		}
	}

	private function fullRender($vars, $views){
		$path = self::VIEW_DIR."$views.php";
		if(file_exists($path)) {
			extract($vars);
			if(isset($CONTENT[0])AND(count($CONTENT) == 1)){
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
		$path = self::VIEW_DIR."errors/$code.php";
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			$title = 'Страница не существует.';
			require self::VIEW_DIR.'layouts/default.php';
		}
		exit;
	}
}	