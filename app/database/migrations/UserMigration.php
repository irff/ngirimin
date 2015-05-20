<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class UserMigration {
  function run()
  {
    Capsule::schema()->dropIfExists('users');
    Capsule::schema()->create('users', function($table) {
        $table->increments('id');

        $table->string('email');
        $table->string('password');
        $table->string('nama');
        $table->string('alamat');
        $table->string('kodepos');
        $table->string('telepon');

        $table->timestamps();
    });
  }
}
