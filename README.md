# Happrox

Human approximation for numbers and durations. Think _98,760_ to _98.7k_, _3,599s_ to _58m 59s_ as in Stackoverflow timestamps and Twitter stat counts.

## Installation

Installation is via composer.

```
composer require stigwue/happrox
```

## Usage

There are only a few configurations needed: the number of decimal places for numbers, the datetime formatting and the maximum duration before direct datetime formats are used. In most cases, the default will do.

Also, to approximate numbers, just supply the _value_. For durations, the number of _seconds_ will do. One can write custom functions to convert other datetime formats to seconds.

Note that, when supplied durations become greater than the set maximum approximation duration, the supplied duration will be treated as a UNIX timestamp and formatted accordingly. If this is not the case for you, _Happrox::setDurationBase()_ should be set with an appropriate duration to correct the datetime (the default value is 0).

```php
require_once(__DIR__ . '/happrox.php');

//set time zone, no where like home
date_default_timezone_set('Africa/Lagos');

$obj = new Happrox();

echo "Numbers\n";

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

Happrox::setDurationBase($obj, time(NULL));

echo "Durations\n";

$happrox = Happrox::duration($obj, 36);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::duration($obj, 3599);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::duration($obj, 518400);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::duration($obj, 604799);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
$happrox = Happrox::duration($obj, 123456);
echo $happrox['value'] . ' -> ' . $happrox['happrox'] . "\n";
```

```
Numbers
10 -> 10
1010 -> 1.0k
123456 -> 123.5k
1010101 -> 1.0M
12345678 -> 12.3M
101010101010 -> 101.0B
Durations
36 -> 36s
3599 -> 59m 59s
518400 -> 6d
604799 -> Jul 22, 2018 7:32am
123456 -> 1d 10hr
```

## To Do

* Handle Indian style number approximations (lakh)?

* Introduce switches to format durations for local weekdays (marketdays). Need an array of ordered days and a specific day's assignment (1 Jan 1970 should do).
