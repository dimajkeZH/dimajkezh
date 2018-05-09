<?php

namespace application\models;

use application\core\Model;

abstract class Admin extends Model {


	/* CLASS VARIABLES */
	public $title = 'perfectCMS';
	public $ver = '0.0.3';

	protected $lifetime_hash = 1800;

	protected $pswd_cost = 10;
	protected $sha = 'sha512';
	protected $sha_key = 'supersecretkey';

	protected $dif_hash = true;

	protected $log_admissible = [
		0 => true, //all logs

		1 => true, //redirect

		2 => true, //select
		3 => true, //update
		4 => true, //insert
		5 => true, //delete

		6 => true, //login
		7 => true, //logout
	];
	/* CLASS VARIABLES END */

	/* BOOLEAN PUBLIC FUNCTIONS */

	/* BOOLEAN PUBLIC FUNCTIONS END */





	//IS AUTH
	public function isAuth(){
		if(isset($_SESSION['admintype']) && isset($_COOKIE['admintype']) && isset($_SESSION['hash']) && isset($_COOKIE['hash'])){
			if(($_SESSION['admintype'] === $_COOKIE['admintype'])&&(!empty($_SESSION['hash']))&&(!empty($_COOKIE['hash']))){
				$q = 'SELECT COUNT(*) FROM ADMIN_SESSIONS WHERE (HASH_S = :HASH_S) AND (HASH_C = :HASH_C) AND (DT_DESTROY > NOW())';
				$params = [
					'HASH_S' => $_SESSION['hash'],
					'HASH_C' => $_COOKIE['hash']
				];
				$result = $this->db->column($q, $params);
				if($result == 1){
					return true;
				}
			}
		}
		$this->sessionDestroy();
		return false;
	}




	/* GET PRIVATE FUNCTIONS */

	/* GET PRIVATE FUNCTIONS END */






	//get siteTree
	private function getSiteTree(){
		$q = 'SELECT ID, TITLE as NAME, "pagegr" as "URI" FROM PAGE_GROUPS';
		$return = $this->db->row($q);
		foreach($return as $key => $val){
			$q = 'SELECT ID, TITLE as NAME, "pages" as "URI" FROM PAGES WHERE ID_GROUP = '.$val['ID'].' ORDER BY LOC_NUMBER;';
			$return[$key]['SUBMENU'] = $this->db->row($q);
		}
		return $return;
	}















		//get siteTree
	private function getSiteTree(){
		$q = 'SELECT ID, NAME, "pagegr" as "URI" FROM PAGE_GROUPS';
		$returnPage = $this->db->row($q);
		//debug($returnPage);
		foreach($returnPage as $key => $val){
			$q = 'SELECT ID, NAME, "pages" as "URI" FROM PAGES WHERE ID_GROUP = '.$val['ID'];
			$returnPage[$key]['SUBMENU'] = $this->db->row($q);
		}
		//debug($returnPage);
		$q = 'SELECT ID, NAME, "casegr" as "URI" FROM CASE_GROUPS';
		$returnCase = $this->db->row($q);
		//debug($returnCase);
		foreach($returnCase as $key => $val){
			$q = 'SELECT CL.ID, CM.TITLE as NAME, "cases" as "URI" FROM CASE_LIST as CL INNER JOIN CASE_MENU as CM ON CM.ID_CASE = CL.ID WHERE CL.ID_GROUP = '.$val['ID'].' ORDER BY CL.SERIAL_NUMBER';
			$returnCase[$key]['SUBMENU'] = $this->db->row($q);
		}
		//debug($returnCase);
		$return = array_merge($returnPage, $returnCase);
		//debug($return);
		return $return; 
	}

	public function getSiteTreeHTML(){
		$SITETREE = $this->getSiteTree();
		$return = '';

		if(isset($SITETREE)AND(count($SITETREE)>0)){
			foreach($SITETREE as $key => $val){
				$return .= "<ul class='main_nav_list' id='main_nav_list'><a class='main_nav_list_title Go' href='/admin/site/$val[URI]/$val[ID]'><b>$val[NAME]</b></a>";
				if(isset($val['SUBMENU'])AND(count($val['SUBMENU'])>0)){
					foreach($val['SUBMENU'] as $subkey => $subval){
						$return .= "<li class='main_nav_list_item'><a class='Go' href='/admin/site/$subval[URI]/$subval[ID]'>$subval[NAME]</a></li>";
					}
				}
				if($val['URI'] == 'casegr'){
					$return .=  "<li class='main_nav_list_item'><a class='Go' href='/admin/site/cases/?group=$val[ID]'>Добавить..</a></li>";
				}
				$return .=  '</ul>';
			}
		}
		$return .=  '<ul class="main_nav_list" id="main_nav_list"><a class="main_nav_list_title Go" href="/admin/site/casegr/">Добавить..</a></ul>';
		return $return;
	}













