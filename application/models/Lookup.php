<?php
class Lookup {
	private $a;
	public function __construct() {$this -> db = new CDatabase;
	}

	public function getAll($b) {$c = "SELECT code,name FROM tbl_lookup WHERE type = '$b'";
		$d = $this -> db -> queryAll($c);
		$e = array();
		if ($d !== FALSE) {
			foreach ($d as $f) {$e[$f -> code] = $f -> name;
			}
		}
		return $e;
	}

	public function getById($g, $b) {$c = "SELECT name FROM tbl_lookup WHERE code = '$g' AND type = '$b'";
		$d = $this -> db -> queryOne($c);
		if ($d !== FALSE)
			return $d -> name;
		return FALSE;
	}

	public function add($b) {$c = 'SELECT MAX(code) FROM tbl_lookup WHERE type="' . $b . '"';
		$h = $this -> db -> queryOne($c, TRUE);
		$i = $h['MAX(code)'] + 1;
		$j = $this -> db -> escape($_POST['name']);
		if (isset($_POST['description'])) {$k = $this -> db -> escape($_POST['description']);
		}$c = 'INSERT INTO tbl_lookup VALUES("","' . $i . '","' . $j . '","' . $b . '","' . $k . '")';
		$this -> db -> execute($c);
	}

}
?>
