<?php
class profileController {
	public function add() {$a = CUrl::segment(3);
		$b = CUrl::segment(4);
		$c = new CView;
		$d = 'SELECT COUNT(*) FROM tbl_profile WHERE clerk_id=\'' . $a . '\'';
		$e = new CDatabase;
		if ($e -> countRows($d))
			CUrl::redirect('profile/edit/' . $a);
		if (Clerk::doesExist($a, $b)) {$f = new CForm;
			$f -> showFieldErrorText = FALSE;
			if (isset($_POST['submit'])) {
				if (isset($_POST['sex']) && $_POST['sex'] == 1 && empty($_POST['sarbazi'])) {$f -> setError('sarbazi', '&#1575;&#1740;&#1606; &#1601;&#1740;&#1604;&#1583; &#1576;&#1585;&#1575;&#1740; &#1580;&#1606;&#1587;&#1740;&#1578; &#1605;&#1585;&#1583;&#1548; &#1606;&#1605;&#1610;&#8204;&#1578;&#1608;&#1575;&#1606;&#1583; &#1582;&#1575;&#1604;&#1740; &#1576;&#1605;&#1575;&#1606;&#1583;.');
				}
				if (isset($_POST['married']) && $_POST['married'] == 2 && empty($_POST['takafol'])) {$f -> setError('takafol', '&#1575;&#1740;&#1606; &#1601;&#1740;&#1604;&#1583; &#1576;&#1585;&#1575;&#1740; &#1575;&#1601;&#1585;&#1575;&#1583; &#1605;&#1578;&#1575;&#1607;&#1604; &#1606;&#1605;&#1740;&#8204;&#1578;&#1608;&#1575;&#1606;&#1583; &#1582;&#1575;&#1604;&#1740; &#1576;&#1605;&#1575;&#1606;&#1583;.');
				}
				if ($f -> validate() === TRUE) {$g = new CJcalendar;
					$h = $g -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
					$e -> additional = array('date_born' => $h, 'clerk_id' => $a);
					$e -> insert();
					if ($_POST['married'] == 2)
						CUrl::redirect('spouse/add/' . $a . '/' . $b . '/' . $_POST['takafol']);
					else
						CUrl::redirect('employment/add/' . $a . '/' . $b);
				}
			}$c -> layout = 'jquery';
			$c -> title = '&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
			$c -> form = $f -> run();
			$c -> run('profile/create');
		} else {$c -> error = '&#1605;&#1588;&#1705;&#1604;&#1740; &#1583;&#1585; &#1601;&#1585;&#1575;&#1740;&#1606;&#1583; &#1579;&#1576;&#1578; &#1576;&#1607; &#1608;&#1580;&#1608;&#1583; &#1570;&#1605;&#1583;&#1607; &#1575;&#1587;&#1578;.';
			$c -> run();
		}
	}

	public function view() {$i = CUrl::segment(3);
		$j = new CDetail;
		$j -> headers = array('name', 'lastname', 'tel', 'mobile', 'father', 'date_born' => array('model[CJcalendar,date(Y/m/j,$value)]'), 'city_born', 'city_sodur', 'sh_sh', 'code_melli');
		$k = Clerk::getMarried($i);
		$l = array();
		if ($k == '&#1605;&#1580;&#1585;&#1583;')
			$l['&#1608;&#1590;&#1593;&#1740;&#1578; &#1578;&#1575;&#1607;&#1604;'] = $k;
		else {$d = 'SELECT * FROM tbl_spouse WHERE clerk_id=\'' . $i . '\'';
			$e = new CDatabase;
			$m = $e -> queryOne($d);
			$l['&#1606;&#1575;&#1605; &#1607;&#1605;&#1587;&#1585;'] = $m -> name;
			$l['&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740; &#1607;&#1605;&#1587;&#1585;'] = $m -> lastname;
			$l['&#1588;&#1594;&#1604; &#1607;&#1605;&#1587;&#1585;'] = $m -> job;
			$l['&#1606;&#1575;&#1605; &#1662;&#1583;&#1585; &#1607;&#1605;&#1587;&#1585;'] = $m -> father;
			$l['&#1588;&#1605;&#1575;&#1585;&#1607; &#1588;&#1606;&#1575;&#1587;&#1606;&#1575;&#1605;&#1607; &#1607;&#1605;&#1587;&#1585;'] = $m -> sh_sh;
			$l['&#1705;&#1583; &#1605;&#1604;&#1740; &#1607;&#1605;&#1587;&#1585;'] = $m -> code_melli;
			$l['&#1578;&#1593;&#1583;&#1575;&#1583; &#1601;&#1585;&#1586;&#1606;&#1583;'] = $m -> number_of_children;
			if ($m -> number_of_children > 0) {$d = 'SELECT * FROM tbl_child WHERE clerk_id=\'' . $i . '\'';
				$n = $e -> queryAll($d);
				$o = 1;
				$b = new CJcalendar;
				foreach ($n as $p) {$l['&#1606;&#1575;&#1605; &#1601;&#1585;&#1586;&#1606;&#1583;' . $o] = $p -> name;
					$l['&#1705;&#1583; &#1605;&#1604;&#1740;' . $o] = $p -> code_melli;
					$l['&#1578;&#1575;&#1585;&#1740;&#1582; &#1578;&#1608;&#1604;&#1583;' . $o] = $b -> date("Y/m/j", $p -> date_born);
					$o++;
				}
			}
		}$j -> additional = $l;
		$c = new CView;
		$c -> body = $j -> run();
		$c -> run('profile/view');
	}

	public function edit() {$i = CUrl::segment(3);
		$e = new CDatabase;
		if (($q = $e -> getByPk($i)) == FALSE)
			CUrl::redirect(404);
		$c = new CView;
		$c -> model = $q;
		$g = new CJcalendar(FALSE);
		$c -> m = $g -> date('m', $q -> date_born);
		$c -> d = $g -> date('d', $q -> date_born);
		$c -> y = $g -> date('Y', $q -> date_born);
		$f = new CForm;
		$f -> dontClose = TRUE;
		$f -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if (isset($_POST['married']) && $_POST['married'] == 2)
				$c -> takafol_display = '</td><td><div id="takafol_display"><label>&#1578;&#1593;&#1583;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1601;&#1705;&#1604;<span class="error">*</span></label>';
			if ($f -> validate() === TRUE) {$g = new CJcalendar;
				$h = $g -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
				$e -> additional = array('date_born' => $h);
				$e -> update(array('clerk_id' => $i));
				CUrl::redirect('clerk/manage');
			}
		}
		if ($q -> married == 2)
			$c -> takafol_display = '<td><div id="takafol_display"><label>&#1578;&#1593;&#1583;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1601;&#1705;&#1604;<span class="error">*</span></label>';
		else
			$c -> takafol_display = '<td><div id="takafol_display"  class="display_none"><label>&#1578;&#1593;&#1583;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1601;&#1705;&#1604;<span class="error">*</span></label>';
		$c -> form = $f -> run();
		$c -> layout = 'jquery';
		$c -> run('profile/create');
	}

	public function delete() {$i = CUrl::segment(3);
		$r = array('id' => $i);
		$e = new CDatabase;
		$e -> delete($r);
		$r = array('clerk_id' => $i);
		$e -> setTbl('tbl_spouse');
		$e -> delete($r);
		$e -> setTbl('tbl_child');
		$e -> delete($r);
		CUrl::redirect('profile/manage');
	}

}
