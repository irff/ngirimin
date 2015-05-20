<?php

/**
 * Public routes for main website.
 */

$app->get('/', function () use ($app) {
  $data = ['title' => 'Hello, world!'];
  $app->render('home.php', $data);
});
