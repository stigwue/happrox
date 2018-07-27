<?php

/**
* Happrox main class.
*
*/
class Happrox
{
    /**
    * Decimal places (not really) for numbers.
    *
    */
    private $_decimalplace = 1;

    /**
    * Significant figures (not really) for duration.
    *
    */
    private $_significant_durations = 2;
    /**
    * Datetime format string, the PHP way.
    *
    */
    private $_datetime_format = 'M j, Y g:ia';
    /**
    * Maximum duration. Values above this will not be approximated.
    *
    */
    private $_datetime_max = 518400;
    /**
    * Datetime base for datetime format.
    *
    */
    private $_duration_base = 0;

    /**
    * Set decimal places of a Happrox instance.
    *
    *
    * @param instance Happrox instance
    * @param value Number of decimal places
    * @return Instance's decimal place
    * @throw
    */
    public static function setDecimalPlace($instance, $value)
    {
        $instance->_decimalplace = $value;
        return $instance->_decimalplace;
    }

    public static function setSignificantDurations($instance, $value)
    {
        $instance->_significant_durations = $value;
        return $instance->_significant_durations;
    }

    //format

    //max

    public static function setDurationBase($instance, $value)
    {
        $instance->_duration_base = $value;
        return $instance->_duration_base;
    }

    /**
    * Approximate a number.
    *
    *
    * @param instance Happrox instance
    * @param value Number to approximate
    * @return Happroximation
    * @throw
    */
    public static function number($instance, $value)
    {
        $positive = ($value >= 0);

        $value = abs($value);
        if ($value >= 0 AND $value < 1000)
        {
            return [
                'happrox' => number_format($value),
                'value' => $value
            ];
        }
        else
        {
            $mux = 1;
            $unit = '';
            if ($value >= 1000 AND $value < 1000000)
            {
                $mux = 1000;
                $unit = 'k';
            }
            else if ($value >= 1000000 AND $value < 1000000000)
            {
                $mux = 1000000;
                $unit = 'M';
            }
            else if ($value >= 1000000000 AND $value < 1000000000000)
            {
                $mux = 1000000000;
                $unit = 'b';
            }

            $approx = $value / $mux;

            return [
                'happrox' => number_format(($positive ? +1 : -1) * $approx, $instance->_decimalplace) . $unit,
                'value' => $value
            ];
        }
    }

    /**
    * Approximate a duration.
    *
    *
    * @param instance Happrox instance
    * @param value Duration to approximate
    * @return Happroximation
    * @throw
    */
    public static function duration($instance, $value)
    {
        if ($value > $instance->_datetime_max)
        {
            $rebased = $instance->_duration_base - $value;
            return [
                'happrox' => date($instance->_datetime_format, $rebased),
                'value' => $value
            ];
        }
        else
        {
            $approx = '';
            $sf = 1;
            $left = $value;
            if ($left >= 365 * 24 * 60 * 60)
            {
                $mux = 365 * 24 * 60 * 60;
                $count = (int) ($left / $mux);
                $left = $value % $mux;

                $approx .= $count . 'yr ';
                ++$sf;
            }
            if ($left >= 30 * 24 * 60 * 60 AND $sf <= $instance->_significant_durations)
            {
                $mux = 30 * 24 * 60 * 60;
                $count = (int) ($left / $mux);
                $left = $value % $mux;

                $approx .= $count . 'mnth ';
                ++$sf;
            }
            if ($left >= 7 * 24 * 60 * 60 AND $sf <= $instance->_significant_durations)
            {
                $mux = 7 * 24 * 60 * 60;
                $count = (int) ($left / $mux);
                $left = $value % $mux;

                $approx .= $count . 'wk ';
                ++$sf;
            }
            if ($left >= 24 * 60 * 60 AND $sf <= $instance->_significant_durations)
            {
                $mux = 24 * 60 * 60;
                $count = (int) ($left / $mux);
                $left = $value % $mux;

                $approx .= $count . 'd ';
                ++$sf;
            }
            if ($left >= 60 * 60 AND $sf <= $instance->_significant_durations)
            {
                $mux = 60 * 60;
                $count = (int) ($left / $mux);
                $left = $value % $mux;

                $approx .= $count . 'hr ';
                ++$sf;
            }
            if ($left >= 60 AND $sf <= $instance->_significant_durations)
            {
                $mux = 60;
                $count = (int) ($left / $mux);
                $left = $value % $mux;

                $approx .= $count . 'm ';
                ++$sf;
            }
            if ($left >0 AND $left < 60 AND $sf <= $instance->_significant_durations)
            {
                $mux = 1;
                $count = (int) ($left / $mux);
                $left = $value % $mux;

                $approx .= $count . 's ';
                ++$sf;
            }

            return [
                'happrox' => substr($approx, 0, strlen($approx)-1),
                'value' => $value
            ];
        }
    }
}

?>
