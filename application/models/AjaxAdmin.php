<?php

namespace application\models;

use application\models\Admin;

class AjaxAdmin extends Admin {

	public function updCron(){
		CronAdmin::updMenu();
		CronAdmin::updSlicks();
	}

	const IMAGE_NAME_LEN = 64;
	const IMAGE_DIR = '/assets/img/';

	const IMAGE_CATALOG_SERVICES = 'services/';
	const IMAGE_CATALOG_BUSES = 'buses/mest/';
	const IMAGE_CATALOG_BUS = 'buses/bus_catalog/';
	const IMAGE_CATALOG_MINIVANS = 'minivans/mest/';
	const IMAGE_CATALOG_MINIVAN = 'minivans/minivan_catalog/';
	const IMAGE_CATALOG_EXCURSIONS = 'excursions/';

	const IMAGE_TEMPLATE_HEADER_GROUP = 'templates/header_group/';
	const IMAGE_TEMPLATE_HEADER_PAGE = 'templates/header_page/';
	const IMAGE_TEMPLATE_BLOCK_IMAGES = 'templates/block_images/';

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

	/************************************************************* PAGE GROUPS *************************************************************/
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
	/************************************************************* PAGE GROUPS END *************************************************************/



	/************************************************************* PAGES *************************************************************/
	public function verSavePages($post){
		if(TRUE){
			return true;
		}
		return false;
		/* 
			сначала проверяем $post
			потом подгружаем фотки и делаем $file из массива имён уже загруженных фоток
			далее ошибок быть не должно -> savePages()
		 */
	}
	public function savePages($post, $files){
		$common = array_shift($post);

		$ID = $common['ID_PAGE'];
		$ID_TYPE = $common['ID_TYPE'];

		$TITLE = $common['TITLE'];
		$IMAGE = $files['IMAGE_0'];
		$IMAGE_NAME = '';
		if(($IMAGE['size'] > 0) && ($IMAGE['name'] != '')){
			$q = 'SELECT IMAGE FROM PAGES WHERE ID = :ID';
			$params = [
				'ID' => 1
			];
			$oldFile = $this->db->column($q, $params);
			if($oldFile == ''){
				$IMAGE_NAME = $this->loadImage($this->casePathCatalog($ID), $IMAGE);
				if($IMAGE_NAME != ''){
					$IMAGE_NAME = '`IMAGE` = "'.$IMAGE_NAME.'", ';
				}
			}else{
				$this->replaceImage($this->casePathCatalog($ID), $oldFile, $IMAGE);
			}			
		}
		$LOC_NUMBER = $common['LOC_NUMBER'];
		$HTML_DESCR = $common['HTML_DESCR'];
		$HTML_KEYWORDS = $common['HTML_KEYWORDS'];
		//debug(123);
		if($ID > 0){
			$tran = [
				0 => [
					'sql' => 	'UPDATE PAGES SET `LOC_NUMBER` = :LOC_NUMBER, `TITLE` = :TITLE, '.$IMAGE_NAME.'`HTML_DESCR` = :HTML_DESCR, `HTML_KEYWORDS` = :HTML_KEYWORDS WHERE ID = :ID;',
					'params' => [
						'ID' => $ID,
						'LOC_NUMBER' => $LOC_NUMBER,
						'TITLE' => $TITLE,
						'HTML_DESCR' => $HTML_DESCR,
						'HTML_KEYWORDS' => $HTML_KEYWORDS,
					]
				]
			];
			foreach($post as $key => $val){
				$tran = array_merge($tran, $this->switchUPDTemplate($val, $files));
			}
			//debug($tran);
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
	/************************************************************* PAGES END *************************************************************/















	private function switchUPDTemplate($val, $files){
		switch($val['TYPE']){
			case 'H1': //order
				$params = [
					'ID' => $val['ID']
				];
				$q = 'SELECT LEFT_IMAGE, RIGHT_IMAGE FROM BLOCK_HEADER_ORDER WHERE ID = :ID';
				$oldFiles = $this->db->row($q, $params)[0];
				$oldL = $oldFiles['LEFT_IMAGE'];
				$oldR = $oldFiles['RIGHT_IMAGE'];
				$LEFT_IMAGE = '';
				$RIGHT_IMAGE = '';
				//load left image
				$img = $files['LEFT_IMAGE_'.$val['ID']];
				if(isset($img)){
					if($oldL == ''){
						$LEFT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
						if($LEFT_IMAGE != ''){
							$LEFT_IMAGE = '`LEFT_IMAGE` = "'.$LEFT_IMAGE.'", ';
						}
					}else{
						$this->replaceImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $oldL, $img);
					}
				}
				//load right image
				$img = $files['RIGHT_IMAGE_'.$val['ID']];
				if(isset($img)){
					if($oldR == ''){
						$RIGHT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
						if($RIGHT_IMAGE != ''){
							$RIGHT_IMAGE = '`RIGHT_IMAGE` = "'.$RIGHT_IMAGE.'", ';
						}
					}else{
						$this->replaceImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $oldR, $img);
					}
				}		
				//set sql string
				$return[0]['sql'] = 'UPDATE BLOCK_HEADER_ORDER SET '
					.'`TITLE` = "'.$val['TITLE'].'", '
					.$LEFT_IMAGE
					.'`LEFT_IMAGE_SIGN` = "'.$val['LEFT_IMAGE_SIGN'].'", '
					.$RIGHT_IMAGE
					.'`RIGHT_IMAGE_SIGN` = "'.$val['RIGHT_IMAGE_SIGN'].'" '
					.'WHERE ID = :ID;';
				//set param array
				$return[0]['params'] = $params;
				break;
			case 'H2': //images
				//load left image
				$img = $files['LEFT_IMAGE_'.$val['ID']];
				if(isset($img)){
					$LEFT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					$LEFT_IMAGE = ($LEFT_IMAGE != '')?'`LEFT_IMAGE` = "'.$LEFT_IMAGE.'", ':'';
				}else{
					$LEFT_IMAGE = '';
				}
				//load right image
				$img = $files['RIGHT_IMAGE_'.$val['ID']];
				if(isset($img)){
					$RIGHT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					$RIGHT_IMAGE = ($RIGHT_IMAGE != '') ? '`RIGHT_IMAGE` = "'.$RIGHT_IMAGE.'", ' : '';
				}else{
					$RIGHT_IMAGE = '';
				}
				//load middle image
				$img = $files['MIDDLE_IMAGE_'.$val['ID']];
				if(isset($img)){
					$MIDDLE_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					$MIDDLE_IMAGE = ($MIDDLE_IMAGE != '') ? '`MIDDLE_IMAGE` = "'.$MIDDLE_IMAGE.'", ' : '';
				}else{
					$MIDDLE_IMAGE = '';
				}
				//set sql string
				$return[0]['sql'] = 'UPDATE BLOCK_HEADER_IMAGES SET '
					.'`TITLE` = "'.$val['TITLE'].'",'
					.$LEFT_IMAGE
					.' `LEFT_IMAGE_SIGN` = "'.$val['LEFT_IMAGE_SIGN'].'",'
					.$RIGHT_IMAGE
					.' `RIGHT_IMAGE_SIGN` = "'.$val['RIGHT_IMAGE_SIGN'].'",' 
					.$MIDDLE_IMAGE
					.' `MIDDLE_IMAGE_SIGN` = "'.$val['MIDDLE_IMAGE_SIGN'].'" '
					.'WHERE ID = :ID;';
				//set param array
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
				//set sql string
				$return[0]['sql'] = 'UPDATE BLOCK_TEXT SET `TITLE` = "'.$val['TITLE'].'", `TEXT` = "'.$val['TEXT'].'" WHERE ID = :ID;';
				//set param array
				$return[0]['params'] = ['ID' => $val['ID']];
				break;
			case 'B4': //image
			/*
			
			LOAD IMAGES

			 */
				//set sql string
				$return[0]['sql'] = 'UPDATE BLOCK_IMAGES SET `TITLE` = "'.$val['TITLE'].'", `DESCR` = "'.$val['DESCR'].'" WHERE ID = :ID;';
				//set param array
				$return[0]['params'] = ['ID' => $val['ID']];
				/*
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
				*/
				break;
			case 'B5': //links
				//$return[0]['sql'] = 'UPDATE  SET () WHERE ID = :ID;';
				//$return[0]['params'] = ['ID' => $val['ID']];
				break;
			case 'EXC1': //excursion 1
			/*
			
			LOAD IMAGES

			 */
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

	private function casePathCatalog($ID){
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
			$path = $_SERVER['DOCUMENT_ROOT'].self::IMAGE_DIR.$dir;
			if(file_exists($path)){
				do{
					$name = $this->generateStr(self::IMAGE_NAME_LEN);
					$full_name = $name.'.'.self::IMAGE_FILE_FORMAT;
					$newfile = $path.$full_name;
				}while(file_exists($newfile));
				$this->imgOptimize($file['tmp_name']);
				if(copy($file['tmp_name'], $newfile)){
		            return $name;
		        }
			}
	   	}
	   	return '';
	}

	private function replaceImage($dir, $oldFile, $newfile){
		if($newfile['size'] > 0){
			$oldFile = $_SERVER['DOCUMENT_ROOT'].self::IMAGE_DIR.$dir.$oldFile.'.'.self::IMAGE_FILE_FORMAT;
			$this->imgOptimize($newfile['tmp_name']);
			if(copy($newfile['tmp_name'], $oldFile)){
	            return true;
	        }
	   	}
	   	return false;
	}

	private function imgOptimize($image){
		return;
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