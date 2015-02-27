<?php
class Profile {
	public function getMarried($a) {$b = 'SELECT married FROM tbl_profile WHERE clerk_id=\'' . $a . '\'';
		$c = new CDatabase;
		$d = $c -> queryOne($b);
		if ($d -> married == 1) {
			return '&#1605;&#1580;&#1585;&#1583;';
		}
		return '&#1605;&#1578;&#1575;&#1607;&#1604;';
	}

	public function hasSpouse($a) {$b = "SELECT COUNT(*) FROM tbl_profile WHERE married='2' AND takafol>0 AND clerk_id='$a'";
		$c = new CDatabase;
		if ($c -> countRows($b))
			return TRUE;
		return FALSE;
	}

	public static function getSumm($e) {$f = new Clerk;
		$g = $f -> getClerkNumber($e);
		$h = new CDetail;
		$h -> headers = array('name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'));
		$h -> additional = array('&#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740;' => $g);
		$h -> table = 'tbl_profile';
		$h -> pkValue = $e;
		$h -> numberOfColumns = 4;
		return $h -> run();
	}

	public static function getName($e) {$b = 'SELECT name,lastname,sex,clerk_number FROM tbl_profile,tbl_clerk WHERE tbl_profile.clerk_id=tbl_clerk.id AND  clerk_id=\'' . $e . '\'';
		$c = new CDatabase;
		$i = $c -> queryOne($b);
		if ($i) {
			if ($i -> sex == 1)
				$j = '&#1570;&#1602;&#1575;&#1740; ';
			else
				$j = '&#1582;&#1575;&#1606;&#1605; ';
			$j .= $i -> name . ' ' . $i -> lastname . '(' . $i -> clerk_number . ')';
			return $j;
		}
		return FALSE;
	}

}
