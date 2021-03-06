<?php

class DateFormat {

    public static function alter($date, $before, $after) {
        $dt = DateTime::createFromFormat($before, $date);
        if($dt) return $dt->format($after);
        return null;
    }

    public static function toSQL($date, $before = 'd/m/Y') {
        return self::alter($date, $before, 'Y-m-d H:i:s');
    }

    public static function toHTML($date, $before = 'Y-m-d H:i:s') {
        return self::alter($date, $before, 'd/m/Y');
    }
    
}