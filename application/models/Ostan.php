<?php
class Ostan {
	public function getName() {$a = 'SELECT name FROM tbl_ostan WHERE id="' . PHP40::get() -> defines['ostan'] . '"';
		$b = new CDatabase;
		if (($c = $b -> queryOne($a)))
			return '&#1575;&#1587;&#1578;&#1575;&#1606; ' . $c -> name;
		return;
	}

}
