<?php namespace Powerhouse\Core;

use Illuminate\Support\ServiceProvider;

class PowerhouseServiceProvider extends ServiceProvider {

	public function register(){

		\App::bind('chart', function()
		{
			return new \Powerhouse\Core\Chart;
		});

		\Event::listen('user.created', function($user)
		{
			\Flash::push('success', 'Observer fired to send welcome email!');
			// logic to send email here...
		});

		App()->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('PWR', 'Powerhouse\Core\PWR');
		});
	}
	
}

?> 