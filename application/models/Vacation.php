<?php
class Vacation {
	public static function getStat($a, $b, $c = FALSE) {$d = array();
		$e = new CDatabase;
		if ($c !== FALSE) {$f = "SELECT * FROM tbl_vacation_year WHERE clerk_id='$a' AND year='$b'";
			$g = $e -> queryOne($f);
			$d['&#1580;&#1605;&#1593; &#1605;&#1585;&#1582;&#1589;&#1740; &#1575;&#1587;&#1578;&#1581;&#1602;&#1575;&#1602;&#1740; &#1575;&#1587;&#1578;&#1601;&#1575;&#1583;&#1607; &#1588;&#1583;&#1607;'] = $g -> used;
			$d['&#1605;&#1575;&#1606;&#1583;&#1607; &#1605;&#1585;&#1582;&#1589;&#1740; &#1575;&#1587;&#1578;&#1581;&#1602;&#1575;&#1602;&#1740;'] = $g -> all_v - $g -> used;
			$d['&#1584;&#1582;&#1740;&#1585;&#1607; &#1605;&#1585;&#1582;&#1589;&#1740; &#1575;&#1587;&#1578;&#1581;&#1602;&#1575;&#1602;&#1740;'] = $g -> saved;
			return $d;
		}$f = "SELECT date_employed FROM tbl_employment WHERE clerk_id='$a'";
		$h = $e -> queryOne($f) -> date_employed;
		$i = new CJcalendar(FALSE);
		$j = $i -> mktime(0, 0, 0, 1, 1, $b);
		$k = $i -> mktime(23, 59, 59, 12, 29, $b);
		if ($i -> isLeap($b)) {$k = $i -> mktime(23, 59, 59, 12, 30, $b);
		}$m = new Lookup;
		$n = $m -> getAll('vacation');
		foreach ($n as $o => $p) {$f = "SELECT SUM(period) FROM tbl_vacation WHERE clerk_id='$a' AND type='$o' AND date_start BETWEEN $j AND $k";
			$d[$p] = $e -> sumRows('period', $f) . ' &#1585;&#1608;&#1586;';
			if ($o == 1)
				$q = $e -> sumRows('period', $f);
		}
		if ($b < 1392) {$r = 30;
			if ($s == $i -> date('Y', $h)) {$t = $i -> date('d', $h);
				$r = (12 - $i -> date('m', $h)) * 2.5;
				if ($t > 1 && $t <= 5)
					$r += 2.5;
				elseif ($t > 5 && $t <= 10)
					$r += 2;
				elseif ($t > 10 && $t <= 15)
					$r += 1.5;
				elseif ($t > 15 && $t <= 20)
					$r += 1;
				elseif ($t > 20 && $t <= 25)
					$r += 0.5;
			}$d['&#1605;&#1575;&#1606;&#1583;&#1607; &#1605;&#1585;&#1582;&#1589;&#1740; &#1575;&#1587;&#1578;&#1581;&#1602;&#1575;&#1602;&#1740;'] = round($r - $q);
		} else {$r = 26;
			if ($b == $i -> date('Y', $h)) {$t = $i -> date('d', $h);
				$r = (12 - $i -> date('m', $h)) * 2.17;
				if ($t > 1 && $t <= 5)
					$r += 2.17;
				elseif ($t > 5 && $t <= 10)
					$r += 1.74;
				elseif ($t > 10 && $t <= 15)
					$r += 1.31;
				elseif ($t > 15 && $t <= 20)
					$r += 0.88;
				elseif ($t > 20 && $t <= 25)
					$r += 0.45;
			}$d['&#1605;&#1575;&#1606;&#1583;&#1607; &#1605;&#1585;&#1582;&#1589;&#1740; &#1575;&#1587;&#1578;&#1581;&#1602;&#1575;&#1602;&#1740;'] = round($r - $q);
		}
		return $d;
	}

}
