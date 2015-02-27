<?php
class Spouse {
	public static function getStudyField($a) {$b = "SELECT study_field FROM tbl_spouse WHERE clerk_id='$a'";
		$c = new CDatabase;
		$d = $c -> queryOne($b);
		if ($d)
			return $d -> study_field;
		return FALSE;
	}

	public static function getNumberOfChildren($a) {$b = "SELECT number_of_children FROM tbl_spouse WHERE clerk_id='$a'";
		$c = new CDatabase;
		$d = $c -> queryOne($b);
		if ($d)
			return $d -> number_of_children;
		return FALSE;
	}

}
