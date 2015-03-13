<?php
class User {
	public function getName() {
$a = 'SELECT name FROM tbl_user WHERE id ="' . PHP40::get() -> user . '"';
		$b = new CDatabase;
		$c = $b -> queryOne($a);
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

}
