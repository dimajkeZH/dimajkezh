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

		'services/page/[0-9]{1}' => [
			'controller' => 'services',
			'action' => 'page',
		],

	'buses' => [
		'controller' => 'buses',
		'action' => 'index',
	],

		'buses/page' => [
			'controller' => 'buses',
			'action' => 'index',
		],

	'minivans' => [
		'controller' => 'minivans',
		'action' => 'index',
	],

		'minivans/page' => [
			'controller' => 'minivans',
			'action' => 'index',
		],

	'excursions' => [
		'controller' => 'excursions',
		'action' => 'index',
	],

		'excursions/page' => [
			'controller' => 'excursions',
			'action' => 'index',
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