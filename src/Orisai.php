<?php declare(strict_types = 1);

use Orisai\Installer\Schema\ModuleSchema;

$schema = new ModuleSchema();

$schema->addConfigFile(__DIR__ . '/wiring.neon');
$schema->addConfigFile(__DIR__ . '/../config/_common.neon');

return $schema;
