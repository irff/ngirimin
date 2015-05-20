<?php

$app->group('/pengiriman', function () use ($app) {

  $app->get('/', function () use ($app) {

    $daftarPengiriman = [];
    for ($i = 1; $i <= 10; $i++) {
      $pengiriman = new stdClass;
      $pengiriman->id = $i;
      $pengiriman->id_user = 1;
      $pengiriman->id_barang = rand(1, 9);
      $pengiriman->tanggal_kirim = date('Y-m-d');
      $pengiriman->nama = 'Budi'.$i;
      $pengiriman->alamat = 'Alamat';
      $pengiriman->kodepos = 'kodepos';
      $pengiriman->telepon = 'telepon';
      $pengiriman->email = 'email';
      $pengiriman->status = rand(0, 5);
      $daftarPengiriman[] = $pengiriman;
    }
    echo json_encode($daftarPengiriman);
    exit;

  });

  $app->get('/:id', function ($id) use ($app) {

    $pengiriman = new stdClass;
    $pengiriman->id = $id;
    $pengiriman->id_user = 1;
    $pengiriman->id_barang = rand(1, 9);
    $pengiriman->tanggal_kirim = date('Y-m-d');
    $pengiriman->nama = 'Budi'.$id;
    $pengiriman->alamat = 'Alamat';
    $pengiriman->kodepos = 'kodepos';
    $pengiriman->telepon = 'telepon';
    $pengiriman->email = 'email';
    $pengiriman->status = rand(0, 5);

    echo json_encode($pengiriman);
    exit;

  });

  $app->post('/add', function () use ($app) {
    $post = $app->request->post();

    // TODO: insert into database
    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

  $app->post('/:id/edit', function ($id) use ($app) {
    $post = $app->request->post();

    // TODO: update entry with id
    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

  $app->get('/:id/print', function ($id) use ($app) {

    // TODO: do stuff with dompdf here
    echo 'Print';

  });

});
