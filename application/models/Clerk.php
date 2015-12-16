<?php
class Clerk {
	public function getClerkNumber($a) {
		$b = new CDatabase;
		$a = $b -> escape($a);
		$c = "SELECT clerk_number FROM tbl_clerk WHERE id='$a'";
		$d = $b -> queryOne($c);
		if ($d)
			return $d -> clerk_number;
		return FALSE;
	}

	public function getId($e) {
		$b = new CDatabase;
		$e = $b -> escape($e);
		$c = "SELECT id FROM tbl_clerk WHERE clerk_number='$e'";
		$d = $b -> queryOne($c);
		if ($d)
			return $d -> id;
		return FALSE;
	}

	public static function doesExist($a, $f) {
		$c = 'SELECT COUNT(*) FROM tbl_clerk WHERE id=\'' . $a . '\' AND time_added=\'' . $f . '\'';
		$b = new CDatabase;
		if ($b -> countRows($c))
			return TRUE;
		return FALSE;
	}

}
