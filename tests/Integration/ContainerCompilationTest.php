<?php declare(strict_types = 1);

namespace Tests\App\Integration;

use App\Bootstrap;
use PHPUnit\Framework\TestCase;
use function file_exists;
use function file_put_contents;

final class ContainerCompilationTest extends TestCase
{

	public function test(): void
	{
		$localConfig = __DIR__ . '/../../config/local.neon';
		if (!file_exists($localConfig)) {
			file_put_contents($localConfig, <<<'NEON'
dbal:
    connections:
        default:
            driver: pgsql
            host: localhost
            port: 5432
            username: user
            password: pass
            database: ori
NEON);
		}

		Bootstrap::boot()
			->createContainer();

		self::assertTrue(true);
	}

}
