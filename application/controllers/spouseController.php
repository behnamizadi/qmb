<?php
class spouseController {
	public function index() {$a = new CForm;
		if ($a -> validate()) {CUrl::redirect('spouse/add/' . CUrl::segment(3) . '/' . CUrl::segment(4) . '/' . $_POST['takafol']);
		}$b = new CView;
		$b -> form = $a -> run();
		$b -> title = '&#1578;&#1593;&#1583;&#1575;&#1583; &#1575;&#1601;&#1585;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1705;&#1601;&#1604;';
		$b -> run();
	}

	public function add() {$c = CUrl::segment(3);
		$d = 'SELECT COUNT(*) FROM tbl_spouse WHERE clerk_id=\'' . $c . '\'';
		$e = new CDatabase;
		if ($e -> countRows($d))
			CUrl::redirect('spouse/edit/' . $c);
		$f = CUrl::segment(5);
		$g = CUrl::segment(4);
		$b = new CView;
		if ($f == FALSE) {$d = "SELECT takafol FROM tbl_profile WHERE clerk_id='$c'";
			$e = new CDatabase;
			$h = $e -> queryOne($d);
			if ($h) {$f = $h -> takafol;
				if ($f == 0) {$b -> error = '&#1575;&#1740;&#1606; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1605;&#1580;&#1585;&#1583; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583; &#1740;&#1575; &#1578;&#1593;&#1583;&#1575;&#1583; &#1575;&#1601;&#1585;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1705;&#1601;&#1604; &#1589;&#1601;&#1585; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583;. &#1604;&#1591;&#1601;&#1575; &#1575;&#1576;&#1578;&#1583;&#1575; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1601;&#1585;&#1583;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1585;&#1575; ' . CUrl::createLink('&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'clerk/edit/profile') . ' &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.';
					$b -> run();
				}
			} else {$b -> error = '&#1575;&#1740;&#1606; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1605;&#1580;&#1585;&#1583; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583; &#1740;&#1575; &#1578;&#1593;&#1583;&#1575;&#1583; &#1575;&#1601;&#1585;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1705;&#1601;&#1604; &#1589;&#1601;&#1585; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583;. &#1604;&#1591;&#1601;&#1575; &#1575;&#1576;&#1578;&#1583;&#1575; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1601;&#1585;&#1583;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1585;&#1575; ' . CUrl::createLink('&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'clerk/edit/profile') . ' &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.';
				$b -> run();
			}
		}$j = $f - 1;
		if ($j < 0)
			CUrl::redirect(404);
		if (Clerk::doesExist($c, $g)) {$a = new CForm;
			$a -> showFieldErrorText = FALSE;
			$a -> dontClose = TRUE;
			if (isset($_POST['submit'])) {$e = new CDatabase;
				$k = new CValidator;
				if ($_POST['study_degree'] == 2 || $_POST['study_degree'] == 3 || $_POST['study_degree'] == 4 || $_POST['study_degree'] == 5 || $_POST['study_degree'] == 6 || $_POST['study_degree'] == 7) {
					if (empty($_POST['study_field'])) {$a -> setError('study_field', '&#1604;&#1591;&#1601;&#1575; &#1601;&#1740;&#1604;&#1583; &#1585;&#1588;&#1578;&#1607; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740; &#1585;&#1575; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1705;&#1606;&#1740;&#1583;.');
					}
				}
				for ($l = 1; $l <= $j; $l++) {
					if ($k -> required($_POST['ch_name' . $l]) === FALSE) {$a -> setError('ch_name' . $l, '&#1608;&#1585;&#1608;&#1583; &#1606;&#1575;&#1605; &#1601;&#1585;&#1586;&#1606;&#1583; &#1575;&#1604;&#1586;&#1575;&#1605;&#1740;&#1587;&#1578; &#1576;&#1575;&#1588;&#1583;.(&#1601;&#1585;&#1586;&#1606;&#1583; ' . $l . ')');
					}
					if ($k -> maxLength($_POST['ch_name' . $l], 30) === FALSE) {$a -> setError('ch_name' . $l, '&#1606;&#1575;&#1605; &#1601;&#1585;&#1586;&#1606;&#1583; &#1606;&#1605;&#1740;&#8204;&#1578;&#1608;&#1575;&#1606;&#1583; &#1576;&#1740;&#1588;&#1578;&#1585; &#1575;&#1586; &#1779;&#1776; &#1705;&#1575;&#1585;&#1575;&#1705;&#1578;&#1585; &#1576;&#1575;&#1588;&#1583;.(&#1601;&#1585;&#1586;&#1606;&#1583; ' . $l . ')');
					}
					if ($k -> required($_POST['ch_code' . $l]) === FALSE) {$a -> setError('ch_code' . $l, '&#1608;&#1585;&#1608;&#1583; &#1705;&#1583; &#1605;&#1604;&#1740; &#1601;&#1585;&#1586;&#1606;&#1583; &#1575;&#1604;&#1586;&#1575;&#1605;&#1740;&#1587;&#1578; &#1576;&#1575;&#1588;&#1583;.(&#1601;&#1585;&#1586;&#1606;&#1583; ' . $l . ')');
					}
					if ($k -> length($_POST['ch_code' . $l], 10) === FALSE) {$a -> setError('ch_code' . $l, '&#1705;&#1583; &#1605;&#1604;&#1740; &#1601;&#1585;&#1586;&#1606;&#1583; &#1576;&#1575;&#1740;&#1583; &#1777;&#1776; &#1585;&#1602;&#1605;&#1740; &#1576;&#1575;&#1588;&#1583;.(&#1601;&#1585;&#1586;&#1606;&#1583; ' . $l . ')');
					}
					if ($k -> number($_POST['ch_code' . $l]) === FALSE) {$a -> setError('ch_code' . $l, '&#1705;&#1583; &#1605;&#1604;&#1740; &#1601;&#1585;&#1586;&#1606;&#1583; &#1576;&#1575;&#1740;&#1583; &#1593;&#1583;&#1583;&#1740; &#1576;&#1575;&#1588;&#1583;.(&#1601;&#1585;&#1586;&#1606;&#1583; ' . $l . ')');
					}
					if (empty($_POST['y_born' . $l])) {$a -> setError('y_born' . $l, '&#1604;&#1591;&#1601;&#1575; &#1578;&#1575;&#1585;&#1740;&#1582; &#1578;&#1608;&#1604;&#1583; &#1585;&#1575; &#1576;&#1607; &#1589;&#1608;&#1585;&#1578; &#1705;&#1575;&#1605;&#1604; &#1608;&#1575;&#1585;&#1583; &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.(&#1601;&#1585;&#1586;&#1606;&#1583;.' . $l . ')');
					}
					if (empty($_POST['d_born' . $l])) {$a -> setError('d_born' . $l, 'd');
					}
					if (empty($_POST['m_born' . $l])) {$a -> setError('m_born' . $l, 'm');
					}
					if (empty($_POST['city_born' . $l])) {$a -> setError('city_born' . $l, 'm');
					}
					if ($k -> maxLength($_POST['city_born' . $l], 30) === FALSE) {$a -> setError('city_born' . $l, 'v');
					}
				}
				if ($a -> validate() === TRUE) {$m = new CJcalendar;
					$e = new CDatabase;
					$n = $m -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
					$o = $m -> mktime(0, 0, 0, (int)$_POST['m_married'], (int)$_POST['d_married'], (int)$_POST['y_married']) + 14400;
					$e -> additional = array('clerk_id' => $c, 'number_of_children' => $j, 'date_born' => $n, 'date_married' => $o);
					$e -> insert();
					$p = $e -> lastId();
					$e -> setTbl('tbl_child');
					for ($l = 1; $l <= $j; $l++) {$n = $m -> mktime(0, 0, 0, (int)$_POST['m_born' . $l], (int)$_POST['d_born' . $l], (int)$_POST['y_born' . $l]) + 14400;
						$e -> additional = array('parent_id' => $p, 'clerk_id' => $c, 'name' => $_POST['ch_name' . $l], 'code_melli' => $_POST['ch_code' . $l], 'date_born' => $n, 'city_born' => $_POST['city_born' . $l]);
						$e -> insert();
					}CUrl::redirect('employment/add/' . $c . '/' . $g);
				}
			}$b -> title = '&#1608;&#1585;&#1608;&#1583; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1607; ' . Profile::getName($c);
			$b -> number_of_children = $j;
			$b -> clerk_id = $c;
			$b -> layout = 'jquery';
			$b -> f = $a;
			$b -> run('spouse/add');
		} else {$b -> error = '&#1605;&#1588;&#1705;&#1604;&#1740; &#1583;&#1585; &#1601;&#1585;&#1575;&#1740;&#1606;&#1583; &#1579;&#1576;&#1578; &#1576;&#1607; &#1608;&#1580;&#1608;&#1583; &#1570;&#1605;&#1583;&#1607; &#1575;&#1587;&#1578;.';
			$b -> run();
		}
	}

	public function edit() {$c = CUrl::segment(3);
		$b = new CView;
		$q = new Profile;
		if ($q -> hasSpouse($c) == FALSE) {$b -> error = '&#1575;&#1740;&#1606; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1605;&#1580;&#1585;&#1583; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583; &#1740;&#1575; &#1578;&#1593;&#1583;&#1575;&#1583; &#1575;&#1601;&#1585;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1705;&#1601;&#1604; &#1589;&#1601;&#1585; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583;. &#1604;&#1591;&#1601;&#1575; &#1575;&#1576;&#1578;&#1583;&#1575; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1601;&#1585;&#1583;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1585;&#1575; ' . CUrl::createLink('&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'clerk/edit/profile') . ' &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.';
			$b -> run();
		}$e = new CDatabase;
		$e -> pk = 'clerk_id';
		if (($s = $e -> getByPk($c)) == FALSE) {$d = "SELECT time_added FROM tbl_clerk WHERE id='$c'";
			$e = new CDatabase;
			$h = $e -> queryOne($d);
			if ($h) {$t = $h -> time_added;
				CUrl::redirect('spouse/add/' . $c . '/' . $t);
			} else {$b -> error = '&#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583; &#1740;&#1575; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1579;&#1576;&#1578; &#1606;&#1588;&#1583;&#1607; &#1575;&#1587;&#1578;.';
				$b -> run();
			}
		}$m = new CJcalendar(FALSE);
		$u = new StudyField;
		$b -> mb = $m -> date('m', $s -> date_born);
		$b -> db = $m -> date('d', $s -> date_born);
		$b -> yb = $m -> date('Y', $s -> date_born);
		$b -> mm = $m -> date('m', $s -> date_married);
		$b -> dm = $m -> date('d', $s -> date_married);
		$b -> ym = $m -> date('Y', $s -> date_married);
		$b -> study_field = Spouse::getStudyField($c);
		$b -> sfs = $u -> getByDegree($s -> study_degree);
		$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		if ($a -> validate()) {$n = $m -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
			$o = $m -> mktime(0, 0, 0, (int)$_POST['m_married'], (int)$_POST['d_married'], (int)$_POST['y_married']) + 14400;
			$e -> additional = array('date_born' => $n, 'date_married' => $o);
			$e -> update(array('clerk_id' => $c));
			CUrl::redirect('clerk/manage');
		}$b -> model = $s;
		$b -> clerk_id = $c;
		$b -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1607; ' . Profile::getName($c);
		$b -> layout = 'jquery';
		$b -> form = $a -> run();
		$b -> run('spouse/edit');
	}

}
