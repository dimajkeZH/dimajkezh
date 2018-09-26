<?php

namespace application\models;

use application\models\Admin;

class AjaxAdmin extends Admin {

	public function updCron(){
		$c = new CronAdmin();
		$c->updMenu();
		$c->updSlicks();
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

	const TEMPLATES_DIR = '/application/views/mainAdmin/templates/';

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
		#debug($post);
		$common = array_shift($post);
		#debug($common);
		$ID = $common['ID_PAGE'];
		#debug($ID);
		$ID_GROUP = ($ID == 0) ? strval($common['group']) : 0;
		$ID_TYPE = $common['ID_TYPE'];

		$TITLE = $common['TITLE'];
		if(isset($files['IMAGE_0'])){
			$IMAGE = $files['IMAGE_0'];
		}else{
			$IMAGE['name'] = '';
			$IMAGE['size'] = 0;
		}
		$IMAGE_NAME_UDP = '';
		$IMAGE_NAME_INS = '';
		if(($IMAGE['size'] > 0) && ($IMAGE['name'] != '')){
			$q = 'SELECT IMAGE FROM PAGES WHERE ID = :ID';
			$params = [
				'ID' => 1
			];
			$oldFile = $this->db->column($q, $params);
			$pathCatalog = $this->casePathCatalog($ID, $ID_GROUP);
			if($oldFile == ''){
				$IMAGE_NAME_UDP = $this->loadImage($pathCatalog, $IMAGE);
				if($IMAGE_NAME_UDP != ''){
					$IMAGE_NAME_INS = $IMAGE_NAME_UDP;
					$IMAGE_NAME_UDP = '`IMAGE` = "'.$IMAGE_NAME_UDP.'", ';
				}
			}else{
				$this->replaceImage($pathCatalog, $oldFile, $IMAGE);
			}			
		}
		$CHOICE_TITLE = $common['CHOICE_TITLE'];
		$IMAGE_SIGN = $common['IMAGE_SIGN'];
		$URI = $common['URI'];
		$LOC_NUMBER = $common['LOC_NUMBER'];
		$HTML_DESCR = $common['HTML_DESCR'];
		$HTML_KEYWORDS = $common['HTML_KEYWORDS'];

		if($ID != 0){ //update and clear
			$tran = [
				0 => [
					'sql' => 'UPDATE PAGES SET `URI` = :URI, `LOC_NUMBER` = :LOC_NUMBER, `TITLE` = :TITLE, '.$IMAGE_NAME_UDP.'`CHOICE_TITLE` = :CHOICE_TITLE, `IMAGE_SIGN` = :IMAGE_SIGN, `HTML_DESCR` = :HTML_DESCR, `HTML_KEYWORDS` = :HTML_KEYWORDS WHERE ID = :ID;',
					'params' => [
						'ID' => $ID,
						'CHOICE_TITLE' => $CHOICE_TITLE,
						'IMAGE_SIGN' => $IMAGE_SIGN,
						'URI' => $URI,
						'LOC_NUMBER' => $LOC_NUMBER,
						'TITLE' => $TITLE,
						'HTML_DESCR' => $HTML_DESCR,
						'HTML_KEYWORDS' => $HTML_KEYWORDS
					]
				]
			];

			if($ID_TYPE == 1){ //full
				$q = 'SELECT ID FROM PAGE_FULL WHERE ID_PAGE = :ID_PAGE';
				$params = [
					'ID_PAGE' => $ID
				];
				$ID_FULL_PAGE = $this->db->column($q, $params);
				$tran_delete[0] = [
					'sql' => 'DELETE FROM PAGE_FULL_CONTENT WHERE ID_FULL_PAGE = :ID_FULL_PAGE',
					'params' => [
						'ID_FULL_PAGE' => $ID_FULL_PAGE
					]
				];
				$tran = array_merge($tran, $tran_delete);
				$tran_delete[0] = [
					'sql' => 'DELETE FROM PAGE_FULL WHERE ID_PAGE = :ID_PAGE',
					'params' => [
						'ID_PAGE' => $ID
					]
				];
				$tran = array_merge($tran, $tran_delete);
			}elseif($ID_TYPE == 2){ //tmpls
				$tran_delete[0] = [
					'sql' => 'DELETE FROM PAGE_TEMPLATES WHERE ID_PAGE = :ID_PAGE',
					'params' => [
						'ID_PAGE' => $ID
					]
				];
				$tran = array_merge($tran, $tran_delete);
				
				$TMPL_LIST = [];

				$q = 'SELECT ID, ID_TEMPLATE FROM PAGE_TEMPLATES WHERE ID_PAGE = :ID_PAGE';
				$params = [
					'ID_PAGE' => $ID
				];
				$TMPL_ARRAY = $this->db->row($q, $params);

				foreach($TMPL_ARRAY as $key => $val){
					$ID_PAGE_TEMPLATE = $val['ID'];
					$ID_LIB_TEMPLATE = $val['ID_TEMPLATE'];

					$q = 'SELECT `PATH` FROM LIB_TEMPLATES WHERE ID = :ID';
					$params = [
						'ID' => $ID_LIB_TEMPLATE
					];
					$NAME_TEMPLATE = $this->db->column($q, $params);

					$list_tran = $this->switchDELTemplate($NAME_TEMPLATE, $ID_PAGE_TEMPLATE);
					//debug([$NAME_TEMPLATE, $list_tran]);
					$tran = array_merge($tran, $list_tran);
				}
			}
		}else{ //insert
			$tran = [];

			$q = 'INSERT INTO PAGES (`ID_LOCATION`, `ID_GROUP`, `ID_TYPE`, `CHOICE_TITLE`, `URI`, `LOC_NUMBER`, `TITLE`, `IMAGE`, `IMAGE_SIGN`, `HTML_DESCR`, `HTML_KEYWORDS`) VALUES ((SELECT (ID_LOCATION + 1) FROM PAGE_GROUPS WHERE ID = :ID_GROUP), :ID_GROUP, :ID_TYPE, :CHOICE_TITLE, :URI, (SELECT MAX(P.LOC_NUMBER) + 1 FROM PAGES as P WHERE P.ID_GROUP = :ID_GROUP), :TITLE, :IMAGE, :IMAGE_SIGN, :HTML_DESCR, :HTML_KEYWORDS);';
			$params = [
				'ID_GROUP' => $ID_GROUP,
				'ID_TYPE' => $ID_TYPE,
				'CHOICE_TITLE' => $CHOICE_TITLE,
				'URI' => $URI,
				'TITLE' => $TITLE,
				'IMAGE' => $IMAGE_NAME_INS,
				'IMAGE_SIGN' => $IMAGE_SIGN,
				'HTML_DESCR' => $HTML_DESCR,
				'HTML_KEYWORDS' => $HTML_KEYWORDS
			];
			$ID = $this->db->return($q, $params);
		}
		//debug($tran);
		foreach($post as $key => $val){
			$tran = array_merge($tran, $this->switchUPDTemplate($val, $files, (string)($key+1), $ID));
		}
		//debug($this->db->transaction($tran));
		if($this->db->transaction($tran)){
			return $ID;
		}else{
			return false;
		}
	}

