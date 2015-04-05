<?php
class Vacation {
    private $_db;
    function __construct($argument) {

    }

    public static function getStat($a, $b, $c = FALSE) {
        $d = array();
        $e = new CDatabase;
        if ($c !== FALSE) {
            $f = "SELECT * FROM tbl_vacation_year WHERE clerk_id='$a' AND year='$b'";
            $g = $e -> queryOne($f);
            $d['جمع مرخصی استحقاقی استفاده شده'] = $g -> used;
            $d['مانده مرخصی استحقاقی'] = $g -> all_v - $g -> used;
            $d['ذخیره مرخصی استحقاقی'] = $g -> saved;
            return $d;
        }
        $f = "SELECT date_employed FROM tbl_employment WHERE clerk_id='$a'";
        $h = $e -> queryOne($f) -> date_employed;
        $i = new CJcalendar(FALSE);
        $j = $i -> mktime(0, 0, 0, 1, 1, $b);
        $k = $i -> mktime(23, 59, 59, 12, 29, $b);
        if ($i -> isLeap($b)) {$k = $i -> mktime(23, 59, 59, 12, 30, $b);
        }$m = new Lookup;
        $n = $m -> getAll('vacation');
        foreach ($n as $o => $p) {$f = "SELECT SUM(period) FROM tbl_vacation WHERE clerk_id='$a' AND type='$o' AND date_start BETWEEN $j AND $k";
            $d[$p] = $e -> sumRows('period', $f) . ' روز';
            if ($o == 1)
                $q = $e -> sumRows('period', $f);
        }
        if ($b < 1392) {
            $r = 30;
            if ($s == $i -> date('Y', $h)) {$t = $i -> date('d', $h);
                $r = (12 - $i -> date('m', $h)) * 2.5;
                if ($t > 1 && $t <= 5)
                    $r += 2.5;
                elseif ($t > 5 && $t <= 10)
                    $r += 2;
                elseif ($t > 10 && $t <= 15)
                    $r += 1.5;
                elseif ($t > 15 && $t <= 20)
                    $r += 1;
                elseif ($t > 20 && $t <= 25)
                    $r += 0.5;
            }$d['مانده مرخصی استحقاقی'] = round($r - $q);
        } else {$r = 26;
            if ($b == $i -> date('Y', $h)) {$t = $i -> date('d', $h);
                $r = (12 - $i -> date('m', $h)) * 2.17;
                if ($t > 1 && $t <= 5)
                    $r += 2.17;
                elseif ($t > 5 && $t <= 10)
                    $r += 1.74;
                elseif ($t > 10 && $t <= 15)
                    $r += 1.31;
                elseif ($t > 15 && $t <= 20)
                    $r += 0.88;
                elseif ($t > 20 && $t <= 25)
                    $r += 0.45;
            }$d['مانده مرخصی استحقاقی'] = round($r - $q);
        }
        return $d;
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
