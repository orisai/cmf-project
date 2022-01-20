<?php declare(strict_types = 1);

namespace App;

use OriNette\DI\Boot\CookieGetter;
use OriNette\DI\Boot\Environment;
use Orisai\Installer\AutomaticConfigurator;
use Orisai\Installer\Loader\DefaultLoader;
use Symfony\Component\Dotenv\Dotenv;
use function dirname;
use function file_exists;

final class Bootstrap
{

	public static function boot(): AutomaticConfigurator
	{
		if (file_exists($envFile = __DIR__ . '/../.env')) {
			$dotenv = new Dotenv();
			$dotenv->load($envFile);
		}

		$configurator = new AutomaticConfigurator(dirname(__DIR__), new DefaultLoader());
		$configurator->addStaticParameters(Environment::loadEnvParameters());

		$configurator->setDebugMode(
			Environment::isEnvDebugMode()
			|| Environment::isLocalhost()
			|| Environment::hasCookie(CookieGetter::fromEnv()),
		);
		$configurator->enableDebugger();

		return $configurator;
	}

}
