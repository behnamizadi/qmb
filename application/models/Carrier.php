<?php
class Carrier {
	public static function comletePlace($a) {$b = 'SELECT name FROM tbl_ostan WHERE id="' . $_SESSION['ostan'] . '"';
		$c = new CDatabase;
		$d = '';
		if (($e = $c -> queryOne($b)))
			$d = '&#1575;&#1587;&#1578;&#1575;&#1606; ' . $e -> name;
		if ($a != 0) {$f = $d;
			$b = "SELECT name,city FROM tbl_branch WHERE code='$a'";
			if (($g = $c -> queryOne($b)) !== FALSE) {$b = "SELECT name FROM tbl_city WHERE id = '$g->city'";
				$h = $c -> queryOne($b);
				$i = '';
				if ($h !== FALSE)
					$i = $h -> name;
				$f .= "- &#1588;&#1607;&#1585; $i- &#1588;&#1593;&#1576;&#1607; $g->name";
			}
		} else {$f = "&#1605;&#1583;&#1740;&#1585;&#1740;&#1578; &#1588;&#1593;&#1576; $d";
		}
		return $f;
	}

}
