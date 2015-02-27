<?php
class Cities {
	public static function getCities() {$a = 'SELECT * FROM tbl_city WHERE ostan_id="' . PHP40::get() -> defines['ostan'] . '"';
		$b = new CDatabase;
		return $b -> queryToArray($a, array('id' => 'name'));
	}

	public function getById($c) {$a = "SELECT name FROM tbl_city WHERE id = '$c'";
		$b = new CDatabase;
		$d = $b -> queryOne($a);
		if ($d !== FALSE)
			return $d -> name;
		return FALSE;
	}

}
