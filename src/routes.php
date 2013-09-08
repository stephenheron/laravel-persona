<?php

Route::group(array(
  'prefix' => Config::get('persona::persona.route_prefix'),
  'before' => 'csrf'), 
  function()
  {
    Route::post('login', array(
      'as'    => 'persona_login',
      'uses'  => 'Heron\Persona\Controllers\AuthController@login'
    ));
  }
);
