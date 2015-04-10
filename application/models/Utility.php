<?php
 /**
 * 
 */
class Utility {
	
	function __construct($argument) {
		
	}
    
    public static function years($start=0,$end=0)
    {
        $calendar = new CJcalendar;
        $current = intval($calendar -> date("Y", FALSE, FALSE));
        $result = array('default' => 'سال', );
        for ($i = $current - $start; $i <= $current+$end; $i++) 
            $result[$i] = $i;
        return $result;
    }
}

?>