<?php

$app->group('/user', function () use ($app) {

  $app->get('/', function () use ($app) {

    $u = User::find(1);

    $user = new stdClass;
    $user->id = $u->id;
    $user->email = $u->email;
    $user->nama = $u->nama;
    $user->alamat = $u->alamat;
    $user->kodepos = $u->kodepos;
    $user->telepon = $u->telepon;

    echo json_encode($user);
    exit;

  });

  $app->post('/edit', function () use ($app) {
    $raw_data = $app->request->getBody();
    $post = json_decode($raw_data, true);

    $user = User::find(1);
    $user->nama = $post['nama'];
    $user->alamat = $post['alamat'];
    $user->kodepos = $post['kodepos'];
    $user->telepon = $post['telepon'];
    $user->save();

    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

  $app->post('/add', function () use ($app) {
    $raw_data = $app->request->getBody();
    $post = json_decode($raw_data, true);

    $user = new User();
    $user->nama = $post['nama'];
    $user->alamat = $post['alamat'];
    $user->kodepos = $post['kodepos'];
    $user->telepon = $post['telepon'];
    $user->save();

    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

});
