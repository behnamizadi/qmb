<?php
class p_pController {
	public function index() {$a = new CForm;
		if (isset($_POST['submit'])) {$b = new Clerk;
			$c = $b -> getId($_POST['clerk_number']);
			if (!$c) {$a -> setError('clerk_number', '&#1585;&#1705;&#1608;&#1585;&#1583;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;.');
			}
			if ($a -> validate() == TRUE) {
				if (CUrl::segment(3) == 'add') {$d = CUrl::segment(4);
					if (!empty($d)) {CUrl::redirect('p_p/add/' . $c . '/' . $d);
					}
				}CUrl::redirect('p_p/summ/' . $c);
			}
		}$e = new CView;
		if (CUrl::segment(3) == 'add') {
			if (CUrl::segment(4) == 1)
				$e -> title = '&#1579;&#1576;&#1578; &#1578;&#1588;&#1608;&#1740;&#1602;';
			else
				$e -> title = '&#1579;&#1576;&#1578; &#1578;&#1606;&#1576;&#1740;&#1607;';
		} else
			$e -> title = '&#1711;&#1586;&#1575;&#1585;&#1588; &#1578;&#1588;&#1608;&#1740;&#1602;&#1575;&#1578;/ &#1578;&#1606;&#1576;&#1740;&#1607;&#1575;&#1578; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
		$e -> layout = 'jquery';
		$e -> form = $a -> run();
		$e -> run('clerk/edit');
	}

	public function index2() {$a = new CForm;
		if ($a -> validate() == TRUE) {CUrl::redirect('p_p/all/' . $_POST['type'] . '/' . $_POST['year']);
		}$e = new CView;
		$e -> title = '&#1711;&#1586;&#1575;&#1585;&#1588; &#1578;&#1588;&#1608;&#1740;&#1602;&#1575;&#1578;/&#1578;&#1606;&#1576;&#1740;&#1607;&#1575;&#1578; &#1705;&#1604; &#1705;&#1575;&#1585;&#1705;&#1606;&#1575;&#1606;';
		$e -> form = $a -> run();
		$e -> run();
	}

