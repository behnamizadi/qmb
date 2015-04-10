<?php
class Vacation {
    private $_db;
    function __construct($argument) {

    }

    public static function getStat($clerk_id, $year, $c = FALSE) {
        $data = array();
        $db= new CDatabase;
        if ($c !== FALSE) {
            $f = "SELECT * FROM tbl_vacation_year WHERE clerk_id='$clerk_id' AND year='$year'";
            $g = $db-> queryOne($f);
            $data['جمع مرخصی استحقاقی استفاده شده'] = $g -> used;
            $data['مانده مرخصی استحقاقی'] = $g -> all_v - $g -> used;
            $data['ذخیره مرخصی استحقاقی'] = $g -> saved;
            return $data;
        }
        $f = "SELECT date_employed FROM tbl_employment WHERE clerk_id='".$clerk_id."'";
        $date_employed = $db-> queryOne($f) -> date_employed;
        $jcal = new CJcalendar(FALSE);
        $ebtedaye_sal = $jcal -> mktime(0, 0, 0, 1, 1, $year);
        $end_of_year = $jcal -> mktime(23, 59, 59, 12, 29, $year);
        $days=365; 
        if ($jcal -> isLeap($year)) {
            $days=366;
            $end_of_year = $jcal -> mktime(23, 59, 59, 12, 30, $year);
        }
        $m = new Lookup;
        $n = $m -> getAll('vacation');
        $estehghaghi=0;
        foreach ($n as $vacation_type => $vacation_name) {
            $f = "SELECT SUM(period) FROM tbl_vacation WHERE clerk_id='$clerk_id' AND type='$vacation_type' AND date_start BETWEEN $ebtedaye_sal AND $end_of_year";
            $data[$vacation_name] = $db-> sumRows('period', $f);
            if ($vacation_type == 1)
                $estehghaghi = $db-> sumRows('period', $f);
        }
        if ($year < 1392) {
            $r = 30;
              } else {
            $r = 26;}
            $mandeh=0;
            
            if ($year == $jcal -> date('Y', $date_employed)) {
                $days=floor(($end_of_year-$date_employed)/(60*60*24));
                
            }
            $mandeh=(($days*$r)/365)-$estehghaghi;
            $data['مانده مرخصی استحقاقی'] =round($mandeh);
      
       
        return $data;
    }

    public static function listYearlyVacation($clerk_id) {
        $db = new Database;
        $query = "select * from tbl_vacation_year where clerk_id=" . $clerk_id . " ";
        return $db -> JtableList($query);
    }

    public static function deleteYearlyVacation($clerk_id, $year) {
        $db = new Database;
        $query = "delete from tbl_vacation_year where clerk_id=" . $clerk_id . " and year=" . $year . " ";
        return $db -> JTableDelete($query);
    }

    public static function createYearlyVacation($parameters) {

        $db = new Database;
        $query = "insert into tbl_vacation_year(clerk_id,year,all_v,used,saved,wasted) values(" . $parameters['clerk_id'] . "," . $parameters['year'] . "," . $parameters['all_v'] . "," . $parameters['used'] . "," . $parameters['saved'] . "," . $parameters['wasted'] . ") ";
        if ($db -> execute($query)) {
            $query = "select top 1 * from tbl_vacation_year where clerk_id=" . $parameters['clerk_id'] . " and year=" . $parameters['year'] . " ";
            return $db -> JTablelast($query);
        } else {
            $jTableResult = array();
            $jTableResult['Result'] = "ERROR";
            $jTableResult['Message'] = "Cant insert";
            return json_encode($jTableResult);
        }
    }

    public static function updateYearlyVacation($parameters) {

        $db = new Database;
        $query = "update tbl_vacation_year set 
        all_v=". $parameters['all_v']." ,".
        "used=". $parameters['used'] ." ,". 
        "saved=". $parameters['saved'] . " ,".
        "wasted=". $parameters['wasted'] .
        " where clerk_id=".$parameters['clerk_id'] . " and year=" . $parameters['year'] . " " ;
        return $db->JTableUpdate($query);
    }
    public static function generateHokmNumber($year,$ostan){
        $calendar = new CJcalendar;
        $yearstart = $calendar -> mktime(0, 0, 0, 1, 1, $year) + 14400;
        $yearend = $calendar -> mktime(0, 0, 0, 12, 29, $year) + 14400;
        $ddd = 1;
        $db=new Database;
        $u = "SELECT * FROM tbl_vacation where date_start BETWEEN '$yearstart' AND '$yearend' ORDER BY id DESC LIMIT 0,1";
        $result = $db -> queryOne($u);
        if ($result)
            $ddd = $result -> hokm_number + 1;
       return $ddd;
    }
}
