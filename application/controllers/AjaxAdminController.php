<?php

namespace application\controllers;

use application\controllers\AdminController;
use application\models\CronAdmin;

class AjaxAdminController extends AdminController {


	const MESSAGE__NO_VALUES = 'Нет параметров';
	const MESSAGE__BAD_VALUES = 'Не все параметры заполнены правильно';

	const MESSAGE__CHANGE_GOOD = 'Данные успешно изменены';
	const MESSAGE__CHANGE_BAD = 'Изменение данных не произошло';

	const MESSAGE__DELETE_GOOD = 'Данные успешно удалены';
	const MESSAGE__DELETE_BAD = 'Удаление данных не произошло';

	public function saveConfigsAction(){
		$post = $this->model->toPost(file_get_contents('php://input'));
		if($post){
			if($this->model->verConfigs($post)){
				if($this->model->saveConfigs($post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveContentAction(){
		$post = $this->model->toPost(file_get_contents('php://input'));
		if($post){
			if($this->model->verContent($post)){
				if($this->model->saveContent($post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveSettingsAction(){
		$post = $this->model->toPost(file_get_contents('php://input'));
		if($post){
			if($this->model->verSettings($post)){
				if($this->model->saveSettings($post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function savePagegrAction(){
		$post = $this->model->toPost(file_get_contents('php://input'));
		if($post){
			if($this->model->verPageGroups($post)){
				if($this->model->savePageGroups($post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function savePagesAction(){	
		$post = $this->model->toPost(file_get_contents('php://input'));
		if($post){
			if($this->model->verSavePages($post)){
				if($this->model->savePages($post)){
					//$this->model->updCron();
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function delPagesAction(){
		$post = $this->model->toPost(file_get_contents('php://input'));
		if($post){
			if($this->model->verPages_del($post)){
				if($this->model->delPages($post)){
					$this->model->message(true, self::MESSAGE__DELETE_GOOD);
				}$this->model->message(false, self::MESSAGE__DELETE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}


}