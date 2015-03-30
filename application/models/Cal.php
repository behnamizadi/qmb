<?php
class Cal {
    public function getDate($a, $b = '') {
        if (!$b)
            $b = 'Y/m/d';
        if (!$a) {
            return FALSE;
        }
        return CJcalendar::date($b, $a);
    }

    public static function get_years() {
        
    }

}
