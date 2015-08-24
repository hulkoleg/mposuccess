<?php namespace Notprometey\Mposuccess;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MposuccessServiceProvider extends ServiceProvider {

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

		$this->loadViewsFrom(__DIR__.'/../../views/', 'mposuccess');

		$this->publishes([
			__DIR__.'/../../views/auth' => base_path('resources/auth'),
		], 'auth');

		$this->publishes([
			__DIR__.'/../../config/mposuccess.php' => config_path('mposuccess.php'),
		], 'config');

		$this->publishes([
			__DIR__ . '/../../migrations/' => base_path('/database/migrations')
		], 'migrations');

		$this->publishes([
			__DIR__ . '/../../seeds/' => base_path('/database/seeds')
		], 'seeds');

		$this->publishes([
			__DIR__.'/../../../public/' => public_path(),
		], 'public');

		include __DIR__.'/../../routes.php';

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->mergeConfigFrom(
			__DIR__.'/../../config/mposuccess.php', 'mposuccess'
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
