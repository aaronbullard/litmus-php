<?php namespace LitmusPHP;

use Illuminate\Support\ServiceProvider;

class LitmusServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('Litmus', 'LitmusPHP\Classes\LitmusFactory');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
