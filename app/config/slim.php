<?php

$config['slim'] = [];

$config['slim']['global'] = [
	'mode' => SLIM_MODE,
	'templates.path' => APP_PATH . 'views',
	'view' => new \Slim\Views\Twig()
];

$config['slim']['production'] = [
	'debug' => false
];

$config['slim']['development'] = [
	'debug' => true,
	'log.level' => \Slim\Log::ERROR,
	'log.enabled' => true
];

$config['twig']['extensions'] = [ new \Slim\Views\TwigExtension() ];
