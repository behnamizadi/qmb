<?php
class Ostan {
	public function getName() {
		$a = 'SELECT name FROM tbl_ostan WHERE id="' . PHP40::get() -> defines['ostan'] . '"';
		$b = new CDatabase;
		if (($c = $b -> queryOne($a)))
			return 'استان ' . $c -> name;
		return;
	}

}
