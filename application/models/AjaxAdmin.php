<?php

namespace application\models;

use application\models\Admin;

class AjaxAdmin extends Admin {

	public function updCron(){
		CronAdmin::updMenu();
		CronAdmin::updSlicks();
	}









	const IMAGE_LOAD_DIR_TOURS = 'tours/';
	const IMAGE_LOAD_DIR_CASES = 'case_img/';

	public function verSettingsAction(){
		return true;
	}
	public function saveSettingsAction(){
		
	}


	public function verSiteContent(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		return true;
	}
	public function saveSiteContent(){
		$post = array_change_key_case($_POST, CASE_UPPER);

		$ADDR = 					$this->cleanHTML($post['ADDR']);
		$MOB_PHONE = 				$this->clean($post['MOB_PHONE']); 
		$CITY_PHONE = 				$this->clean($post['CITY_PHONE']);
		$REF_PHONE = 				$this->clean($post['REF_PHONE']);
		$INFO_MAIL = 				$this->clean($post['INFO_MAIL']);
		$SEND_MAIL = 				$this->clean($post['SEND_MAIL']);
		$BANK_TINCAT =				$this->clean($post['BANK_TINCAT']);
		$BANK_STATE_NUMBER = 		$this->clean($post['BANK_STATE_NUMBER']);
		$BANK_CHECKING_ACCOUNT =	$this->clean($post['BANK_CHECKING_ACCOUNT']);
		$BANK_NAME = 				$this->clean($post['BANK_NAME']);
		$BANK_CORR_ACCOUNT = 		$this->clean($post['BANK_CORR_ACCOUNT']);
		$BANK_ID = 					$this->clean($post['BANK_ID']);
		$BANK_CEO = 				$this->clean($post['BANK_CEO']);
		$FOOTER_SIGN = 				$this->cleanHTML($post['FOOTER_SIGN']);

		$q = "UPDATE MAIN_CONFIG SET 
			`ADDR` = '$ADDR', 
			`MOB_PHONE` = '$MOB_PHONE', 
			`CITY_PHONE` = '$CITY_PHONE', 
			`REF_PHONE` = '$REF_PHONE', 
			`INFO_MAIL` = '$INFO_MAIL', 
			`SEND_MAIL` = '$SEND_MAIL', 
			`BANK_TINCAT` = '$BANK_TINCAT', 
			`BANK_STATE_NUMBER` = '$BANK_STATE_NUMBER', 
			`BANK_CHECKING_ACCOUNT` = '$BANK_CHECKING_ACCOUNT', 
			`BANK_NAME` = '$BANK_NAME', 
			`BANK_CORR_ACCOUNT` = '$BANK_CORR_ACCOUNT', 
			`BANK_ID` = '$BANK_ID', 
			`BANK_CEO` = '$BANK_CEO', 
			`FOOTER_SIGN` = '$FOOTER_SIGN';";
		return $this->db->bool($q);
	}


	public function verSiteSettings(){
		return true;
	}
	public function saveSiteSettings(){
		
	}


	public function verSitePageGroups(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		if(TRUE){
			return true;
		}
		return false;
	}
	public function saveSitePageGroups(){
		
	}


	public function verSiteCaseGroups(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		if(isset($post['ID']) && ($post['ID'] >= 0) && isset($post['TYPE']) && ($post['TYPE'] > 0) && isset($post['NAME']) && ($post['NAME'] != '')){
			return true;
		}
		return false;
	}
	public function saveSiteCaseGroups(){
		$post = array_change_key_case($_POST, CASE_UPPER);

		$ID =				$this->clean($post['ID']); 
		$TYPE =				$this->clean($post['TYPE']); 
		$NAME =				$this->clean($post['NAME']); 
		$SERIAL_NUMBER =	$this->clean($post['SERIAL_NUMBER']); 
		if($SERIAL_NUMBER == ''){
			$q = 'SELECT MAX(SERIAL_NUMBER)+1 FROM CASE_GROUPS WHERE VAL_TYPE = '.$TYPE;
			$SERIAL_NUMBER = $this->db->column($q);
			if($SERIAL_NUMBER == null){
				$SERIAL_NUMBER = 1;
			}
		}

		if($ID == 0){
			$q = "INSERT INTO CASE_GROUPS (`VAL_TYPE`, `NAME`, `SERIAL_NUMBER`) VALUES ($TYPE, '$NAME', $SERIAL_NUMBER)";			
		}else{
			$q = "UPDATE CASE_GROUPS SET `VAL_TYPE` = $TYPE, `NAME` = '$NAME', `SERIAL_NUMBER` = $SERIAL_NUMBER WHERE ID = $ID";

		}
		return $this->db->bool($q);
	}


