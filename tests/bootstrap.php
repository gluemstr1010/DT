<?php

declare(strict_types=1);

use Tester\Environment;

// Check composer && tester
if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer update --dev`';
	exit(1);
}

date_default_timezone_set('Europe/Prague');

Environment::setup();