	//session destroy
	private function sessionDestroy(){
		if(isset($_SESSION['hash']) && isset($_COOKIE['hash'])){
			$q = 'UPDATE ADMIN_SESSIONS SET DT_DESTROY = NOW() WHERE (HASH_S = :HASH_S) AND (HASH_C = :HASH_C)';
			$params = [
				'HASH_S' => $_SESSION['hash'],
				'HASH_C' => $_COOKIE['hash']
			];
			$this->db->column($q, $params);
		}
		$this->db->column('DELETE FROM ADMIN_SESSIONS WHERE ID_ADMIN = 0');
		unset($_SESSION['hash']);
		session_destroy();
		setcookie('hash', "", time()-3600);
	}
	//create new record in the db
	private function sessionCreate($id_admin){
		if($this->dif_hash){
			$hash_s = $this->generateStr(128);
			$hash_c = $this->generateStr(128);
			$_SESSION['hash'] = $hash_s;
			setcookie('hash', $hash_c, time()+$this->lifetime_hash);
		}else{
			$hash_s = $hash_c = $this->generateStr(128);
			$_SESSION['hash'] = $hash_s;
			setcookie('hash', $hash_c, time()+$this->lifetime_hash);
		}
		$create =  $this->now();
		$destroy = $this->now($this->lifetime_hash);		
		$q = 'INSERT INTO ADMIN_SESSIONS (ID_ADMIN, HASH_S, HASH_C, IP, BROWSER, DT_CREATE, DT_DESTROY) VALUES (:ID_ADMIN, :HASH_S, :HASH_C, :IP, :BROWSER, :DT_CREATE, :DT_DESTROY)';
		$params = [
			'ID_ADMIN' => $id_admin,
			'HASH_S' => $hash_s,
			'HASH_C' => $hash_c,
			'IP' => $_SERVER['REMOTE_ADDR'],
			'BROWSER' => $_SERVER['HTTP_USER_AGENT'],
			'DT_CREATE' => $create,
			'DT_DESTROY' => $destroy
		];
		$this->db->column($q, $params);
	}

	//string generation the specified length
	private function generateStr($length){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $str = '';
	    for ($i = 0; $i < $length; $i++) {
	        $str .= $characters[rand(0, strlen($characters)-1)];
	    }
	    return $str;
	}

	//hashPSWD to bcrypt
	private function hashPSWD($str){
		return password_hash(
			$this->shaPSWD($str),
			PASSWORD_BCRYPT, 
			["cost" => $this->pswd_cost]
		);
	}

	//verify PASS, get ID
	private function verifyPSWD($name, $pass){
		$db = $this->matchLogin($name);
		if(is_null($db)){
			return NULL;
		}
		if(password_verify($pass, $db['PASS'])){
			return $db['ID'];
		}
	}

	//get ID, PASS
	private function matchLogin($name){
		$q = 'SELECT ID, PASS FROM ADMIN_ACCOUNTS WHERE (NAME = :NAME) ORDER BY ID LIMIT 1';
		$params = [
			'NAME' => $name
		];
		$result = $this->db->row($q, $params);
		if(count($result) == 1){
			return $result[0];
		}
		return NULL;
	}

	//sha PSWD for BCRYPT
	private function shaPSWD($str){
		return base64_encode(hash_hmac($this->sha, $str, $this->sha_key, true));
	}

	//logging actions
	private function loger($number, $cur){

	}

	//get CURRENT TIME with shift on some seconds
	private function now($sec = 0){
		return date_modify(date_create(), "+$sec sec")->format('Y-m-d H:i:s');
	}




	public function message($status, $message){
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function clear($str) {
	    $str = trim($str);
	    $str = strip_tags($str);
	    return $str;
	}

	public function clearHTML($str) {
	    $str = trim($str);
	    $str = stripslashes($str);
	    $str = htmlspecialchars($str);
	    return $str;
	}





	public function isAjax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		}
		return false;
	}
}