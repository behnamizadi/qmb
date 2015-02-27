<?php
class Training {
	public static function getPassed($a) {
		if ($a == 1)
			return '&#1602;&#1576;&#1608;&#1604;';
		return '&#1585;&#1583;';
	}

	public static function getAll() {$b = "SELECT tbl_lookup.code,tbl_lookup.name FROM tbl_lookup,tbl_training WHERE tbl_lookup.type = 'training' 
		AND tbl_lookup.code = tbl_training.title";
		$c = new CDatabase;
		$d = $c -> queryAll($b);
		$e = array();
		if ($d !== FALSE) {
			foreach ($d as $f) {$e[$f -> code] = $f -> name;
			}
		}
		return $e;
	}

}
