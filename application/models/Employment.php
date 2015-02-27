<?php
class Employment {
	public static function getPicture($a) {$b = "SELECT picture FROM tbl_employment WHERE clerk_id='$a'";
		$c = new CDatabase;
		$d = $c -> queryOne($b);
		if ($d)
			return $d -> picture;
		return FALSE;
	}

}
