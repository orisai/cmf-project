<?php declare(strict_types = 1);

namespace App;

use OriNette\DI\Boot\BaseConfigurator;
use OriNette\DI\Boot\CookieGetter;
use OriNette\DI\Boot\Environment;
use OriNette\DI\Boot\ManualConfigurator;
use Symfony\Component\Dotenv\Dotenv;
use function dirname;
use function file_exists;

final class Bootstrap
{

	public static function boot(): BaseConfigurator
	{
		if (file_exists(__DIR__ . '/../.env')) {
			$dotenv = new Dotenv();
			$dotenv->load(__DIR__ . '/../.env');
		}

		$configurator = new ManualConfigurator(dirname(__DIR__));

		$configurator->addStaticParameters(Environment::loadEnvParameters());

		$configurator->setDebugMode(
			Environment::isEnvDebugMode()
			|| Environment::isLocalhost()
			|| Environment::hasCookie(CookieGetter::fromEnv()),
		);
		$configurator->enableDebugger();

		$configurator->addConfig(__DIR__ . '/../vendor/orisai/cmf-core/src/wiring.neon');
		$configurator->addConfig(__DIR__ . '/../vendor/orisai/cmf-ui/src/wiring.neon');

		$configurator->addConfig(__DIR__ . '/wiring.neon');
		$configurator->addConfig(__DIR__ . '/../config/common.neon');
		$configurator->addConfig(__DIR__ . '/../config/local.neon');

		return $configurator;
	}

}