	public function verPages_del($route){
		if(TRUE){
			return true;
		}
		return false;
	}
	
	public function delPages($route){
		$ID = $route['param'];
		$q = 'DELETE FROM PAGES WHERE ID = :ID';
		$params = [
			'ID' => $ID
		];
		return $this->db->bool($q, $params);
	}
	/************************************************************* PAGES END *************************************************************/







	public function getBlockHTML($post){
		$block = $post['BLOCK'];
		$block_path = $_SERVER['DOCUMENT_ROOT'].self::TEMPLATES_DIR.$block.'.php';
		if(file_exists($block_path)){
			ob_start();
			$ID_PAGE_TEMPLATE = $ID = -1;
			require $block_path;
			return ob_get_clean();
		}
	}

	public function checkURI($post){
		$ID_PAGE = $post['ID_PAGE'];
		$URI = $post['URI'];

		$q = 'SELECT count(*) as `COUNT` FROM PAGES WHERE (ID NOT IN (:ID)) AND (URI LIKE :URI)';
		$params = [
			'ID' => $ID_PAGE, 
			'URI' => $URI
		];
		$count = $this->db->column($q, $params);
		if($count == 0){
			return true;
		}
		return false;
	}












	private function switchDELTemplate($TMPL_TYPE, $ID_PAGE_TEMPLATE){
		$params = [
			'ID_PAGE_TEMPLATE' => $ID_PAGE_TEMPLATE
		];
		switch($TMPL_TYPE){
			case 'H1':
				$return = [
					0 => [
						'sql' => 'DELETE FROM BLOCK_HEADER_ORDER WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE',
						'params' => $params
					]
				];
				break;
			case 'H2':
				$return = [
					0 => [
						'sql' => 'DELETE FROM BLOCK_HEADER_IMAGES WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE',
						'params' => $params
					]
				];
				break;
			case 'B1':
				$return = [
					1 => [
						'sql' => 'DELETE FROM BLOCK_TABLE WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE',
						'params' => $params
					],
					0 => [
						'sql' => 'DELETE FROM DATA_TABLE WHERE ID_TABLE IN (SELECT ID FROM BLOCK_TABLE WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE)',
						'params' => $params
					]
				];
				break;
			case 'B2':
				$return = [
					2 => [
						'sql' => 'DELETE FROM BLOCK_MULTITABLE WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE',
						'params' => $params
					],
					1 => [
						'sql' => 'DELETE FROM BLOCK_MULTITABLE_CONTENT WHERE ID_MULTITABLE IN (SELECT ID FROM BLOCK_MULTITABLE WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE)',
						'params' => $params
					],
					0 => [
						'sql' => 'DELETE FROM DATA_MULTITABLE WHERE ID_MULTITABLE_CONTENT IN (SELECT ID FROM BLOCK_MULTITABLE_CONTENT WHERE ID_MULTITABLE IN (SELECT ID FROM BLOCK_MULTITABLE WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE))',
						'params' => $params
					]
				];
				break;
			case 'B3':
				$return = [
					0 => [
						'sql' => 'DELETE FROM BLOCK_TEXT WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE',
						'params' => $params
					]
				];
				break;
			case 'B4':
				$return = [
					1 => [
						'sql' => 'DELETE FROM BLOCK_IMAGES WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE',
						'params' => $params
					],
					0 => [
						'sql' => 'DELETE FROM BLOCK_IMAGE_CONTENT WHERE ID_IMAGE IN (SELECT ID FROM BLOCK_IMAGES WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE)',
						'params' => $params
					]
				];
				break;
			case 'B5':
				$return = [
					1 => [
						'sql' => 'DELETE FROM BLOCK_LINKS WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE',
						'params' => $params
					],
					0 => [
						'sql' => 'DELETE FROM BLOCK_LINKS_CONTENT WHERE ID_LINK IN (SELECT ID FROM BLOCK_LINKS WHERE ID_PAGE_TEMPLATE = :ID_PAGE_TEMPLATE)',
						'params' => $params
					]
				];
				break;
			case 'EXC1':
				return [];
				break;
		}
		return $return;
	}




