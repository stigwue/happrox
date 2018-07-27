<?php

require_once(__DIR__ . '/happrox.php');

//set time zone, no where like home
date_default_timezone_set('Africa/Lagos');

$obj = new Happrox();

//Happrox::setDecimalPlace($obj, 2);

var_dump(Happrox::number($obj, 10));
var_dump(Happrox::number($obj, 1010));
var_dump(Happrox::number($obj, 123456));
var_dump(Happrox::number($obj, 1010101));
var_dump(Happrox::number($obj, 12345678));
var_dump(Happrox::number($obj, 101010101010));



Happrox::setDurationBase($obj, time(NULL));

var_dump(Happrox::duration($obj, 36));
var_dump(Happrox::duration($obj, 3599));
var_dump(Happrox::duration($obj, 518400));
var_dump(Happrox::duration($obj, 604799));
var_dump(Happrox::duration($obj, 123456));

?>
