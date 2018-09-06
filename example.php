<?php

require_once(__DIR__ . '/happrox.php');

//set time zone, no where like home
date_default_timezone_set('Africa/Lagos');

$obj = new Happrox();

echo "Numbers\n";

$happrox = Happrox::number($obj, 0);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::number($obj, 10);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::number($obj, 1010);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::number($obj, 123456);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::number($obj, 1010101);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::number($obj, 12345678);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::number($obj, 101010101010);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
var_dump($happrox);

$happrox = Happrox::number($obj, 101010101010101);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
var_dump($happrox);

Happrox::setDurationBase($obj, time(NULL));

echo "Durations\n";

$happrox = Happrox::duration($obj, 0);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::duration($obj, 36);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . (($happrox['ago'] == true) ? ' ago' : '') . "\n";
$happrox = Happrox::duration($obj, 3599);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::duration($obj, 518400);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
var_dump($happrox);
$happrox = Happrox::duration($obj, 604799);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
var_dump($happrox);

$happrox = Happrox::duration($obj, time(NULL) + PHP_INT_MAX + 1);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
var_dump($happrox);


?>
