<?php 
namespace Heron\Persona;

use View;
use Config;
use Event;
use Exception;
use browserid\Verifier;

class Persona 
{

  private $verifier;

  public function __construct($verifier)
  {
    $this->verifier = $verifier;
  }

  public function javascript() 
  {
    $config = Config::get('persona::persona');
    return View::make('persona::javascript', $config['view_config']);
  }

  public function login($assertion) 
  {

    try { 
      $response = $this->verifier->verify($assertion);
    } catch (Exception $e) {
      $response = array('status' => 'failure', 'reason' => $e->getMessage());
      $response = (object)$response;
    }

    Event::fire('persona.login_attempt', array($response));

    return $response;

  }

  public function logout()
  {
    Event::fire('persona.login_attempt', array($response));
  }
}
