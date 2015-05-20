<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class BarangMigration {
  function run()
  {
    Capsule::schema()->dropIfExists('barang');
    Capsule::schema()->create('barang', function($table) {
        $table->increments('id');

        $table->integer('id_user');

        $table->string('nama');
        $table->integer('stok');

        $table->timestamps();
    });
  }
}
