<?php

use Nette\Utils\Strings;



require __DIR__ . '/shortcuts.php';
require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

$debugMode = FALSE;
$environmentFile = __DIR__ . '/local/environment';
if (file_exists($environmentFile)) {
	$environment = file_get_contents($environmentFile);
	$debugMode = $environment === 'production' ? FALSE : TRUE;
} else {
	$environment = 'production';
}
$environment = Strings::trim(Strings::lower($environment));

$debugSwitchFile = __DIR__ . '/local/debug';

if (file_exists($debugSwitchFile)) {
	$debugMode = Strings::trim(mb_strtolower(file_get_contents($debugSwitchFile))) === 'true' ? TRUE : FALSE;
}

// Enable Nette Debugger for error visualisation & logging
$configurator->setDebugMode($debugMode);
$configurator->enableDebugger(__DIR__ . '/../log');

// Specify folder for cache
$configurator->setTempDirectory(__DIR__ . '/../temp');

// Enable RobotLoader - this will load all classes automatically
$configurator->createRobotLoader()
		->addDirectory(__DIR__)
		->addDirectory(__DIR__ . '/../libs')
		->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(__DIR__ . '/config/config.neon');

$localConfig = __DIR__ . '/local/config.local.neon';

if (file_exists($localConfig)) {
	$configurator->addConfig($localConfig);
}
$container = $configurator->createContainer();

return $container;
