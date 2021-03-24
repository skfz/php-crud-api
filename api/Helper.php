<?php

namespace Api;
use \DateTime;

class Helper {
    public static function validateDate($date, $format='Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}