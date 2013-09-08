<?php namespace Heron\Persona;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use browserid\Verifier;

class PersonaServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
    $this->package('heron/persona');
    include __DIR__.'/../../routes.php';
    include __DIR__.'/../../listeners.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
  {
    $this->app['persona'] = $this->app->share(function($app) {
      $baseUrl = URL::to('/');
      $verifier = new Verifier($baseUrl);
      return new Persona($verifier);
    });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('persona');
	}

}