	public function verSiteCases(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		if(isset($post['ID']) && ($post['ID'] >= 0) && isset($post['GROUP']) && !empty($post['GROUP']) && isset($post['NAME']) && !empty($post['NAME']) && ($post['DIRS_NUMBER'] != '')){
			return true;
		}
		return false;
	}
	public function saveSiteCases(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		$files = array_change_key_case($_FILES, CASE_UPPER);

		$ID = 				$this->clean($post['ID']);

		$ID_GROUP = 		$this->clean($post['GROUP']);
		$NAME = 			$this->clean($post['NAME']);
		$SERIAL_NUMBER = 	$this->clean($post['SERIAL_NUMBER']);

		$TITLE = 			$this->cleanHTML($post['MENU_TITLE']);
		$DIRS_NUMBER = 		$this->clean($post['DIRS_NUMBER']);
		//$ALL_IMAGE = 		$this->clean($post['ALL_IMAGE']);
		$ALL_IMAGE = 1;
		if($ALL_IMAGE == 1){
			$DES_IMAGE = $this->loadImage(self::IMAGE_DES.self::IMAGE_LOAD_DIR_TOURS, $files['DES_IMAGE']);
			$MOB_IMAGE = $this->loadImage(self::IMAGE_MOB.self::IMAGE_LOAD_DIR_TOURS, $files['DES_IMAGE']);
			$TAB_IMAGE = $this->loadImage(self::IMAGE_TAB.self::IMAGE_LOAD_DIR_TOURS, $files['DES_IMAGE']);
			
		}elseif($ALL_IMAGE == 0){
			$DES_IMAGE = 	$this->loadImage(self::IMAGE_DES.self::IMAGE_LOAD_DIR_TOURS, $files['DES_IMAGE']);
			$MOB_IMAGE = 	$this->loadImage(self::IMAGE_MOB.self::IMAGE_LOAD_DIR_TOURS, $files['MOB_IMAGE']);
			$TAB_IMAGE = 	$this->loadImage(self::IMAGE_TAB.self::IMAGE_LOAD_DIR_TOURS, $files['TAB_IMAGE']);
		}else{
			$DES_IMAGE = $MOB_IMAGE = $TAB_IMAGE = '';
		}

		$MAIN_TITLE = 		$this->cleanHTML($post['MAIN_BLOCK_TITLE']);
		$MAIN_TEXT = 		$this->cleanHTML($post['MAIN_BLOCK_TEXT']);
		$MAIN_IMAGE = 		$this->loadImage(self::IMAGE_DES.self::IMAGE_LOAD_DIR_TOURS, $files['MAIN_BLOCK_IMAGE']);
							$this->loadImage(self::IMAGE_MOB.self::IMAGE_LOAD_DIR_TOURS, $files['MAIN_BLOCK_IMAGE']);
							$this->loadImage(self::IMAGE_TAB.self::IMAGE_LOAD_DIR_TOURS, $files['MAIN_BLOCK_IMAGE']);
		$BLOCK_2_TITLE = 	$this->cleanHTML($post['BLOCK_2_TITLE']);
		$BLOCK_2_TEXT = 	$this->cleanHTML($post['BLOCK_2_TEXT']);
		$BLOCK_2_IMAGE = 	$this->loadImage(self::IMAGE_DES.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_2_IMAGE']);
							$this->loadImage(self::IMAGE_MOB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_2_IMAGE']);
							$this->loadImage(self::IMAGE_TAB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_2_IMAGE']);
		$BLOCK_3_TITLE = 	$this->cleanHTML($post['BLOCK_3_TITLE']);
		$BLOCK_3_TEXT = 	$this->cleanHTML($post['BLOCK_3_TEXT']);
		$BLOCK_3_IMAGE = 	$this->loadImage(self::IMAGE_DES.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_3_IMAGE']);
							$this->loadImage(self::IMAGE_MOB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_3_IMAGE']);
							$this->loadImage(self::IMAGE_TAB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_3_IMAGE']);
		$BLOCK_4_TITLE = 	$this->cleanHTML($post['BLOCK_4_TITLE']);
		$BLOCK_4_TEXT = 	$this->cleanHTML($post['BLOCK_4_TEXT']);
		$BLOCK_4_IMAGE_1 = 	$this->loadImage(self::IMAGE_DES.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_4_IMAGE1']);
							$this->loadImage(self::IMAGE_MOB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_4_IMAGE1']);
							$this->loadImage(self::IMAGE_TAB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_4_IMAGE1']);
		$BLOCK_4_IMAGE_2 = 	$this->loadImage(self::IMAGE_DES.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_4_IMAGE2']);
							$this->loadImage(self::IMAGE_MOB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_4_IMAGE2']);
							$this->loadImage(self::IMAGE_TAB.self::IMAGE_LOAD_DIR_CASES, $files['BLOCK_4_IMAGE2']);
		$VISA_TITLE = 		$this->cleanHTML($post['VISA_TITLE']);

		if($ID == 0){
			$tran = [
				0 => [
					'sql' => "INSERT INTO CASE_LIST (`ID_GROUP`, `NAME`, `SERIAL_NUMBER`) VALUES ($ID_GROUP, '$NAME', $SERIAL_NUMBER);",
					'params' => []
				],
				1 => [
					'sql' => "INSERT INTO CASE_MENU (`ID_CASE`, `TITLE`, `DIRS_NUMBER`, `DES_IMAGE`, `MOB_IMAGE`, `TAB_IMAGE`) 
					VALUES ((SELECT MAX(ID) FROM CASE_LIST), '$TITLE', $DIRS_NUMBER, '$DES_IMAGE', '$MOB_IMAGE', '$TAB_IMAGE');",
					'params' => []
				],
				2 => [
					'sql' => "INSERT INTO CASE_PAGE (`ID_CASE`, `MAIN_TITLE`, `MAIN_TEXT`, `MAIN_IMAGE`, `BLOCK_2_TITLE`, `BLOCK_2_TEXT`, `BLOCK_2_IMAGE`, `BLOCK_3_TITLE`, `BLOCK_3_TEXT`, `BLOCK_3_IMAGE`, `BLOCK_4_TITLE`, `BLOCK_4_TEXT`, `BLOCK_4_IMAGE_1`, `BLOCK_4_IMAGE_2`, `VISA_TITLE`) 
					VALUES ((SELECT MAX(ID) FROM CASE_LIST), 
					'$MAIN_TITLE', '$MAIN_TEXT', '$MAIN_IMAGE', 
					'$BLOCK_2_TITLE', '$BLOCK_2_TEXT', '$BLOCK_2_IMAGE',
					'$BLOCK_3_TITLE', '$BLOCK_3_TEXT', '$BLOCK_3_IMAGE',
					'$BLOCK_4_TITLE', '$BLOCK_4_TEXT', '$BLOCK_4_IMAGE_1', '$BLOCK_4_IMAGE_2',
					'$VISA_TITLE');",
					'params' => []
				]
			];
			return $this->db->transaction($tran);
		}else{
			$tran = [
				0 => [
					'sql' => "UPDATE CASE_LIST SET
						`ID_GROUP` = $ID_GROUP, 
						`NAME` = '$NAME', 
						`SERIAL_NUMBER` = $SERIAL_NUMBER
					WHERE `ID` = $ID",
					'params' => []
				],
				1 => [
					'sql' => "UPDATE CASE_MENU SET
						`TITLE` = '$TITLE', 
						".(($DES_IMAGE != '') ? "`DES_IMAGE` = '$DES_IMAGE'," : '')."
						".(($MOB_IMAGE != '') ? "`MOB_IMAGE` = '$MOB_IMAGE'," : '')."
						".(($TAB_IMAGE != '') ? "`TAB_IMAGE` = '$TAB_IMAGE'," : '')."
						`DIRS_NUMBER` = $DIRS_NUMBER
					WHERE `ID_CASE` = $ID;",
					'params' => []
				],
				2 => [
					'sql' => "UPDATE CASE_PAGE SET
						`ID_CASE` = $ID, 
						`MAIN_TITLE` = '$MAIN_TITLE', 
						`MAIN_TEXT` = '$MAIN_TEXT',
						".(($MAIN_IMAGE != '') ? "`MAIN_IMAGE` = '$MAIN_IMAGE'," : '')."
						`BLOCK_2_TITLE` = '$BLOCK_2_TITLE', 
						`BLOCK_2_TEXT` = '$BLOCK_2_TEXT', 
						".(($BLOCK_2_IMAGE != '') ? "`BLOCK_2_IMAGE` = '$BLOCK_2_IMAGE'," : '')."
						`BLOCK_3_TITLE` = '$BLOCK_3_TITLE', 
						`BLOCK_3_TEXT` = '$BLOCK_3_TEXT', 
						".(($BLOCK_3_IMAGE != '') ? "`BLOCK_3_IMAGE` = '$BLOCK_3_IMAGE'," : '')."
						`BLOCK_4_TITLE` = '$BLOCK_4_TITLE', 
						`BLOCK_4_TEXT` = '$BLOCK_4_TEXT',  
						".(($BLOCK_4_IMAGE_1 != '') ? "`BLOCK_4_IMAGE_1` = '$BLOCK_4_IMAGE_1'," : '')."
						".(($BLOCK_4_IMAGE_2 != '') ? "`BLOCK_4_IMAGE_2` = '$BLOCK_4_IMAGE_2'," : '')."
						`VISA_TITLE` = '$VISA_TITLE'
					WHERE `ID_CASE` = $ID;",
					'params' => []
				]
			];
			return $this->db->transaction($tran);
		}
	}



	public function verSitePageGroups_Del(){
		return true;
	}
	public function delSitePageGroups(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		$ID = $this->clean($post['ID']);
		$q = '';
		return $this->db->bool($q);
	}


	public function verSiteCaseGroups_Del(){
		return true;
	}
	public function delSiteCaseGroups(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		$ID = $this->clean($post['ID']);
		$tran = [
			0 => [
				'sql' => "DELETE FROM CASE_GROUPS WHERE `ID` = $ID",
				'params' => []
			],

			1 => [
				'sql' => "DELETE FROM CASE_MENU WHERE `ID_CASE` IN (SELECT ID FROM CASE_LIST WHERE ID_GROUP = $ID)",
				'params' => []
			],
			2 => [
				'sql' => "DELETE FROM CASE_PAGE WHERE `ID_CASE` IN (SELECT ID FROM CASE_LIST WHERE ID_GROUP = $ID)",
				'params' => []
			],

			3 => [
				'sql' => "DELETE FROM CASE_LIST WHERE `ID_GROUP` = $ID",
				'params' => []
			],
		];
		return $this->db->transaction($tran);
	}


	public function verSiteCases_Del(){
		return true;
	}
	public function delSiteCases(){
		$post = array_change_key_case($_POST, CASE_UPPER);
		$ID = $this->clean($post['ID']);
		$tran = [
			0 => [
				'sql' => "DELETE FROM CASE_LIST WHERE `ID` = $ID",
				'params' => []
			],
			1 => [
				'sql' => "DELETE FROM CASE_MENU WHERE `ID_CASE` = $ID",
				'params' => []
			],
			2 => [
				'sql' => "DELETE FROM CASE_PAGE WHERE `ID_CASE` = $ID",
				'params' => []
			],
		];
		return $this->db->transaction($tran);
	}








	private function loadImage($dir, $file){
		if($file['size'] > 0){
			$this->imgOptimize($file['tmp_name']);
			$name = pathinfo($file['name'])['filename'];
			if(copy($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$dir.basename($file['name']))){
	            return $name;
	        }
	   	}
	   	return '';
	}

	private function imgOptimize($image){

	}























	
}