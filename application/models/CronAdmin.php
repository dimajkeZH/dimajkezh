<?php

namespace application\models;

use application\models\Admin;

class CronAdmin extends Admin {

	const CRON_DIR = '/application/views/layouts/cache/';

	const MENU_PATH = '';
	const MAIN_SLICK_PATH = '';
	const BUS_SLICK_PATH = '';
	const MINIVAN_SLICK_PATH = '';

	const CATALOG_SLICKS = '/assets/img/slick';

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
		$SRV_DOCKS = $_SERVER['DOCUMENT_ROOT'];

		self::slickFull($SRV_DOCKS.self::CRON_DIR.self::MAIN_SLICK_PATH);
		self::slickBuses($SRV_DOCKS.self::CRON_DIR.self::BUS_SLICK_PATH);
		self::slickMinivans($SRV_DOCKS.self::CRON_DIR.self::MINIVAN_SLICK_PATH);
	}

	private static function slickFull($file){
		$q = 'SELECT IMAGE FROM PAGES WHERE ID_LOCATION IN (:LOC1, :LOC2)';
		$params = [
			'LOC1' => 5,
			'LOC2' => 7
		];
		//$result = self::db->row($q, $params);
		//debug();

	}

	private static function slickBuses($file){
		$q = 'SELECT IMAGE, IMAGE_SIGN FROM PAGES WHERE ID_LOCATION IN (:LOC1) ORDER BY LOC_NUMBER';
		$params = [
			'LOC1' => 5
		];
		//$result = self::db->row($q, $params);


	}

	private static function slickMinivans($file){
		$q = 'SELECT IMAGE FROM PAGES WHERE ID_LOCATION IN (:LOC2)';
		$params = [
			'LOC2' => 7
		];
		//$result = self::db->row($q, $params);


	}

}