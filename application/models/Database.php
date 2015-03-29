<?php
/**
 *
 */
class Database extends CDatabase {

    public function JTableList($query, $start = False, $end = False, $orderby = False) {
        $recordCount = 0;
        $co = "SELECT COUNT(*) AS RecordCount FROM (" . $query . ") countresult;";
        $k = $this -> execute($co);
        if ($k === FALSE) {
            $recordCount = 0;
        } else {
            $v = $k -> fetch_array(MYSQLI_ASSOC);
            $recordCount = $v['RecordCount'];
        }

        if ($start != FALSE && $end != False) {
            //Get records from database "ORDER BY " . $_GET["jtSorting"] .
            $query .= " LIMIT " . $start . "," . $end . ";";
        }
        if ($recordCount != 0) {
            $k = $this -> execute($query);
            while ($m = $k -> fetch_assoc()) {
                $l['Records'][] = $m;
            }
        }
        if (empty($l))
            return "{}";
        $l['Result'] = 'OK';
        $l['TotalRecordCount'] = $recordCount;
        return json_encode($l);
    }

    public function JTableLast($query) {
        $k = $this -> execute($query);
        $l['Record'][] = $k;
        $l['Result'] = 'OK';
        return json_encode($l);
    }

    public function JTableDelete($query) {
        $this -> execute($query);
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }

    public function JTableCreate($query) {
        $result = $this -> execute($query);
        $l['Records'] = $result;
        $l['Result'] = 'OK';
        return json_encode($l);
    }

    public function JTableUpdate($query) {
        $result = $this -> execute($query);
        $l['Result'] = 'OK';
        return json_encode($l);
    }

}
