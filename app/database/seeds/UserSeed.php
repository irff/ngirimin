<?php

class UserSeed {

  function run() {

    $user = new User;
    $user->email = 'budi@email.com';
    $user->password = 'password';
    $user->nama = 'Budi';
    $user->alamat = 'Alamat';
    $user->kodepos = 'kodepos';
    $user->telepon = 'telepon';
    $user->save();

  }

}
