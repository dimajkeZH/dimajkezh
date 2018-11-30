<?php

namespace application\controllers;

use application\controllers\AdminController;
use application\models\CronAdmin;

class AjaxAdminController extends AdminController {

	protected $SUPPORTED_METHODS = ['POST'];

	private $post;
	private $files;

	const MESSAGE__NO_VALUES = 'Нет параметров';
	const MESSAGE__BAD_VALUES = 'Не все параметры заполнены правильно';

	const MESSAGE__CHANGE_GOOD = 'Данные успешно изменены';
	const MESSAGE__CHANGE_BAD = 'Изменение данных не произошло';

	const MESSAGE__DELETE_GOOD = 'Данные успешно удалены';
	const MESSAGE__DELETE_BAD = 'Удаление данных не произошло';

	const URI_CHECK_GOOD = 'Ссылка свободна для использования';
	const URI_CHECK_BAD = 'Ссылка уже используется';

	public function saveConfigsAction(){
		$this->settings();
		if($this->post){
			if($this->model->verConfigs($this->post)){
				if($this->model->saveConfigs($this->post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveContentAction(){
		$this->settings();
		if($this->post){
			if($this->model->verContent($this->post)){
				if($this->model->saveContent($this->post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function saveSettingsAction(){
		$this->settings();
		if($this->post){
			if($this->model->verSettings($this->post)){
				if($this->model->saveSettings($this->post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function savePagegrAction(){
		$this->settings();
		if($this->post){
			if($this->model->verPageGroups($this->post)){
				if($this->model->savePageGroups($this->post)){
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function savePagesAction(){
		$this->settings();
		if(isset($this->post)){
			if($this->model->verSavePages($this->post)){
				$ID = $this->model->savePages($this->post, $this->files);
				if($ID){
					$this->model->updCron();
					$this->model->message(true, self::MESSAGE__CHANGE_GOOD, ['ID' => $ID]);
				}$this->model->message(false, self::MESSAGE__CHANGE_BAD);
			}$this->model->message(false, self::MESSAGE__BAD_VALUES);
		}else{
			$this->model->message(false, self::MESSAGE__NO_VALUES);
		}
	}

	public function delPagesAction(){
		$this->settings();
		if($this->model->verPages_del($this->route)){
			if($this->model->delPages($this->route)){
				$this->model->updCron();
				$this->model->message(true, self::MESSAGE__DELETE_GOOD);
			}$this->model->message(false, self::MESSAGE__DELETE_BAD);
		}$this->model->message(false, self::MESSAGE__BAD_VALUES);
	}




	private function settings(){
		if(isset($_POST['DATA'])){
			$this->post = json_decode($_POST['DATA'], true);
		}
		$this->files = $_FILES;
		//file_get_contents('php://input')
	}
}