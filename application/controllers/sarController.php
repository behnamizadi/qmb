<?php
class sarController {
	public function add() {$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		$b = new CJcalendar(FALSE);
		if ($a -> validate()) {$c = $b -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']);
			$d = new CDatabase;
			$e = time();
			$d -> additional = array('date_start' => $c, 'time_added' => $e, 'ostan' => PHP40::get() -> defines['ostan']);
			$d -> insert();
			CUrl::redirect('sar/degree/' . $_POST['code']);
		}$g = new CView;
		$g -> form = $a -> run();
		$g -> title = '&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
		$g -> run();
	}

	public function degree() {$h = CUrl::segment(3);
		$d = new CDatabase;
		$j = 'SELECT COUNT(*) FROM tbl_sar WHERE code=\'' . $h . '\'';
		$g = new CView;
		if ($d -> countRows($j)) {$k = new CForm;
			$k -> showFieldErrorText = FALSE;
			if (isset($_POST['submit'])) {$l = count($_POST['degree']);
				for ($m = 0; $m < $l; $m++) {$n = TRUE;
					if (!empty($_POST['degree'][$m]) || !empty($_POST['degree_start'][$m])) {$n = FALSE;
					}
					if (!empty($_POST['degree'][$m]) && !empty($_POST['degree_start'][$m])) {$n = TRUE;
					}
					if ($n === FALSE) {
						if (empty($_POST['degree'][$m])) {$k -> setError("degree[$m]", 'e');
						}
						if (empty($_POST['degree_start'][$m])) {$k -> setError("degree_start[$m]", 'e');
						}
					}
				}
				if ($k -> validate() === TRUE) {$d -> setTbl('tbl_sar_degree');
					for ($m = 0; $m < $l; $m++) {
						if (!empty($_POST['degree'][$m]) || !empty($_POST['degree_start'][$m])) {$d -> additional = array('degree' => $_POST['degree'][$m], 'degree_start' => $_POST['degree_start'][$m], 'sar_code' => $h);
							$d -> insert();
						}
					}CUrl::redirect('sar/manage');
				}
			}$g -> title = '&#1608;&#1585;&#1608;&#1583; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1578;&#1575;&#1585;&#1740;&#1582;&#1670;&#1607; &#1583;&#1585;&#1580;&#1607; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
			$g -> layout = 'jquery';
			$g -> f = $k;
			$g -> run('sar/degree');
		} else {$g -> title = '&#1575;&#1588;&#1705;&#1575;&#1604; &#1583;&#1585; &#1601;&#1585;&#1575;&#1740;&#1606;&#1583; &#1579;&#1576;&#1578;';
			$g -> error = '&#1605;&#1588;&#1705;&#1604;&#1740; &#1583;&#1585; &#1601;&#1585;&#1575;&#1740;&#1606;&#1583; &#1579;&#1576;&#1578; &#1576;&#1607; &#1608;&#1580;&#1608;&#1583; &#1570;&#1605;&#1583;&#1607; &#1575;&#1587;&#1578;.';
			$g -> run();
		}
	}

	public function delete() {$h = CUrl::segment(3);
		$d = new CDatabase;
		$d -> delete(array('code' => $h));
		$d -> setTbl('tbl_sar_degree');
		$d -> delete(array('sar_code' => $h));
		CUrl::redirect('sar/manage');
	}

	public function edit() {$o = CUrl::segment(3);
		$a = new CForm;
		if (isset($_POST['submit'])) {$p = new Sar;
			if (!($h = $p -> getNameById($_POST['code']))) {$a -> setError('code', '&#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1705;&#1583; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;.');
			}
			if ($a -> validate() == TRUE) {
				switch($o) {case  'info' :
						CUrl::redirect('sar/info/' . $_POST['code']);
						break;
					case  'degree' :
						CUrl::redirect('sar/degrees/' . $_POST['code']);
						break;
					default :
						CUrl::redirect('sar/info/' . $_POST['code']);
				}
			}
		}$g = new CView;
		switch($o) {case  'info' :
				$g -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1662;&#1575;&#1740;&#1607; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
				break;
			case  'degree' :
				$g -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1578;&#1575;&#1585;&#1740;&#1582;&#1670;&#1607; &#1583;&#1585;&#1580;&#1575;&#1578; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
				break;
			default :
				$g -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1662;&#1575;&#1740;&#1607;  &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
		}$g -> form = $a -> run();
		$g -> run();
	}

	public function manage() {$q = new CGrid;
		$q -> counter = TRUE;
		$q -> counterWidth = '25px';
		$q -> headers = array('code', 'name', 'city' => array('format' => 'model[Cities,getById($value)]'), 'tel', 'fax', 'boss', 'mob');
		$q -> operations = array('edit' => FALSE);
		$q -> sort = 'code';
		$g = new CView;
		$g -> body = $q -> run();
		$g -> title = '&#1604;&#1740;&#1587;&#1578; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;&#8204;&#1607;&#1575;';
		$g -> run('sar/manage');
	}

