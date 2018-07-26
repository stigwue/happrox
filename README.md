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
$ha_instance = new Happrox();

//1 decimal place (d.p) is the default, you can set to 2 for approximations like 99.99k
Happrox::setDecimalPlace($ha_instance, 1);

//datetime format strings are PHP's and the default is Jul 26, 2018 9:18 am
Happrox::setDatetimeFormat($ha_instance, 'M j, Y g:i a');

//maximum approximated datetime is 6 days (518,400s), anything more will not be approximated
Happrox::setDatetimeMaximum($ha_instance, 518400);

//base for direct datetime formatting
Happrox::setDurationBase($ha_instance, 0);

$value = 12345;

$happrox_number = Happrox::number($ha_instance, $value);

$happrox_duration = Happrox::duration($ha_instance, $value);

/*
numbers

1 - 999 : as is
1,000 - 999,999: 1k - 999.9k
1,000,000 - 999,999,999: 1M - 999.9M
1,000,000,000 - 999,999,999,999 : 1B - 999.9B
*/


/*
duration

1s - 59s : as is
60s - 3,599s : 1m - 58m 59s
3,600s - 86,399s : 1hr - 23hrs 58m 59s
86400s - 604,799ds : 1d - 6d----

wks
mnths
yr

> maximum
format date and time
*/

```

## To Do

* Something akin to decimal places for duration.

* Handle Indian style number approximations (lakh)?

* Introduce switches to format durations for local weekdays (marketdays). Need an array of ordered days and a specific day's assignment (1 Jan 1970 should do).
