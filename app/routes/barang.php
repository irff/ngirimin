<?php

$app->group('/barang', function () use ($app) {

  $app->get('/', function () use ($app) {

    $daftarBarang = [];
    $barangBarang = Barang::all();
    foreach ($barangBarang as $barang) {
      $b = new stdClass;
      $b->id = $barang->id;
      $b->id_user = $barang->id_user;
      $b->nama = $barang->nama;
      $b->stok = $barang->stok;
      $daftarBarang[] = $b;
    }
    echo json_encode($daftarBarang);
    exit;

  });

  $app->get('/:id', function ($id) use ($app) {

    $barang = Barang::find($id);

    $b = new stdClass;
    $b->id = $barang->id;
    $b->nama = $barang->nama;
    $b->stok = $barang->stok;

    echo json_encode($b);
    exit;

  });

  $app->post('/add', function () use ($app) {
    $raw_data = $app->request->getBody();
    $post = json_decode($raw_data, true);
    
    $barang = new Barang;
    $barang->id_user = $post['id_user'];
    $barang->nama = $post['nama'];
    $barang->stok = $post['stok'];
    $barang->save();

    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

  $app->post('/:id/edit', function ($id) use ($app) {
    $raw_data = $app->request->getBody();
    $post = json_decode($raw_data, true);

    $barang = Barang::find($id);
    $barang->nama = $post['nama'];
    $barang->stok = $post['stok'];
    $barang->save();

    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

});
