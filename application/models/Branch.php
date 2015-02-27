<?php
class Branch {
	private static $a = array('pos' => '<span style="font-size:12px">POS</span> &#1588;&#1593;&#1576;&#1607;&#8204;&#1575;&#1740;', 'atm' => '<span style="font-size:12px">ATM</span>', 'asr' => '&#1576;&#1575;&#1580;&#1607; &#1593;&#1589;&#1585;', 'mpls' => '<span style="font-size:12px">MPLS</span>', 'adsl' => '<span style="font-size:12px">ASDL</span>', 'vsat' => '<span style="font-size:12px">VSAT</span>', 'card' => '&#1570;&#1606;&#1740; &#1705;&#1575;&#1585;&#1578;', 'nobat' => '&#1583;&#1587;&#1578;&#1711;&#1575;&#1607; &#1606;&#1608;&#1576;&#1578;&#8204;&#1583;&#1607;&#1740;', 'dozdgir' => '&#1583;&#1586;&#1583;&#1711;&#1740;&#1585;', 'camera' => '&#1583;&#1608;&#1585;&#1576;&#1740;&#1606;', 'copy' => '&#1583;&#1587;&#1578;&#1711;&#1575;&#1607; &#1705;&#1662;&#1740;', 'gas_cooler' => '&#1705;&#1608;&#1604;&#1585; &#1711;&#1575;&#1586;&#1740;', 'water_cooler' => '&#1705;&#1608;&#1604;&#1585; &#1570;&#1576;&#1740;', 'up_pool' => '&#1662;&#1608;&#1604;&#1588;&#1605;&#1575;&#1585; &#1575;&#1740;&#1587;&#1578;&#1575;&#1583;&#1607;', 'miz_pool' => '&#1662;&#1608;&#1604;&#1588;&#1605;&#1575;&#1585; &#1585;&#1608;&#1605;&#1740;&#1586;&#1740;', );
	public function getByOstan() {$b = 'SELECT code,name FROM tbl_branch WHERE ostan="' . PHP40::get() -> defines['ostan'] . '"';
		$c = new CDatabase;
		return $c -> queryToArray($b, array('code' => 'name'));
	}

	public function getNameById($d) {$c = new CDatabase;
		$d = $c -> escape($d);
		$b = 'SELECT name FROM tbl_branch WHERE code="' . $d . '" AND ostan="' . PHP40::get() -> defines['ostan'] . '"';
		$e = $c -> queryOne($b);
		if ($e)
			return $e -> name;
		return FALSE;
	}

	public static function getPropName($f) {
		if (isset(self::$a[$f]))
			return self::$a[$f];
		return FALSE;
	}

}
