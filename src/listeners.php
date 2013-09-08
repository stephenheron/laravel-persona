<?php

Event::listen('persona.login_attempt', function($assertion){
  $user = User::where('email', $assertion->email)->first();
  if($user) {
    Auth::login($user);
  } else {
    $user = new User;
    $user->email = $assertion->email;

    if(method_exists($user, 'forceSave')){
      $user->forceSave();
    } else {
      $user->save();
    }

    Auth::login($user);
  }
});
