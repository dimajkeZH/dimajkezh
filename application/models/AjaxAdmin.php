<?php

namespace application\models;

use application\models\Admin;

class AjaxAdmin extends Admin {

	public function updCron(){
		CronAdmin::updMenu();
		CronAdmin::updSlicks();
	}

	const IMAGE_CATALOG_SERVICES_GROUP = 'services/';
	const IMAGE_CATALOG_BUSES = 'buses/';
	const IMAGE_CATALOG_MINIVANS = 'minivans/';
	const IMAGE_CATALOG_EXCURSIONS = 'excursions/';

	const IMAGE_HEADER_PAGE_EXCURSIONS = 'excursions/';






	const IMAGE_LOAD_DIR_TOURS = 'tours/';
	const IMAGE_LOAD_DIR_CASES = 'case_img/';

	public function verConfigs($post){
		return true;
	}
	public function saveConfigs($post){

	}


	public function verContent($post){
		return true;
	}
	public function saveContent($post){

	}


	public function verSettings($post){
		return true;
	}
	public function saveSettings($post){

	}


	public function verPageGroups($post){
		if(TRUE){
			return true;
		}
		return false;
	}
	public function savePageGroups($post){
		$common = array_shift($post);

		$ID = $common['ID_PAGE'];

		$HTML_TITLE = $common['HTML_TITLE'];
		$HTML_DESCR = $common['HTML_DESCR'];
		$HTML_KEYWORDS = $common['HTML_KEYWORDS'];

		if($ID > 0){
			$tran = [
				0 => [
					'sql' => 'UPDATE PAGE_GROUPS SET 
						`HTML_TITLE` = "'.$HTML_TITLE.'", 
						`HTML_DESCR` = "'.$HTML_DESCR.'", 
						`HTML_KEYWORDS` = "'.$HTML_KEYWORDS.'"
					WHERE ID = :ID',
					'params' => [
						'ID' => $ID
					]
				]
			];
			foreach($post[0] as $key => $val){
				$tran = array_merge($tran, [
					0 => [
						'sql' => 'UPDATE PAGE_GROUPS_CONTENT SET VAL = :VAL WHERE (ID_GROUP = :ID) AND (VAR LIKE :VAR)',
						'params' => [
							'ID' => $ID,
							'VAR' => $key,
							'VAL' => $val
						]
					]
				]);
			}
			return $this->db->transaction($tran);
		}
		
		return false;
	}

	public function verSavePages($post){
		if(TRUE){
			return true;
		}
		return false;
	}
	public function savePages($post, $files){
		debug($post);
		$common = array_shift($post);

		$ID = $common['ID_PAGE'];
		$ID_TYPE = $common['ID_TYPE'];

		$TITLE = $common['TITLE'];
		$IMAGE = $files['IMAGE_0'];
		if(($IMAGE['size'] > 0) && ($IMAGE['name'] != '')){
			$IMAGE = $this->loadImage($this->casePath($ID), $IMAGE);
			if($IMAGE != ''){
				$IMAGE = '`IMAGE` = "'.$IMAGE.'",';
			}
		}else{
			$IMAGE = '';
		}
		$LOC_NUMBER = $common['LOC_NUMBER'];
		$HTML_DESCR = $common['HTML_DESCR'];
		$HTML_KEYWORDS = $common['HTML_KEYWORDS'];
		//debug(123);
		if($ID > 0){
			$tran = [
				0 => [
					'sql' => 	'UPDATE PAGES SET 
									`LOC_NUMBER` = "'.$LOC_NUMBER.'", 
									`TITLE` = "'.$TITLE.'", 
									'.$IMAGE.' 
									`HTML_DESCR` = "'.$HTML_DESCR.'", 
									`HTML_KEYWORDS` = "'.$HTML_KEYWORDS.'"
								WHERE ID = :ID',
					'params' => [
						'ID' => $ID
					]
				]
			];
			foreach($post as $key => $val){
				$tran = array_merge($tran, $this->switchUPDTemplate($val, $files));
			}
			debug($tran);
			//debug(123);
			return $this->db->transaction($tran);
		}elseif($ID == 0){
			//insert
		}
		return false;
	}

	public function verPages_del($post){
		if(TRUE){
			return true;
		}
		return false;
	}
	public function delPages($post){

	}















