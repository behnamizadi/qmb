<?php
class Evaluation {
	public static function unique($a, $b) {$c = "SELECT COUNT(*) FROM tbl_evaluation WHERE clerk_id='$a' AND year='$b'";
		$d = new CDatabase;
		if ($d -> countRows($c) > 0) {
			return FALSE;
		}
		return TRUE;
	}

}
?>