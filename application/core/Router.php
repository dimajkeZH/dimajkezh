<?php

namespace application\core;

use application\core\View;

class Router {

    protected $routes = [];
    protected $params = [];

    public function __construct() {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    public function add($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            //echo $route.'<br>'.$url.'<br>'.preg_match($route, $url, $matches).'<br><br>';
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                $pos = stripos($route, '[');
                if($pos){
                    $match_type = '#^'.substr($route, $pos);
                    if(preg_match($match_type, 'aA1')){
                        $this->params['param'] = $this->selectParam($url, self::MULTI_PARAM);
                    }elseif(preg_match($match_type, 1)){
                        $this->params['param'] = $this->selectParam($url, self::NUMERIC_PARAM);
                    }elseif(preg_match($match_type, 'aA')){
                        $this->params['param'] = $this->selectParam($url, self::STRING_PARAM);
                    }
                }
                //debug($this->params);
                return true;
            }
        }
        return false;
    }

    public function selectParam($url, $type){
        $param = substr($url,strripos($url,'/')+1);
        switch($type){
            case self::MULTI_PARAM:
                //
                break;
            case self::STRING_PARAM:
                //
                break;
            case self::NUMERIC_PARAM:
                if(!is_numeric($param)){ $param = '0'; }
                break;
        }
        return $param;
    }

    public function run(){
        if ($this->match()) {
            $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)){
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

}