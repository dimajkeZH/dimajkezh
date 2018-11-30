<?php

namespace application\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

	const VIEW_DIR = 'application/views/';

	public function __construct($route) {
		$this->route = $route;	
		$this->admpath = $route['controller'].'/'.$route['action'];
	}

	public function render($headers = [], $vars = [], $views = ''){
		#debug([$this->route, $headers, $vars, $views]);
		$this->path = 
			($views != '') ? 
			($this->route['controller'] . '/' . $views) : 
			($this->route['controller'] . '/' . $this->route['action']);
		$path = self::VIEW_DIR . $this->route['controller'] . "/$views.php";
		#debug([$vars, $views, $path, file_exists($path)]);
		if(file_exists($path)) {
			extract($headers);
			unset($headers);
			extract($vars);
			unset($vars);
			if(isset($CONTENT[0])AND(count($CONTENT) == 1)){
				$CONTENT = $CONTENT[0];
			}
			ob_start();
			require $path;
			$content = ob_get_clean();
		}else{
			$content = '';
		}
		$layout = self::VIEW_DIR."layouts/$this->layout.php";
		if(file_exists($layout)){
			require $layout;
		}
		exit;
	}

	public function renderAdmin($iscontent){
		$content = '';
		if($iscontent){
			$path = self::VIEW_DIR . $this->route['controller'] . '/' . $this->route['action'] . '.php';
			#debug([$path, file_exists($path)]);
			if(file_exists($path)){
				ob_start();
				require $path;
				$content = ob_get_clean();
			}
		}
		$layout = self::VIEW_DIR."layouts/$this->layout.php";
		if(file_exists($layout)){
			require $layout;
		}
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
		}else{
			echo "<h1><center>error: $code</center></h1>";
		}
		exit;
	}
}	