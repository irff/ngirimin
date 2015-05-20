<?php

$app->group('/user', function () use ($app) {

  $app->get('/', function () use ($app) {

    $user = new stdClass;
    $user->id = 1;
    $user->email = 'budi@email.com';
    $user->password = 'password';
    $user->nama = 'Budi';
    $user->alamat = 'Alamat';
    $user->kodepos = 'kodepos';
    $user->telepon = 'telepon';

    echo json_encode($user);
    exit;

  });

  $app->post('/edit', function () use ($app) {
    $post = $app->request->post();

    // TODO: update entry with id
    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

});
