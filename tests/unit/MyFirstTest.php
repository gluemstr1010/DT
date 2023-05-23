<?php

declare(strict_types=1);

namespace Tests;

use DateTime;
use DateTimeZone;
use gluemstr1010\DT;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
class MyFirstTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();

	}

	public function testInit(): void
	{
		Assert::type(DT::class, DT::create('now'));
	}

	public function testDateTimeZoneSetTimezone(): void
	{
		$dt = DT::create('now')->setTimezone( new DateTimeZone('America/New_York') );

		Assert::same('America/New_York', $dt->getTimezone()->getName());
	}

	/**
	 * @dataProvider providerEqualsData
	 */
	public function testAreEquals(bool $state, DT $a, DT $b): void
	{
		Assert::same($state, $a->areEquals($b));
		Assert::same($state, $b->areEquals($a)); //immutable
	}

	public function providerEqualsData(): array
	{
		return [
			[
				true,
				DT::create('2020-07-20 15:00:00'),
				DT::create('2020-07-20 15:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
			],
			[
				true,
				DT::create('2020-07-20 15:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
				DT::create('2020-07-20 15:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
			],
			[
				true,
				DT::create('2020-07-20 15:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
				DT::create('2020-07-20 14:00:00')->assignTimezone("Europe/London"),
			],
			[
				true,
				DT::create('2020-09-17 12:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
				DT::create('2020-09-17 06:00:00')->assignTimezone('America/New_York'),
			],
			[
				true,
				DT::create('2020-09-17 10:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
				DT::create('2020-09-17 11:00:00')->assignTimezone('Europe/Moscow'),
			],
			[
				true,
				DT::create('2020-09-17 13:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
				DT::create('2020-09-17 20:00:00')->assignTimezone('Asia/Tokyo'),
			],
			[
				true,
				DT::create('2020-09-17 07:00:00')->assignTimezone('America/New_York'),
				DT::create('2020-09-17 20:00:00')->assignTimezone('Asia/Tokyo'),
			],
			[
				false,
				DT::create('2020-07-20 14:00:00')->setTimezone(new DateTimeZone('Europe/Prague')),
				DT::create('2020-07-20 14:00:00')->assignTimezone('Europe/London'),
			],
			[
				false,
				DT::create('2020-07-20 14:00:00'),
				DT::create('2020-07-20 14:00:00')->assignTimezone('Europe/London'),
			],
		];
	}
}

$test = new MyFirstTest();
$test->run();