	private function switchUPDTemplate($val, $files){
		debug($val);
		switch($val['TYPE']){
			case 'H1': //order
				$LEFT_IMAGE = $this->loadImage($this->casePath($val['ID']), $files['LEFT_IMAGE_'.$val['ID']]);
				debug($LEFT_IMAGE);
				$return[0]['sql'] = 'UPDATE BLOCK_HEADER_ORDER SET `TITLE` = "'.$val['TITLE'].'",'
				.(($val['LEFT_IMAGE'] != '')?'`LEFT_IMAGE` = "'.$val['LEFT_IMAGE'].'",':'').
				'`LEFT_IMAGE_SIGN` = "'.$val['LEFT_IMAGE_SIGN'].'",'
				.(($val['RIGHT_IMAGE'] != '')?'`RIGHT_IMAGE` = "'.$val['RIGHT_IMAGE'].'",':'').
				'`RIGHT_IMAGE_SIGN` = "'.$val['RIGHT_IMAGE_SIGN'].'" WHERE ID = :ID;';
				$return[0]['params'] = ['ID' => $val['ID']];
				break;
			case 'H2': //images
				$return[0]['sql'] = 'UPDATE BLOCK_HEADER_IMAGES SET `TITLE` = "'.$val['TITLE'].'",'
				.(($val['LEFT_IMAGE'] != '')?'`LEFT_IMAGE` = "'.$val['LEFT_IMAGE'].'",':'').' `LEFT_IMAGE_SIGN` = "'.$val['LEFT_IMAGE_SIGN'].'",'
				.(($val['RIGHT_IMAGE'] != '')?'`RIGHT_IMAGE` = "'.$val['RIGHT_IMAGE'].'",':'').' `RIGHT_IMAGE_SIGN` = "'.$val['RIGHT_IMAGE_SIGN'].'",' 
				.(($val['MIDDLE_IMAGE'] != '')?'`MIDDLE_IMAGE` = "'.$val['MIDDLE_IMAGE'].'",':'').' `MIDDLE_IMAGE_SIGN` = "'.$val['MIDDLE_IMAGE_SIGN'].'" WHERE ID = :ID;';
				$return[0]['params'] = ['ID' => $val['ID']];
				break;
			case 'B1': //table
				//$return[0]['sql'] = 'UPDATE BLOCK_TABLE SET WHERE ID = :ID;';
				//$return[0]['params'] = ['ID' => $val['ID']];
				/*
				foreach(){
					//DATA_TABLE WHERE COL, ROW, ID_TABLE
				}
				*/
				break;
			case 'B2': //multitable
				//$return[0]['sql'] = 'UPDATE BLOCK_MULTITABLE SET WHERE ID = :ID;';
				//$return[0]['params'] = ['ID' => $val['ID']];
				/*
				foreach(){
					//BLOCK_MULTITABLE_CONTENT WHERE ID+MULTITABLE
					foreach(){
						//DATA_MULTITABLE WHERE ID_MULTITABLE_CONTENT, ROW, COL
					}
				}
				*/
				break;
			case 'B3': //text
				$return[0]['sql'] = 'UPDATE BLOCK_TEXT SET `TITLE` = "'.$val['TITLE'].'", `TEXT` = "'.$val['TEXT'].'" WHERE ID = :ID;';
				$return[0]['params'] = ['ID' => $val['ID']];
				break;
			case 'B4': //image
				$return[0]['sql'] = 'UPDATE BLOCK_IMAGES SET `TITLE` = "'.$val['TITLE'].'", `DESCR` = "'.$val['DESCR'].'" WHERE ID = :ID;';
				$return[0]['params'] = ['ID' => $val['ID']];
				$images = [];
				$arrFields = ['ID_IMAGE_CONTENT', 'SUBTITLE', 'IMAGE_LINK', 'IMAGE_SIGN', 'SERIAL_NUMBER'];
				foreach($val as $subkey => $subval){
					foreach($arrFields as $arrKey => $arrVal){
						if(preg_match('#^'.$arrVal.'[0-9]{0,}$#', $subkey)){
							if(!isset($images[$arrVal])){
								$images[$arrVal] = [];
							}
							array_push($images[$arrVal], $subval);
						}
					}
				}
				foreach($images as $key => $val){
					foreach($val as $subkey => $subval){
						$newimages[$subkey][$key] = $subval;
					}
				}
				foreach($newimages as $subkey => $subval){
					$return[$subkey+1]['sql'] = 'UPDATE BLOCK_IMAGE_CONTENT SET `SUBTITLE` = "'.$subval['SUBTITLE'].'", `IMAGE_LINK` = "'.$subval['IMAGE_LINK'].'", `IMAGE_SIGN` = "'.$subval['IMAGE_SIGN'].'", `SERIAL_NUMBER` = "'.$subval['SERIAL_NUMBER'].'" WHERE ID = :ID;';
					$return[$subkey+1]['params'] = ['ID' => $subval['ID_IMAGE_CONTENT']];
				}
				break;
			case 'B5': //links
				//$return[0]['sql'] = 'UPDATE  SET () WHERE ID = :ID;';
				//$return[0]['params'] = ['ID' => $val['ID']];
				break;
			case 'EXC1': //excursion 1
				$index = 0;
				foreach($val as $subkey => $subval){
					$return[$index]['sql'] = 'UPDATE PAGE_FULL_CONTENT SET VAL = :VAL WHERE (ID_FULL_PAGE = :ID) AND (VAR = :VAR);';
					$return[$index++]['params'] = [
						'ID' => $val['ID'],
						'VAR' => $subkey,
						'VAL' => $subval
					];
				}
				break;
		}
		return $return;
	}

	private function casePath($ID){
		$q = 'SELECT ID_GROUP FROM PAGES WHERE ID = :ID';
		$params = [
			'ID' => $ID
		];
		$ID_GROUP = $this->db->row($q, $params)[0]['ID_GROUP'];
		switch($ID_GROUP){
			case 2:
				return self::IMAGE_CATALOG_SERVICES;
			case 3:
				return self::IMAGE_CATALOG_BUSES;
			case 4:
				return self::IMAGE_CATALOG_MINIVANS;
			case 5:
				return self::IMAGE_CATALOG_EXCURSIONS;
		}
		return '';
	}

	private function loadImage($dir, $file){
		if($file['size'] > 0){
			$this->imgOptimize($file['tmp_name']);
			$name = $this->generateStr(64);
			//debug($_SERVER['DOCUMENT_ROOT'].'/assets/img/'.$dir.$name.'.'.self::IMAGE_FILE_FORMAT);
			if(copy($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/assets/img/'.$dir.$name.'.'.self::IMAGE_FILE_FORMAT)){
	            return $name;
	        }
	   	}
	   	return '';
	}

	private function imgOptimize($image){

	}

	public function toPost($json){
		$post = [];
		$prepost = (array)json_decode($json);
		foreach($prepost as $key => $val){
			$val = (array)$val;
			foreach($val as $subkey => $subval){
				if(gettype($subval) == 'object'){
					debug($subval);
				}
				$val[$subkey] = $this->clear($subval);
			}
			$post[$key] = $val;
		}
		return array_change_key_case($post, CASE_UPPER);
	}

}