	private function getTMPLid($NAME){
		$q = 'SELECT ID FROM LIB_TEMPLATES WHERE `PATH` LIKE :PATH;';
		$params = [
			'PATH' => $NAME
		];
		return $this->db->column($q, $params);
	}

	private function getTMPLtype($ID){
		$q = 'SELECT ID_TYPE FROM PAGES WHERE ID = :ID;';
		$params = [
			'ID' => $ID
		];
		return $this->db->column($q, $params);
	}

	private function switchUPDTemplate($val, $files, $SN, $ID_PAGE){
		$NAME_TMPL = $val['TYPE'];
		$TYPE = $this->getTMPLtype($ID_PAGE);
		$ID_TEMPLATE = $this->getTMPLid($NAME_TMPL);

		$index = 0;

		switch($NAME_TMPL){
			case 'EXC1':
				$return[$index]['sql'] = 'INSERT INTO PAGE_FULL (`ID_PAGE`, `ID_TEMPLATE`) VALUES (:IP, :IT);';
				$return[$index++]['params'] = [
					'IP' => $ID_PAGE,
					'IT' => $ID_TEMPLATE
				];
				break;
			default:
				$return[$index]['sql'] = 'INSERT INTO PAGE_TEMPLATES (`ID_PAGE`, `ID_TEMPLATE`, `SERIAL_NUMBER`) VALUES (:IP, :IT, :SN);';
				$return[$index++]['params'] = [
					'IP' => $ID_PAGE,
					'IT' => $ID_TEMPLATE,
					'SN' => $SN
				];
				break;
		}
		
		$NUMERIC_PART_IMAGE = $SN;

		switch($NAME_TMPL){
			case 'H1': //order
				$oldImages = $this->db->row('SELECT LEFT_IMAGE, RIGHT_IMAGE FROM BLOCK_HEADER_ORDER WHERE ID = :ID', ['ID'=>$val['ID']])[0];
				$oldL = isset($oldImages['LEFT_IMAGE']) ? $oldImages['LEFT_IMAGE'] : '';
				$oldR = isset($oldImages['RIGHT_IMAGE']) ? $oldImages['RIGHT_IMAGE'] : '';
				$LEFT_IMAGE = '';
				$RIGHT_IMAGE = '';
				//load left image
				if(isset($files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE]) && $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE] != '' && $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE]['size'] > 0){
					$img = $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE];
					if($oldL != ''){
						$LEFT_IMAGE = $this->replaceImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $oldL, $img);
					}else{
						$LEFT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					}
				}else{
					if($oldL != ''){
						$LEFT_IMAGE = $oldL;
					}
				}

				//load right image
				if(isset($files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE]) && $files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE] != '' && $files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE]['size'] > 0){
					$img = $files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE];
					if($oldR != ''){
						$RIGHT_IMAGE = $this->replaceImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $oldR, $img);
					}else{
						$RIGHT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					}
				}else{
					if($oldR != ''){
						$RIGHT_IMAGE = $oldR;
					}
				}

				//set sql string
				$return[$index++]['sql'] = 'INSERT INTO BLOCK_HEADER_ORDER (`ID_PAGE_TEMPLATE`, `TITLE`, `LEFT_IMAGE`, `LEFT_IMAGE_SIGN`, `RIGHT_IMAGE`, `RIGHT_IMAGE_SIGN`) VALUES ('
					.'(SELECT MAX(ID) FROM PAGE_TEMPLATES), '
					.'"'.$val['TITLE'].'", '
					.'"'.$LEFT_IMAGE.'", '
					.'"'.$val['LEFT_IMAGE_SIGN'].'", '
					.'"'.$RIGHT_IMAGE.'", '
					.'"'.$val['RIGHT_IMAGE_SIGN'].'");';
				break;
			case 'H2': //images
				//debug([$files, isset($files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE]) && $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE] != '' && $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE]['size'] > 0]);
				$oldImages = $this->db->row('SELECT LEFT_IMAGE, MIDDLE_IMAGE, RIGHT_IMAGE FROM BLOCK_HEADER_IMAGES WHERE ID = :ID', ['ID'=>$val['ID']])[0];

				$oldL = isset($oldImages['LEFT_IMAGE']) ? $oldImages['LEFT_IMAGE'] : '';
				$oldM = isset($oldImages['MIDDLE_IMAGE']) ? $oldImages['MIDDLE_IMAGE'] : '';
				$oldR = isset($oldImages['RIGHT_IMAGE']) ? $oldImages['RIGHT_IMAGE'] : '';

				$LEFT_IMAGE = '';
				$MIDDLE_IMAGE = '';
				$RIGHT_IMAGE = '';
				//load left image
				if(isset($files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE]) && $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE] != '' && $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE]['size'] > 0){
					$img = $files['LEFT_IMAGE_'.$NUMERIC_PART_IMAGE];
					if($oldL != ''){
						$LEFT_IMAGE = $this->replaceImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $oldL, $img);
					}else{
						$LEFT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					}
				}else{
					if($oldL != ''){
						$LEFT_IMAGE = $oldL;
					}
				}
				//load middle image
				if(isset($files['MIDDLE_IMAGE_'.$NUMERIC_PART_IMAGE]) && $files['MIDDLE_IMAGE_'.$NUMERIC_PART_IMAGE] != '' && $files['MIDDLE_IMAGE_'.$NUMERIC_PART_IMAGE]['size'] > 0){
					$img = $files['MIDDLE_IMAGE_'.$NUMERIC_PART_IMAGE];
					if($oldM != ''){
						$MIDDLE_IMAGE = $this->replaceImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $oldM, $img);
					}else{
						$MIDDLE_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					}
				}else{
					if($oldM != ''){
						$MIDDLE_IMAGE = $oldM;
					}
				}
				//load right image
				if(isset($files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE]) && $files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE] != '' && $files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE]['size'] > 0){
					$img = $files['RIGHT_IMAGE_'.$NUMERIC_PART_IMAGE];
					if($oldR != ''){
						$RIGHT_IMAGE = $this->replaceImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $oldR, $img);
					}else{
						$RIGHT_IMAGE = $this->loadImage(self::IMAGE_TEMPLATE_HEADER_PAGE, $img);
					}
				}else{
					if($oldR != ''){
						$RIGHT_IMAGE = $oldR;
					}
				}
				
				//set sql string
				$return[$index++]['sql'] = 'INSERT INTO BLOCK_HEADER_IMAGES (`ID_PAGE_TEMPLATE`, `TITLE`, `LEFT_IMAGE`, `LEFT_IMAGE_SIGN`, `RIGHT_IMAGE`, `RIGHT_IMAGE_SIGN`, `MIDDLE_IMAGE`, `MIDDLE_IMAGE_SIGN`) VALUES ('
					.'(SELECT MAX(ID) FROM PAGE_TEMPLATES), '
					.'"'.$val['TITLE'].'", '
					.'"'.$LEFT_IMAGE.'", '
					.'"'.$val['LEFT_IMAGE_SIGN'].'", '
					.'"'.$RIGHT_IMAGE.'", '
					.'"'.$val['RIGHT_IMAGE_SIGN'].'", ' 
					.'"'.$MIDDLE_IMAGE.'", '
					.'"'.$val['MIDDLE_IMAGE_SIGN'].'");';
				//debug([$return, $val['ID'], $oldImages, $oldL, $oldM, $oldR, $LEFT_IMAGE, $MIDDLE_IMAGE, $RIGHT_IMAGE]);
				break;
			case 'B1': //table
				$return[$index]['sql'] = 'INSERT INTO BLOCK_TABLE (ID_PAGE_TEMPLATE, TITLE, SUBTITLE, DESCR) VALUES ((SELECT MAX(ID) FROM PAGE_TEMPLATES), :TITLE, :SUBTITLE, :DESCR)';
				$return[$index++]['params'] = [
					'TITLE' => $val['TITLE'],
					'SUBTITLE' => $val['SUBTITLE'],
					'DESCR' => $val['DESCR']
				];
				
				$TABLE_DATA = [];
				foreach($val as $key => $value){
					if(preg_match('#^CELL_TABLE[0-9]{0,}_[0-9]{1,}_[0-9]{1,}$#', $key)){
						$c = explode('CELL_TABLE', $key)[1];
						list($cell_index, $cell_row, $cell_col) = explode('_', $c);
						$CELL['VAL'] = $value;
						$CELL['ROW'] = $cell_row;
						$CELL['COL'] = $cell_col;
						if(isset($TABLE_DATA)){
							array_push($TABLE_DATA, $CELL);
						}else{
							$TABLE_DATA[0] = $CELL;
						}
					}
				}

				foreach($TABLE_DATA as $subkey => $subval){
					$return[$index]['sql'] = 'INSERT INTO DATA_TABLE (ID_TABLE, ROW, COL, VAL) VALUES ((SELECT MAX(ID) FROM BLOCK_TABLE), :ROW, :COL, :VAL);';
					$return[$index++]['params'] = [
						'ROW' => $subval['ROW'],
						'COL' => $subval['COL'],
						'VAL' => $subval['VAL']
					];
				}
				break;
			case 'B2': //multitable
				$return[$index]['sql'] = 'INSERT INTO BLOCK_MULTITABLE (ID_PAGE_TEMPLATE, TITLE, SUBTITLE, DESCR) VALUES ((SELECT MAX(ID) FROM PAGE_TEMPLATES), :TITLE, :SUBTITLE, :DESCR);';
				$return[$index++]['params'] = [
					'TITLE' => $val['TITLE'],
					'SUBTITLE' => $val['SUBTITLE'],
					'DESCR' => $val['DESCR']
				];
				$TABLE_DATA = [];
				foreach($val as $key => $value){
					if(preg_match('#^ID_TABLE[0-9]{0,}$#', $key)){
						$TABLE_DATA[explode('ID_TABLE', $key)[1]]['ID'] = $value;
					}elseif(preg_match('#^TITLE_TABLE[0-9]{0,}$#', $key)){
						$TABLE_DATA[explode('TITLE_TABLE', $key)[1]]['TITLE'] = $value;
					}elseif(preg_match('#^CELL_TABLE[0-9]{0,}_[0-9]{1,}_[0-9]{1,}$#', $key)){
						$c = explode('CELL_TABLE', $key)[1];
						list($cell_index, $cell_row, $cell_col) = explode('_', $c);
						$CELL['VAL'] = $value;
						$CELL['ROW'] = $cell_row;
						$CELL['COL'] = $cell_col;
						if(isset($TABLE_DATA[$cell_index]['CELLS'])){
							array_push($TABLE_DATA[$cell_index]['CELLS'], $CELL);
						}else{
							$TABLE_DATA[$cell_index]['CELLS'][0] = $CELL;
						}
					}
				}

				foreach($TABLE_DATA as $subkey => $subval){
					$return[$index]['sql'] = 'INSERT INTO BLOCK_MULTITABLE_CONTENT (ID_MULTITABLE, SUBTITLE, SERIAL_NUMBER) VALUES ((SELECT MAX(ID) FROM BLOCK_MULTITABLE), :ST, :SN);';
					$return[$index++]['params'] = [
						'ST' => $subval['TITLE'],
						'SN' => strval($subkey)
					];
					foreach($subval['CELLS'] as $cellkey => $cellval){
						$return[$index]['sql'] = 'INSERT INTO DATA_MULTITABLE (ID_MULTITABLE_CONTENT, ROW, COL, VAL) VALUES ((SELECT MAX(ID) FROM BLOCK_MULTITABLE_CONTENT), :ROW, :COL, :VAL);';
						$return[$index++]['params'] = [
							'ROW' => $cellval['ROW'],
							'COL' => $cellval['COL'],
							'VAL' => $cellval['VAL']
						];
					}
				}
				break;
			case 'B3': //text
				$return[$index]['sql'] = 'INSERT INTO BLOCK_TEXT (`ID_PAGE_TEMPLATE`, `TITLE`, `TEXT`) VALUES ((SELECT MAX(ID) FROM PAGE_TEMPLATES), :TITLE, :TEXT);';
				$return[$index++]['params'] = [
					'TITLE' => $val['TITLE'],
					'TEXT' => $val['TEXT']
				];
				break;
			case 'B4': //image list
				/* LOAD IMAGES */
				$return[$index]['sql'] = 'INSERT INTO BLOCK_IMAGES (ID_PAGE_TEMPLATE, TITLE, DESCR) VALUES ((SELECT MAX(ID) FROM PAGE_TEMPLATES), :TITLE, :DESCR);';
				$return[$index++]['params'] = [
					'TITLE' => $val['TITLE'],
					'DESCR' => $val['DESCR']
				];

				$NUMERIC_PART_IMAGE = $SN;
				$IMAGE_DATA = [];
				foreach($val as $key => $value){
					if(preg_match('#^ID_IMAGE_CONTENT[0-9]{1,}$#', $key)){
						$IMAGE_DATA[explode('ID_IMAGE_CONTENT', $key)[1]]['ID'] = $value;
					}elseif(preg_match('#^SUBTITLE[0-9]{1,}$#', $key)){
						$IMAGE_DATA[explode('SUBTITLE', $key)[1]]['SUBTITLE'] = $value;
					}elseif(preg_match('#^IMAGE_SIGN[0-9]{1,}$#', $key)){
						$IMAGE_DATA[explode('IMAGE_SIGN', $key)[1]]['IMAGE_SIGN'] = $value;
					}elseif(preg_match('#^SERIAL_NUMBER[0-9]{1,}$#', $key)){
						$IMAGE_DATA[explode('SERIAL_NUMBER', $key)[1]]['SERIAL_NUMBER'] = $value;
					}
				}
				for($i = 0; $i < count($IMAGE_DATA); $i++){

					$local_index = 'IMAGE_LINK'.$i.'_'.$NUMERIC_PART_IMAGE;

					$ID_IMAGE_CONTENT = $IMAGE_DATA[$i]['ID'];
					
					$q = 'SELECT IMAGE_LINK FROM BLOCK_IMAGE_CONTENT WHERE ID = :ID';
					$params = [
						'ID' => $ID_IMAGE_CONTENT
					];
					$old = $this->db->column($q, $params);

					if(isset($files[$local_index]) && $files[$local_index] != '' && $files[$local_index]['size'] > 0){
						$img = $files[$local_index];
						if($old != '' && $old != null){
							$new_img = $this->replaceImage(self::IMAGE_TEMPLATE_BLOCK_IMAGES, $old, $img);
						}else{
							$new_img = $this->loadImage(self::IMAGE_TEMPLATE_BLOCK_IMAGES, $img);
						}
					}else{
						$new_img = $old;
					}
					$IMAGE_DATA[$i]['IMAGE'] = $new_img;
				}
				foreach($IMAGE_DATA as $key => $val){
					$return[$index]['sql'] = 'INSERT INTO BLOCK_IMAGE_CONTENT (ID_IMAGE, IMAGE_LINK, SUBTITLE, IMAGE_SIGN, SERIAL_NUMBER) VALUES ((SELECT MAX(ID) FROM BLOCK_IMAGES), :IMAGE, :SUBTITLE, :SIGN, :SN);';
					$return[$index++]['params'] = [
						'IMAGE' => $val['IMAGE'],
						'SUBTITLE' => $val['SUBTITLE'],
						'SIGN' => $val['IMAGE_SIGN'],
						'SN' => $val['SERIAL_NUMBER']
					];
				}
				break;
			case 'B5': //links
				//$return[0]['sql'] = 'UPDATE  SET () WHERE ID = :ID;';
				//$return[0]['params'] = ['ID' => $val['ID']];
				break;
			case 'EXC1': //excursion 1
				/*
				
				LOAD IMAGES

				 */
				foreach($val as $subkey => $subval){

					$return[$index]['sql'] = 'INSERT INTO PAGE_FULL_CONTENT (ID_FULL_PAGE, VAL, VAR) VALUES ((SELECT MAX(ID) FROM PAGE_FULL), :VAL, :VAR);';
					$return[$index++]['params'] = [
						'VAR' => $subkey,
						'VAL' => $subval
					];
				}
				break;
		}
		return $return;
	}

	private function casePathCatalog($ID, $ID_GROUP = 0){
		if($ID_GROUP == 0){
			$q = 'SELECT ID_GROUP FROM PAGES WHERE ID = :ID';
			$params = [
				'ID' => $ID
			];
			$ID_GROUP = $this->db->row($q, $params)[0]['ID_GROUP'];
		}	
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
		#debug([$dir, $oldFile, $newfile]);
		if($newfile['size'] > 0){
			$oldName = $oldFile;
			$oldFile = $_SERVER['DOCUMENT_ROOT'].self::IMAGE_DIR.$dir.$oldFile.'.'.self::IMAGE_FILE_FORMAT;
			$this->imgOptimize($newfile['tmp_name']);
			if(copy($newfile['tmp_name'], $oldFile)){
	            return $oldName;
	        }
	   	}
	   	return '';
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