	public function view() {$r = CUrl::segment(3);
		$s = FALSE;
		if (CUrl::segment(4) === 'print')
			$s = TRUE;
		$t = new CDetail;
		$t -> return = 'name';
		$t -> headers = array('code', 'name', 'city' => array('format' => 'model[Cities,getById($value)]'), 'tel', 'fax', 'boss', 'mob', 'date_start' => array('format' => 'model[Cal,getDate($value)]', 'label' => '<b>&#1578;&#1575;&#1585;&#1740;&#1582; &#1588;&#1585;&#1608;&#1593;</b>'), 'zip', 'geo' => array('format' => 'model[Lookup,getById($value,geo)]'), 'address');
		$t -> numberOfColumns = 5;
		$g = new CView;
		$g -> body = $t -> run();
		if ($s) {$g -> layout = 'print2';
			$g -> ptitle = '<h1>&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; ' . $t -> getReturnResult() . '</h1>';
			$u = new User;
			$g -> producer = $u -> producer();
		} else {$g -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'sar/view/' . $r . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$g -> title = '&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; ' . $t -> getReturnResult();
		if (!$s)
			$g -> link = '<p><a href="' . PHP40::get() -> homeUrl . 'index.php/sar/manage" class="box">&#1576;&#1575;&#1586;&#1711;&#1588;&#1578;</a></p>';
		$g -> degrees = Degree::sarHistory($r, FALSE, $s);
		$g -> run('sar/view');
	}

	public function info() {$h = CUrl::segment(3);
		$d = new CDatabase;
		if (($v = $d -> getByPk($h)) == FALSE) {$g -> error = '&#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1705;&#1583; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;.';
			$g -> run();
		}$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		if ($a -> validate()) {$b = new CJcalendar;
			$c = $b -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']);
			$d = new CDatabase;
			$d -> additional = array('date_start' => $c);
			$d -> update(array('code' => $h));
			CUrl::redirect('sar/manage');
		}$g = new CView;
		$b = new CJcalendar(FALSE);
		$g -> model = $v;
		$g -> m = $b -> date('m', $v -> date_start);
		$g -> d = $b -> date('d', $v -> date_start);
		$g -> y = $b -> date('Y', $v -> date_start);
		$g -> form = $a -> run();
		$g -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1662;&#1575;&#1740;&#1607; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
		$g -> run();
	}

	public function degrees() {$w = CUrl::segment(3);
		$g = new CView;
		$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if ($a -> validate()) {$_POST['error'] = 0;
				$d = new CDatabase;
				$d -> setTbl('tbl_sar_degree');
				$d -> additional = array('sar_code' => $w);
				$d -> insert();
			} else
				$_POST['error'] = 1;
		}$g -> body = Degree::sarHistory($w, array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'sar/degreeedit/$value->id/' . $w => array('icon' => 'public/images/edit.png', 'alt' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'title' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;'), 'sar/degreedelete/$value->id/' . $w => array('icon' => 'public/images/delete.png', 'alt' => '&#1581;&#1584;&#1601;', 'title' => '&#1581;&#1584;&#1601;', 'message' => '&#1608;&#1575;&#1602;&#1593;&#1575; &#1605;&#1740;&#8204;&#1582;&#1608;&#1575;&#1740; &#1581;&#1584;&#1601;&#1588; &#1705;&#1606;&#1740;&#1567;')));
		$g -> title = '&#1605;&#1583;&#1740;&#1585;&#1740;&#1578; &#1583;&#1585;&#1580;&#1575;&#1578; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740; ' . $w;
		$g -> layout = 'jquery';
		$g -> form = $a -> run();
		$g -> run('sar/degrees');
	}

	public function degreeedit() {$x = CUrl::segment(3);
		$w = CUrl::segment(4);
		if (!$x)
			CUrl::redirect(404);
		$d = new CDatabase;
		$d -> setTbl('tbl_sar_degree');
		$v = $d -> getByPk($x);
		if (!$v)
			CUrl::redirect(404);
		$a = new CForm;
		$a -> dontClose = TRUE;
		$a -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if ($a -> validate()) {$d -> update(array('id' => $x));
				CUrl::redirect('sar/degrees/' . $w);
			}
		}$g = new CView;
		$g -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1583;&#1585;&#1580;&#1607; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740; ' . $w;
		$g -> sarCode = $w;
		$g -> model = $v;
		$g -> form = $a -> run();
		$g -> run('sar/degreeedit');
	}

	public function degreedelete() {$x = CUrl::segment(3);
		$w = CUrl::segment(4);
		$d = new CDatabase;
		$d -> setTbl('tbl_sar_degree');
		$d -> delete(array('id' => $x));
		CUrl::redirect('sar/degrees/' . $w);
	}

}
