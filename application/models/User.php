<?php
class User {
	public function getName() {$a = 'SELECT name FROM tbl_user WHERE id ="' . PHP40::get() -> user . '"';
		$b = new CDatabase;
		$c = $b -> queryOne($a);
		return $c -> name;
	}

	public function producer() {$d = $this -> getName();
		$e = '<p style="float:left;text-align:center;font-size:17px;font-weight:bold">&#1578;&#1607;&#1740;&#1607;&#8204;&#1705;&#1606;&#1606;&#1583;&#1607;: ';
		$e .= $d;
		$f = new CJcalendar;
		$e .= '<br />&#1578;&#1575;&#1585;&#1740;&#1582;: ';
		$e .= $f -> date('Y/m/d');
		$e .= '</p>';
		return $e;
	}

}
