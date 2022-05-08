<?php declare(strict_types = 1);

namespace App;

use OriNette\DI\Boot\Environment;
use Orisai\Installer\AutomaticConfigurator;
use Orisai\Installer\Loader\DefaultLoader;
use function dirname;

final class Bootstrap
{

	public static function boot(): AutomaticConfigurator
	{
		$configurator = new AutomaticConfigurator(
			dirname(__DIR__),
			new DefaultLoader(),
		);

		$configurator->setDebugMode(
			Environment::isEnvDebugMode()
			|| Environment::isLocalhost()
			|| Environment::hasCookie(require __DIR__ . '/../config/_debug-cookies.php'),
		);
		$configurator->enableDebugger();

		return $configurator;
	}

}
