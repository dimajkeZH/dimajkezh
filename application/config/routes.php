<?php

return [

	'' => [
		'controller' => 'main',
		'action' => 'main',
	],

	'ajax/order' => [
		'controller' => 'MainAjax',
		'action' => 'order',
	],

	'ajax/feedback' => [
		'controller' => 'MainAjax',
		'action' => 'feedback',
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

	'bus/[0-9]{1,}' => [
		'controller' => 'main',
		'action' => 'bus',
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

	'news/[0-9]{1,}' => [
		'controller' => 'main',
		'action' => 'news',
	],
	


	'admin' => [
		'controller' => 'admin',
		'action' => 'main',
	],

	'admin/auth' => [
		'controller' => 'admin',
		'action' => 'auth',
	],

	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],

	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],

	'admin/page/[1-9]{1,}' => [
		'controller' => 'admin',
		'action' => 'page',
	]
	
];