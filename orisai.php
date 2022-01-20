<?php declare(strict_types=1);

use Orisai\Installer\Schema\ModuleSchema;

$schema = new ModuleSchema();

$schema->addConfigFile(__DIR__ . '/src/wiring.neon');
$schema->addConfigFile(__DIR__ . '/config/common.neon');
$schema->addConfigFile(__DIR__ . '/config/local.neon');

return $schema;
