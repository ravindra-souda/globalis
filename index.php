<?php

require 'vendor/autoload.php';

// Memory and time execution limits
ini_set('memory_limit','2000K');
set_time_limit(0.5);

$continent = new Continent();
echo ($continent->runSimulation() === false ? 'Largeur ou altitudes incorrectes' : $continent->getSafeSpots()).PHP_EOL;

// Extreme example, should trigger a PHP Fatal Error 'Allowed memory size of 2097152 bytes exhausted'
/*
$randomHeights = range(1, 100000);
shuffle($randomHeights);
$continent = new Continent(100000, implode(' ',$randomHeights));
$continent->runSimulation();
*/