	public function all() {$d = CUrl::segment(3);
		$f = CUrl::segment(4);
		if (empty($f) || empty($d))
			CUrl::redirect('p_p/index2');
		$g = new CJcalendar;
		if (CUrl::segment(5) === 'print')
			$h = TRUE;
		$i = $g -> mktime(0, 0, 0, 1, 1, $f);
		if ($g -> isLeap($f)) {$j = $g -> mktime(0, 0, 0, 12, 30, $f) + 3661;
		} else
			$j = $g -> mktime(0, 0, 0, 12, 29, $f) + 3661;
		$k = new CGrid;
		$l = "SELECT tbl_profile.name,tbl_profile.lastname,tbl_p_p.* FROM tbl_profile,tbl_p_p 
						WHERE tbl_profile.clerk_id=tbl_p_p.clerk_id AND tbl_p_p.type='$d' AND tbl_p_p.date_added BETWEEN $i AND $j";
		$m = new CDatabase;
		$k -> values = $m -> queryAll($l);
		$k -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'p_p/edit/$value->id/0/' . $f . '/' . $d => array('icon' => 'public/images/edit.png', 'alt' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'title' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;'), 'p_p/delete/$value->id/0/' . $f . '/' . $d => array('icon' => 'public/images/delete.png', 'alt' => '&#1581;&#1584;&#1601;', 'title' => '&#1581;&#1584;&#1601;', 'message' => '&#1608;&#1575;&#1602;&#1593;&#1575; &#1605;&#1740;&#8204;&#1582;&#1608;&#1575;&#1740; &#1581;&#1584;&#1601;&#1588; &#1705;&#1606;&#1740;&#1567;'));
		$k -> counter = TRUE;
		$k -> sort = 'date_added DESC';
		$k -> headers = array('name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'title', 'type' => array('format' => 'type[1:&#1578;&#1588;&#1608;&#1740;&#1602;,2:&#1578;&#1606;&#1576;&#1740;&#1607;]'), 'date_added' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1575;&#1580;&#1585;&#1575;'), 'set_by', 'hokm_number', 'description');
		$e = new CView;
		if ($d == 1)
			$n = '&#1711;&#1586;&#1575;&#1585;&#1588; &#1578;&#1588;&#1608;&#1740;&#1602;&#1575;&#1578; &#1705;&#1604; &#1705;&#1575;&#1585;&#1705;&#1606;&#1575;&#1606; &#1583;&#1585; &#1587;&#1575;&#1604; ' . $f;
		else
			$n = '&#1711;&#1586;&#1575;&#1585;&#1588; &#1578;&#1606;&#1576;&#1740;&#1607;&#1575;&#1578; &#1705;&#1604; &#1705;&#1575;&#1585;&#1705;&#1606;&#1575;&#1606; &#1583;&#1585; &#1587;&#1575;&#1604; ' . $f;
		if ($h) {$k -> operations = FALSE;
			$k -> noSort = TRUE;
			$e -> layout = 'print';
			$e -> ptitle = '<h1>' . $n . '</h1>';
			$o = new User;
			$e -> producer = $o -> producer();
			$k -> paginate = FALSE;
		} else {$e -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'p_p/all/' . $d . '/' . $f . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$e -> title = $n;
		$e -> grid = $k -> run();
		$e -> run();
	}

	public function add() {$c = CUrl::segment(3);
		$d = CUrl::segment(4);
		$e = new CView;
		if (!$c) {
			if (!$d) {$e -> error = '&#1605;&#1588;&#1705;&#1604;&#1740; &#1583;&#1585; &#1585;&#1608;&#1606;&#1583; &#1579;&#1576;&#1578; &#1662;&#1740;&#1588; &#1570;&#1605;&#1583;&#1607; &#1575;&#1587;&#1578;';
				$e -> run();
			}CUrl::redirect('p_p/index/add/' . $d);
		}
		if ($d == 1)
			$e -> title = '&#1579;&#1576;&#1578; &#1578;&#1588;&#1608;&#1740;&#1602; &#1576;&#1585;&#1575;&#1740; ' . Profile::getName($c);
		else {$e -> title = '&#1579;&#1576;&#1578; &#1578;&#1606;&#1576;&#1740;&#1607; &#1576;&#1585;&#1575;&#1740; ' . Profile::getName($c);
		}$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		if ($a -> validate()) {$g = new CJcalendar;
			$p = $g -> mktime(0, 0, 0, (int)$_POST['m_add'], (int)$_POST['d_add'], (int)$_POST['y_add']) + 14400;
			$m = new CDatabase;
			$m -> additional = array('clerk_id' => $c, 'date_added' => $p, 'type' => $d);
			$m -> insert();
			CUrl::redirect('p_p/summ/' . $c);
		}$e -> form = $a -> run();
		$e -> run();
	}

	public function summ() {$c = CUrl::segment(3);
		if (!$c)
			CUrl::redirect('p_p/index');
		$h = FALSE;
		if (CUrl::segment(4) === 'print')
			$h = TRUE;
		$k = new CGrid;
		$k -> condition = array('clerk_id' => $c);
		$k -> sort = 'date_added DESC';
		$k -> headers = array('title', 'type' => array('format' => 'type[1:&#1578;&#1588;&#1608;&#1740;&#1602;,2:&#1578;&#1606;&#1576;&#1740;&#1607;]'), 'date_added' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1575;&#1580;&#1585;&#1575;'), 'set_by', 'hokm_number', 'description');
		$k -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'p_p/edit/$value->id/' . $c => array('icon' => 'public/images/edit.png', 'alt' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'title' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;'), 'p_p/delete/$value->id/' . $c => array('icon' => 'public/images/delete.png', 'alt' => '&#1581;&#1584;&#1601;', 'title' => '&#1581;&#1584;&#1601;', 'message' => '&#1608;&#1575;&#1602;&#1593;&#1575; &#1605;&#1740;&#8204;&#1582;&#1608;&#1575;&#1740; &#1581;&#1584;&#1601;&#1588; &#1705;&#1606;&#1740;&#1567;'));
		if ($h) {$k -> operations = FALSE;
			$k -> noSort = TRUE;
			$k -> paginate = FALSE;
		}$e = new CView;
		$e -> grid = $k -> run();
		$e -> c_id = $c;
		$e -> title = '&#1578;&#1588;&#1608;&#1740;&#1602;&#1575;&#1578; &#1608; &#1578;&#1606;&#1576;&#1740;&#1607;&#1575;&#1578; ' . Profile::getName($c);
		$e -> print = $h;
		if ($h) {$e -> layout = 'print';
			$e -> ptitle = '<h1>&#1578;&#1588;&#1608;&#1740;&#1602;&#1575;&#1578; &#1608; &#1578;&#1606;&#1576;&#1740;&#1607;&#1575;&#1578; ' . Profile::getName($c) . '</h1>';
			$o = new User;
			$e -> producer = $o -> producer();
		} else {$e -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'p_p/summ/' . $c . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$e -> run('p_p/summ');
	}

	public function edit() {$q = CUrl::segment(3);
		$r = CUrl::segment(4);
		$m = new CDatabase;
		if (($s = $m -> getByPk($q)) == FALSE) {CUrl::redirect(404);
		}$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		$g = new CJcalendar(FALSE);
		if ($a -> validate()) {$p = $g -> mktime(0, 0, 0, (int)$_POST['m_add'], (int)$_POST['d_add'], (int)$_POST['y_add']) + 14400;
			$m -> additional = array('date_added' => $p, );
			$m -> update(array('id' => $q));
			if ($r)
				CUrl::redirect('p_p/summ/' . $r);
			else {$t = CUrl::segment(5);
				CUrl::redirect('p_p/all/' . $t . '/' . CUrl::segment(6));
			}
		}$e = new CView;
		$e -> ms = $g -> date('m', $s -> date_added);
		$e -> ds = $g -> date('d', $s -> date_added);
		$e -> ys = $g -> date('Y', $s -> date_added);
		$e -> model = $s;
		$e -> form = $a -> run();
		$e -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1578;&#1588;&#1608;&#1740;&#1602;/&#1578;&#1606;&#1576;&#1740;&#1607; ' . Profile::getName($r);
		$e -> run();
	}

	public function delete() {$r = CUrl::segment(4);
		$m = new CDatabase;
		$m -> delete(array('id' => CUrl::segment(3)));
		if ($r)
			CUrl::redirect('p_p/summ/' . $r);
		else {CUrl::redirect('p_p/all/' . CUrl::segment(5) . '/' . CUrl::segment(6));
		}
	}

}
