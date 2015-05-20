<?php

$app->group('/barang', function () use ($app) {

  $app->get('/', function () use ($app) {

    $daftarBarang = [];
    for ($i = 1; $i <= 10; $i++) {
      $barang = new stdClass;
      $barang->id = $i;
      $barang->nama = 'Barang'.$i;
      $barang->stok = rand(5, 7);
      $daftarBarang[] = $barang;
    }
    echo json_encode($daftarBarang);
    exit;

  });

  $app->get('/:id', function ($id) use ($app) {

    $barang = new stdClass;
    $barang->id = $id;
    $barang->nama = 'Barang'.$id;
    $barang->stok = rand(5, 7);

    echo json_encode($barang);
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

});
