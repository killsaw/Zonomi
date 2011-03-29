<?php

require_once __DIR__.'/Zonomi/Zonomi.php';
require_once __DIR__.'/Zonomi/Console.php';
require_once __DIR__.'/config.php';

$argv = $_SERVER['argv'];
$argc = $_SERVER['argc'];

if ($argc < 3) {
	fprintf(STDERR, "Usage: %s [command] [params]\n", 
		basename($argv[0]));
	exit(1);
}

$app_name = array_shift($argv);
$command = array_shift($argv);

Zonomi\Console::run($command, $argv);
