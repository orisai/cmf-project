<?php declare(strict_types = 1);

namespace App;

use OriCMF\Debug\TracyStyle;
use OriNette\DI\Boot\AutomaticConfigurator;
use OriNette\DI\Boot\Environment;
use OriNette\DI\Boot\FileDebugCookieStorage;
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

		$cookieStorage = new FileDebugCookieStorage(__DIR__ . '/../config/debug-cookie-values.json');
		$configurator->addServices([
			'orisai.di.cookie.storage' => $cookieStorage,
		]);

		TracyStyle::enable();
		$configurator->setDebugMode(
			Environment::isEnvDebug()
			|| Environment::isCookieDebug($cookieStorage),
		);
		$configurator->enableDebugger();

		return $configurator;
	}

}
