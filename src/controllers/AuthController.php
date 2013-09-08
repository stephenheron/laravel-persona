<?php
namespace Heron\Persona\Controllers;

use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Heron\Persona\Facades\Persona;
use Exception;

class AuthController extends Controller 
{

  public function login()
  {
    $assertion = Input::get('assertion');
    if(!$assertion) {
      throw new Exception('A assertion must be given for the Persona login to complete');
    }

    $response = Persona::login($assertion);

    if($response->status == 'failure') {
       return Response::json($response, 500);
    }

    return Response::json($response);
  }
  
  public function logout()
  {
    Persona::logout();
  }

}
