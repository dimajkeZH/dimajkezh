<?php

return [

	'' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'services' => [
		'controller' => 'services',
		'action' => 'index',
	],

		'services/page/[0-9]{1,}' => [
			'controller' => 'services',
			'action' => 'page',
		],

	'buses' => [
		'controller' => 'buses',
		'action' => 'index',
	],

		'buses/page/[0-9]{1,}' => [
			'controller' => 'buses',
			'action' => 'page',
		],

	'minivans' => [
		'controller' => 'minivans',
		'action' => 'index',
	],

		'minivans/page/[0-9]{1,}' => [
			'controller' => 'minivans',
			'action' => 'page',
		],

	'excursions' => [
		'controller' => 'excursions',
		'action' => 'index',
	],

		'excursions/page/[0-9]{1,}' => [
			'controller' => 'excursions',
			'action' => 'page',
		],

	'contacts' => [
		'controller' => 'contacts',
		'action' => 'index',
	],
	


	'admin' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	
];