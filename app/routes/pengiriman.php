<?php

$app->group('/pengiriman', function () use ($app) {

  $app->get('/', function () use ($app) {

    $daftarPengiriman = [];
    $pengirimanPengiriman = Pengiriman::all();
    foreach ($pengirimanPengiriman as $pengiriman) {
      $p = new stdClass;
      $p->id = $pengiriman->id;
      $p->id_user = $pengiriman->id_user;
      $p->id_barang = $pengiriman->id_barang;
      $p->jumlah_barang = $pengiriman->jumlah_barang;
      $p->tanggal_kirim = $pengiriman->tanggal_kirim;
      $p->nama = $pengiriman->nama;
      $p->alamat = $pengiriman->alamat;
      $p->kodepos = $pengiriman->kodepos;
      $p->telepon = $pengiriman->telepon;
      $p->email = $pengiriman->email;
      $p->status = $pengiriman->status;
      $daftarPengiriman[] = $p;
    }
    echo json_encode($daftarPengiriman);
    exit;

  });

  $app->get('/:id', function ($id) use ($app) {

    $pengiriman = Pengiriman::find($id);

    $p = new stdClass;
    $p->id = $pengiriman->id;
    $p->id_user = $pengiriman->id_user;
    $p->id_barang = $pengiriman->id_barang;
    $p->jumlah_barang = $pengiriman->jumlah_barang;
    $p->tanggal_kirim = $pengiriman->tanggal_kirim;
    $p->nama = $pengiriman->nama;
    $p->alamat = $pengiriman->alamat;
    $p->kodepos = $pengiriman->kodepos;
    $p->telepon = $pengiriman->telepon;
    $p->email = $pengiriman->email;
    $p->status = $pengiriman->status;

    echo json_encode($p);
    exit;

  });

  $app->post('/add', function () use ($app) {
    $raw_data = $app->request->getBody();
    $post = json_decode($raw_data, true);

    $pengiriman = new Pengiriman;
    $pengiriman->id_user = $post['id_user'];
    $pengiriman->id_barang = $post['id_barang'];
    $pengiriman->jumlah_barang = $post['jumlah_barang'];
    $pengiriman->tanggal_kirim = $post['tanggal_kirim'];
    $pengiriman->nama = $post['nama'];
    $pengiriman->alamat = $post['alamat'];
    $pengiriman->kodepos = $post['kodepos'];
    $pengiriman->telepon = $post['telepon'];
    $pengiriman->email = $post['email'];
    $pengiriman->status = $post['status'];
    $pengiriman->save();

    $barang = Barang::find($pengiriman->id_barang);
    $barang->stok -= $pengiriman->jumlah_barang;
    $barang->save();

    $response = new stdClass;
    $response->ok = true;
    
    echo json_encode($response);
    exit;

  });

  $app->get('/:id/toggle/:code', function ($id, $code) use ($app) {

    $pengiriman = Pengiriman::find($id);
    $pengiriman->status = $code;
    $pengiriman->save();

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
