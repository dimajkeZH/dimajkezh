<?php

namespace application\models;

use application\models\User;

class MainUser extends User {

	const CONTENT = 'CONTENT';
	const VACANCIESLIST = 'VACANCIESLIST';
	const PAGELIST = 'PAGELIST';
	const USER_CHOICE = 'USER_CHOICE';
	const NEWS = 'NEWS';
	const LOCATION = 'LOCATION';


	public function getContent($route, $ADDITIONALS = ['CONTENT']){
		foreach($ADDITIONALS as $item){
			switch($item){
				case self::CONTENT:
					$result[self::CONTENT] = $this->content($route);
					break;
				case self::USER_CHOICE:
					$result[self::USER_CHOICE] = $this->choice_list();
					break;
				case self::VACANCIESLIST:
					$result[self::VACANCIESLIST] = $this->vacancieslist();
					break;
				case self::PAGELIST:
					$result[self::PAGELIST] = $this->pagelist($route);
					break;
				case self::NEWS:
					$result[self::NEWS] = $this->getNews($route);
					break;	
				case self::LOCATION:
					$result[self::LOCATION] = $this->getLocationID($route);
					break;
			}
		}
		return $result;
	}


	private function pagelist($route){
		$q = '
			SELECT NP.HTML_TITLE as TITLE, NP.DESCR, NP.URI as LINK, NP.IMAGE  
			FROM PAGES as NP
			WHERE NP.ID_PARENT = (SELECT P.ID FROM PAGES as P INNER JOIN LIB_LOCATIONS as LL ON LL.ID = P.ID_LOCATION WHERE (LL.CONTROLLER = :CONTROLLER) AND (LL.ACTION = :ACTION))';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		return $this->db->row($q, $params);
	}

	private function vacancieslist(){
		return $this->db->row('SELECT TITLE, IMAGE, DESCR FROM DATA_VACANCIES');
	}

	private function getLocationID($route){
		$q = 'SELECT ID FROM LIB_LOCATIONS
			WHERE (CONTROLLER = :CONTROLLER) AND (ACTION = :ACTION)';
		$params = [
			'CONTROLLER' => $route['controller'],
			'ACTION' => $route['action']
		];
		return $this->db->column($q, $params);
	}

}