<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class PengirimanMigration {
  function run()
  {
    Capsule::schema()->dropIfExists('pengiriman');
    Capsule::schema()->create('pengiriman', function($table) {
        $table->increments('id');

        $table->integer('id_user');
        $table->integer('id_barang');

        $table->string('tanggal_kirim');
        
        $table->string('nama');
        $table->string('alamat');
        $table->string('kodepos');
        $table->string('telepon');
        $table->string('email');

        $table->integer('status');

        $table->timestamps();
    });
  }
}
