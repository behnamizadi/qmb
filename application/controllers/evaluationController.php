<?php
class evaluationController {
	public function index() {$a = CUrl::segment(3);
		$b = new CView;
		$c = '';
		if ($a == 'add') {$b -> layout = 'jquery';
			$d = new CForm('addindex');
			$c = 'evaluation/index';
		} else {$e = TRUE;
			$d = new CForm('batchindex');
		}
		if (isset($_POST['submit'])) {
			if (!isset($e)) {$f = new Clerk;
				$g = $f -> getId($_POST['clerk_number']);
				if (!$g) {$d -> setError('clerk_number', '&#1585;&#1705;&#1608;&#1585;&#1583;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;.');
				}
			}
			if ($d -> validate()) {
				if ($a == 'add')
					CUrl::redirect('evaluation/add/' . $g . '/' . $_POST['year']);
				else {CUrl::redirect('evaluation/batch/' . $_POST['year']);
				}
			}
		}$h = new CJcalendar;
		$b -> y = $h -> date('Y', FALSE, FALSE);
		if ($a == 'add')
			$b -> title = '&#1579;&#1576;&#1578;/ &#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740;';
		else {$b -> title = '&#1579;&#1576;&#1578; &#1583;&#1587;&#1578;&#1607;&#8204;&#1575;&#1740; &#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740;';
		}$b -> form = $d -> run();
		$b -> run($c);
	}

	public function index2() {$d = new CForm;
		$d -> showFieldErrorText = FALSE;
		$b = new CView;
		if ($d -> validate()) {CUrl::redirect('evaluation/all/' . $_POST['year']);
		}$h = new CJcalendar;
		$b -> y = $h -> date('Y', FALSE, FALSE);
		$b -> form = $d -> run();
		$b -> title = '&#1711;&#1586;&#1575;&#1585;&#1588; &#1606;&#1605;&#1585;&#1575;&#1578; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; &#1705;&#1604; &#1705;&#1575;&#1585;&#1705;&#1606;&#1575;&#1606;';
		$b -> run();
	}

	public function all() {$i = CUrl::segment(3);
		if (!$i)
			CUrl::redirect('evaluation/index2');
		if (CUrl::segment(4) === 'print')
			$j = TRUE;
		$k = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_evaluation.grade FROM tbl_clerk,tbl_profile,tbl_evaluation 
		WHERE tbl_profile.clerk_id = tbl_evaluation.clerk_id AND tbl_clerk.id=tbl_profile.clerk_id AND tbl_evaluation.year='$i' ORDER BY tbl_clerk.clerk_number";
		$l = new CDatabase;
		$m = new CGrid;
		$m -> values = $l -> queryAll($k);
		$m -> operations = FALSE;
		$m -> counter = TRUE;
		$m -> headers = array('clerk_number' => array('label' => '&#1705;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740;'), 'name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'grade' => array('label' => '&#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740;', 'onEmpty' => '-'), );
		$n = '&#1606;&#1605;&#1585;&#1575;&#1578; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; &#1607;&#1605;&#1705;&#1575;&#1585;&#1575;&#1606; &#1583;&#1585; &#1587;&#1575;&#1604; ' . $i;
		$b = new CView;
		if ($j) {$m -> operations = FALSE;
			$m -> noSort = TRUE;
			$m -> paginate = FALSE;
			$b -> layout = 'print2';
			$b -> ptitle = "<h1>$n</h1>";
			$o = new User;
			$b -> producer = $o -> producer();
		} else {$b -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'evaluation/all/' . $i . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$b -> grid = $m -> run();
		$b -> title = $n;
		$b -> run();
	}

	public function add() {$b = new CView;
		$p = CUrl::segment(3);
		$i = CUrl::segment(4);
		$b -> title = '&#1579;&#1576;&#1578; &#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; ' . Profile::getName($p) . ' &#1583;&#1585; &#1587;&#1575;&#1604; ' . $i;
		if (Evaluation::unique($p, $i) == FALSE) {CUrl::redirect('evaluation/edit/' . $p . '/' . $i);
		}$d = new CForm;
		if ($d -> validate()) {$l = new CDatabase;
			$l -> additional = array('clerk_id' => $p, 'year' => $i);
			$l -> insert();
			$b -> success = '&#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; &#1576;&#1575; &#1605;&#1608;&#1601;&#1602;&#1740;&#1578; &#1579;&#1576;&#1578; &#1588;&#1583;';
			$b -> run();
		}$b -> form = $d -> run();
		$b -> run();
	}

	public function edit() {$p = CUrl::segment(3);
		$i = CUrl::segment(4);
		$k = "SELECT * FROM tbl_evaluation WHERE clerk_id='$p' AND year='$i'";
		$l = new CDatabase;
		if (($q = $l -> queryOne($k)) == FALSE) {CUrl::redirect(404);
		}$b = new CView;
		$b -> title = '&#1579;&#1576;&#1578; &#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; ' . Profile::getName($p) . ' &#1583;&#1585; &#1587;&#1575;&#1604; ' . $i;
		$d = new CForm;
		if ($d -> validate()) {$l = new CDatabase;
			$l -> update(array('clerk_id' => $p, 'year' => $i), array('grade' => $_POST['grade']));
			$b -> success = '&#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; &#1576;&#1575; &#1605;&#1608;&#1601;&#1602;&#1740;&#1578; &#1579;&#1576;&#1578; &#1588;&#1583;';
			$b -> run();
		}$b -> model = $q;
		$b -> form = $d -> run();
		$b -> run();
	}

	public function batch() {$i = CUrl::segment(3);
		$l = new CDatabase;
		$h = new CJcalendar(FALSE);
		$r = $h -> mktime(0, 0, 0, 1, 1, $i + 1) - 86400;
		$k = "SELECT tbl_clerk.*,tbl_profile.name,tbl_profile.lastname,tbl_employment.clerk_id FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id AND tbl_employment.date_employed <= $r ORDER BY tbl_clerk.clerk_number";
		$s = $l -> queryAll($k);
		$b = new CView;
		$b -> title = "&#1579;&#1576;&#1578; &#1606;&#1605;&#1585;&#1607; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; &#1583;&#1587;&#1578;&#1607;&#8204;&#1575;&#1740; &#1587;&#1575;&#1604; $i";
		if (isset($_POST['submit'])) {
			foreach ($s as $f) {
				if (!empty($_POST[$f -> id])) {
					if (Evaluation::unique($f -> id, $i) == FALSE) {$l -> update(array('clerk_id' => $f -> id, 'year' => $i), array('grade' => $_POST[$f -> id]));
					} else {$l -> insert(array('clerk_id' => $f -> id, 'year' => $i, 'grade' => $_POST[$f -> id]));
					}
				}
			}$b -> success = '&#1606;&#1605;&#1585;&#1575;&#1578; &#1575;&#1585;&#1586;&#1588;&#1740;&#1575;&#1576;&#1740; &#1576;&#1575; &#1605;&#1608;&#1601;&#1602;&#1740;&#1578; &#1579;&#1576;&#1578; &#1588;&#1583;';
			$b -> run();
		}$b -> clerks = $s;
		$b -> run('evaluation/batch');
	}

}
