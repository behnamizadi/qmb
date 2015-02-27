<?php
class Sar {
	public function getNameById($a) {$b = new CDatabase;
		$a = $b -> escape($a);
		$c = 'SELECT name FROM tbl_sar WHERE code="' . $a . '" AND ostan="' . PHP40::get() -> defines['ostan'] . '"';
		$d = $b -> queryOne($c);
		if ($d)
			return $d -> name;
		return FALSE;
	}

}
