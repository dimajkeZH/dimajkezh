<?php

namespace application\controllers;

use application\core\Controller;

abstract class AdminController extends Controller {

	const NOT_SUPPORTED_METHOD = 'Данный метод общения с сервером не поддерживается';
	const NOT_AUTH = '';

	const PAGE_TYPES = [
		'PAGE' => 1,
		'REPORT' => 2,
		'CATALOG' => 3,
		'CONFIG' => 4,
	];

	protected $SUPPORTED_METHODS;

	public $isAjax;
	public $isSupportedMethod;

	public function isAuth(){
		if(!$this->model->isAuth()){
			$this->view->redirect('/admin/auth');
		}
	}

	public function init($layout = 'admin'){
		$this->isAjax = $this->model->isAjax();
		$this->isSupportedMethod = $this->model->isSupportedMethod($this->SUPPORTED_METHODS);
		$this->view->layout = $layout;

		if(!$this->isSupportedMethod){
			$this->model->message(false, self::NOT_SUPPORTED_METHOD);
		}
	}

	public function render($iscontent = false){
		$this->view->renderAdmin($iscontent);
	}

	public function outer_struct($type, $content = [], $btns = [], $additions = []){
		$out = [
			'TYPE'=> $type,
			'CONTENT'=> $content
		];
		if($btns && count($btns) > 0){
			$out['BUTTONS'] = $btns;
		}
		if($additions && count($additions) > 0){
			$out['ADDITIONS'] = $additions;
		}
		return $out;
	}
}