<?php
class Notice {
	const ASR_LIMIT = 1382400;
	const CLERK_LIMIT = 2678400;
	public function getAsr() {$a = "SELECT date_end FROM tbl_notice_asr";
		$b = new CDatabase;
		$c = $b -> queryAll($a);
		if (!empty($c)) {$a = "SELECT days FROM tbl_notice_period WHERE n_type='asr'";
			$d = $b -> queryOne($a) -> days;
			$d = $d * 86400;
			$e = time();
			foreach ($c as $f) {
				if ($d > ($f -> date_end - $e)) {
					return TRUE;
				}
			}
		}
		return FALSE;
	}

	public function getClerk() {$a = "SELECT date_end FROM tbl_notice_clerk";
		$b = new CDatabase;
		$g = $b -> queryAll($a);
		if (!empty($g)) {$a = "SELECT days FROM tbl_notice_period WHERE n_type='clerk'";
			$h = $b -> queryOne($a) -> days;
			$h = $h * 86400;
			$e = time();
			foreach ($g as $i) {
				if ($h > (($i -> date_end) - $e)) {
					return TRUE;
				}
			}
		}
		return FALSE;
	}

}
