<?php

namespace application\models;

use application\models\Admin;

class Admin extends Admin {

	static function updMenu(){
		/*
		$q = 'SELECT NEW.TITLE, NUMBER, LL.CONTROLLER, LL.ACTION FROM (SELECT ID_LOCATION, TITLE, LOC_NUMBER as NUMBER FROM PAGES UNION ALL SELECT ID_LOCATION, TITLE, "0" as NUMBER FROM INDEX_PAGES WHERE ID_LOCATION > 1) as NEW INNER JOIN LIB_LOCATIONS as LL ON NEW.ID_LOCATION = LL.ID ORDER BY ID_LOCATION, NUMBER';
		$MENU = $this->db->row($q);
		for($i = 0; $i < count($MENU); $i++){
			$MENUARR[$MENU[$i]['CONTROLLER']][$MENU[$i]['ACTION']][$MENU[$i]['NUMBER']] = $MENU[$i]['TITLE'];
		}
		*/
	}

	static function updSlicks(){
		self::slickFull();
		self::slickBuses();
		self::slickMinivans();
	}

	private static function slickFull(){

	}

	private static function slickBuses(){

	}

	private static function slickMinivans(){

	}

}