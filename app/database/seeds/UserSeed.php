<?php

class UserSeed {

  function run() {
    $user = new User;
    $user->save();
  }

}
