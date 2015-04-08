<?php
class Ostan {
    public function getName() {
        if (isset($_SESSION['ostan'])) {
        $a = 'SELECT name FROM tbl_ostan WHERE id="' . $_SESSION['ostan'] . '"';
        $b = new CDatabase;
        if (($c = $b -> queryOne($a)))
            return 'استان ' . $c -> name;
        }
       return '';
     
    }

    public static function checkOstan() {

    }

    public static function getAll() {
        $sql = 'SELECT id,name FROM tbl_ostan';
        $db = new CDatabase;
        return $db -> queryToArray($sql, array('id' => 'name'));

    }

    public static function userAllowed($user_id, $ostan_id) {
        $db = new Database;
        $sql = 'select user_id FROM tbl_ostan_user where user_id=' . $user_id . ' and ostan_id=' . $ostan_id . '';
        $result = $db -> queryOne($sql);
        if (!$result === FALSE)
            return $result -> user_id;
        return $result;
    }

}
