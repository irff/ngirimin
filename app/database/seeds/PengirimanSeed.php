<?php

class PengirimanSeed {

  function run() {

    for ($i = 1; $i <= 10; $i++) {
      $pengiriman = new Pengiriman;
      $pengiriman->id_user = 1;
      $pengiriman->id_barang = 1;
      $pengiriman->jumlah_barang = rand(2, 4);
      $pengiriman->tanggal_kirim = date('Y-m-d');
      $pengiriman->nama = 'Andi'.$i;
      $pengiriman->alamat = 'Alamat';
      $pengiriman->kodepos = 'kodepos';
      $pengiriman->telepon = 'telepon';
      $pengiriman->email = 'email@email.com';
      $pengiriman->status = rand(0, 5);
      $pengiriman->save();
    }

  }
}