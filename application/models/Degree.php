<?php
class Degree {
	public static function degreeHistory($a, $b = TRUE, $c = FALSE) {$d = new CGrid;
		if ($c)
			$d -> noSort = TRUE;
		$d -> headers = array('degree' => array('format' => 'model[Lookup,getById($value,degree)]', 'label' => '&#1583;&#1585;&#1580;&#1607;'), 'degree_start' => array('label' => '&#1587;&#1575;&#1604;'), );
		$d -> table = 'tbl_degree';
		$d -> condition = array('branch_code' => $a);
		$d -> operations = $b;
		$d -> sort = 'degree_start DESC';
		return $d -> run();
		if ($e == CGrid::NOTFOUND)
			return FALSE;
		return $e;
	}

	public static function sarHistory($a, $b = TRUE, $c = FALSE) {$d = new CGrid;
		if ($c)
			$d -> noSort = TRUE;
		$d -> headers = array('degree' => array('format' => 'model[Lookup,getById($value,sar_degree)]', 'label' => '&#1583;&#1585;&#1580;&#1607;'), 'degree_start' => array('label' => '&#1587;&#1575;&#1604;'), );
		$d -> table = 'tbl_sar_degree';
		$d -> condition = array('sar_code' => $a);
		$d -> operations = $b;
		$d -> sort = 'degree_start DESC';
		return $d -> run();
		if ($e == CGrid::NOTFOUND)
			return FALSE;
		return $e;
	}

}
