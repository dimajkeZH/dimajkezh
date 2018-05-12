<?php

namespace application\models;

use application\core\Model;

abstract class Admin extends Model {

	/* CLASS VARIABLES */
	public $title = 'perfectCMS';
	public $ver = '0.0.4';

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

	/* BOOLEAN PUBLIC FUNCTIONS END */



	/* GET PUBLIC FUNCTIONS */
	//get site tree
	public function getSiteTreeHTML(){
		$SITETREE = $this->getSiteTree();
		$return = '';

		if(isset($SITETREE)AND(count($SITETREE)>0)){
			foreach($SITETREE as $key => $val){
				$return .= "<ul class='main_nav_list' id='main_nav_list'><a class='main_nav_list_add Go'  href='/admin/site/$val[URI]/$val[ID]'>C</a><a class='main_nav_list_title'><b>$val[NAME]".((count($val['SUBMENU']) > 0) ? ('('.count($val['SUBMENU']).')') : '')."</b></a>";
				if(isset($val['SUBMENU'])AND(count($val['SUBMENU'])>0)){
					foreach($val['SUBMENU'] as $subkey => $subval){
						$return .= "<li class='main_nav_list_item'><a class='Go' href='/admin/site/$subval[URI]/$subval[ID]'>$subval[NAME]</a></li>";
					}
				}
				$return .= ($val['URI'] == 'casegr') ? "<li class='main_nav_list_item'><a class='Go' href='/admin/site/cases/?group=$val[ID]'>Добавить..</a></li>" : '';	
				$return .= '</ul>';			  
			}
		}
		$return .=  '<ul class="main_nav_list" id="main_nav_list"><a class="main_nav_list_title Go" href="/admin/site/casegr/">Добавить..</a></ul>';
		return $return;
	}
	/* GET PUBLIC FUNCTIONS END */



	/* GET PRIVATE FUNCTIONS */
	//get site tree array
	private function getSiteTree(){
		$q = 'SELECT ID, TITLE as NAME, "pagegr" as "URI" FROM PAGE_GROUPS';
		$return = $this->db->row($q);
		foreach($return as $key => $val){
			$q = 'SELECT ID, TITLE as NAME, "pages" as "URI" FROM PAGES WHERE ID_GROUP = '.$val['ID'].' ORDER BY LOC_NUMBER;';
			$return[$key]['SUBMENU'] = $this->db->row($q);
		}
		return $return;
	}
	/*
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
	*/


	/* GET PRIVATE FUNCTIONS END */






















	/* PUBLIC FUNCTIONS */
	//get type of response
	public function isAjax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		}
		return false;
	}
	//send finally message to user
	public function message($status, $message){
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	//full clear data
	public function clear($str) {
	    $str = trim($str);
	    $str = strip_tags($str);
	    return $str;
	}

	//clear data and save tags
	public function clearHTML($str) {
	    $str = trim($str);
	    $str = stripslashes($str);
	    $str = htmlspecialchars($str);
	    return $str;
	}
		//logging actions
	public function loger($number, $cur){

	}

	//get CURRENT TIME with shift on some seconds
	public function now($sec = 0){
		return date_modify(date_create(), "+$sec sec")->format('Y-m-d H:i:s');
	}
	/* PUBLIC FUNCTIONS END */	
}