<?php

/*
 * Start php session.
 */
session_cache_limiter(false);
session_start();

/*
 * Directory constants.
 */
define('ROOT_PATH'  , __DIR__.'/../');
define('VENDOR_PATH', __DIR__.'/../vendor/');
define('APP_PATH'   , __DIR__.'/../app/');\
define('PUBLIC_PATH', __DIR__.'/../public/');

/*
 * Slim mode.
 * IMPORTANT: change this to production prior to deployment
 */
define('SLIM_MODE', 'development');

/*
 * Base URL of your website.
 * Change this to match the domain of your server.
 */
define('BASE_URL', 'http://localhost/proyekan/ngirimin/public');

/*
 * SLIM INSTANTIATION
 */

// Require vendors (Slim, Eloquent, etc.).
require_once VENDOR_PATH . 'autoload.php';

// Include configuration files
foreach (glob(APP_PATH . 'config/*.php') as $configs) {
  require_once $configs;
}

// Instantiate app
$app = new Slim\Slim($config['slim']['global']);

$app->configureMode('production', function () use ($app, $config) {
  $app->config($config['slim']['production']);
});

$app->configureMode('development', function () use ($app, $config) {
  $app->config($config['slim']['development']);
});

// Enabling Twig extensions
$view = $app->view();
$view->parserExtensions = $config['twig']['extensions'];

// Include middlewares
require_once APP_PATH . 'middlewares.php';

// Include models
foreach (glob(APP_PATH . 'models/*.php') as $model) {
  require_once $model;
}

// Include routes
foreach (glob(APP_PATH . 'routes/*.php') as $route) {
  require_once $route;
}