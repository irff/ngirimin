<?php

class BarangSeed {

  function run() {

    for ($i = 1; $i <= 10; $i++) {
      $barang = new Barang;
      $barang->id_user = 1;
      $barang->nama = 'Barang'.$i;
      $barang->stok = rand(5, 7);
      $barang->save();
    }

  }

}
