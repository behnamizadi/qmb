<?php
class User {
    private $db;
    private $_username;
    private $_id;

    public function __construct() {
        $this -> db = new CDatabase;
    }

    public function set_username($username) {
        $this ->_username = $username;
    }
    
    public static function getDatabaseId($username)
    {
        $db= new Database;
        $query="select id from tbl_user where username='".$username."'";
        $result = $db -> queryOne($query);
        return $result->id;
    }

    public function getName() {
        $a = 'SELECT name FROM tbl_user WHERE id ="' . PHP40::get() -> user . '"';
        $c = $this -> db -> queryOne($a);
        return $c -> name;
    }

    public function producer() {
        $d = $this -> getName();
        $e = '<p style="float:left;text-align:center;font-size:17px;font-weight:bold">تهیه‌کننده: ';
        $e .= $d;
        $f = new CJcalendar;
        $e .= '<br />تاریخ: ';
        $e .= $f -> date('Y/m/d');
        $e .= '</p>';
        return $e;
    }

    public function get_last_pass_change() {
        $username = $this -> db -> escape($this -> _username);
        $sql = "SELECT last_pass_change FROM tbl_user WHERE username='$username'";
        $lastPass =$this -> db -> queryOne($sql);
        return intval($lastPass->last_pass_change);
    }

    public function update_last_login() {
        $username = $this ->_username;
        $sql = "UPDATE tbl_user SET last_login=last_login_new WHERE username='$username'";
        $this -> db -> execute($sql);
        $time = time();
        $sql = "UPDATE tbl_user SET last_login_new='$time' WHERE username='$username'";
        $this ->  db -> execute($sql);
    }

}
