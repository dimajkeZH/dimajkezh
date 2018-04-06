<?php

return [

	'' => [
		'controller' => 'main',
		'action' => 'main',
	],

	'services' => [
		'controller' => 'main',
		'action' => 'services',
	],

		'services/page/[0-9]{1,}' => [
			'controller' => 'templates',
			'action' => 'services',
		],

	'buses' => [
		'controller' => 'main',
		'action' => 'buses',
	],

		'buses/page/[0-9]{1,}' => [
			'controller' => 'templates',
			'action' => 'buses',
		],

	'minivans' => [
		'controller' => 'main',
		'action' => 'minivans',
	],

		'minivans/page/[0-9]{1,}' => [
			'controller' => 'templates',
			'action' => 'minivans',
		],

	'excursions' => [
		'controller' => 'main',
		'action' => 'excursions',
	],

		'excursions/page/[0-9]{1,}' => [
			'controller' => 'templates',
			'action' => 'excursions',
		],

	'contacts' => [
		'controller' => 'main',
		'action' => 'contacts',
	],

	'news' => [
		'controller' => 'main',
		'action' => 'news',
	],
	


	'admin' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	
];