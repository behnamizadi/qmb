<?php
class StudyField {
	public function getByDegree($a) {$b = new CDatabase;
		$c = 'SELECT id,title FROM tbl_study_field WHERE study_degree="' . $a . '"';
		return $b -> queryToArray($c, array('id' => 'title'));
	}

	public function getById($d) {$c = 'SELECT title FROM tbl_study_field WHERE id="' . $d . '"';
		$b = new CDatabase;
		$e = $b -> queryOne($c);
		if ($e)
			return $e -> title;
		return FALSE;
	}

}
