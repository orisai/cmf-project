<?php declare(strict_types = 1);

use App\Bootstrap;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

$configurator = Bootstrap::boot();
$configurator->setDebugMode(true);
$container = $configurator->createContainer();

return $container->getByType(Application::class);
