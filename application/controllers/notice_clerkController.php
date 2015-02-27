<?php
class notice_clerkController {
	public function index() {$a = new CForm;
		if (isset($_POST['submit'])) {$b = new Clerk;
			$c = $b -> getId($_POST['clerk_number']);
			if (!$c) {$a -> setError('clerk_number', '&#1585;&#1705;&#1608;&#1585;&#1583;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;.');
			}$d = new CDatabase;
			$e = 'SELECT COUNT(*) FROM tbl_notice_clerk WHERE clerk_id=\'' . $c . '\'';
			if ($d -> countRows($e)) {$a -> setError('clerk_number', '&#1602;&#1576;&#1604;&#1575; &#1576;&#1585;&#1575;&#1740; &#1575;&#1740;&#1606; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1575;&#1582;&#1591;&#1575;&#1585; &#1578;&#1605;&#1583;&#1740;&#1583; &#1602;&#1585;&#1575;&#1585;&#1583;&#1575;&#1583; &#1579;&#1576;&#1578; &#1588;&#1583;&#1607; &#1575;&#1587;&#1578;.');
			}
			if ($a -> validate() == TRUE) {CUrl::redirect('notice_clerk/add/' . $c);
			}
		}$f = new CView;
		$f -> title = '&#1579;&#1576;&#1578; &#1575;&#1582;&#1591;&#1575;&#1585; &#1602;&#1585;&#1575;&#1585;&#1583;&#1575;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
		$f -> layout = 'jquery';
		$f -> form = $a -> run();
		$f -> run('clerk/edit');
	}

	public function add() {$g = CUrl::segment(3);
		if (!$g) {CUrl::redirect('notice_clerk/index');
		}$a = new CForm;
		if ($a -> validate()) {$d = new CDatabase;
			$h = new CJcalendar;
			$i = $h -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
			$d -> additional = array('clerk_id' => $g, 'date_end' => $i);
			$d -> insert();
			CUrl::redirect('notice_clerk/manage');
		}$f = new CView;
		$f -> title = '&#1579;&#1576;&#1578; &#1575;&#1582;&#1591;&#1575;&#1585; &#1602;&#1585;&#1575;&#1585;&#1583;&#1575;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; - ' . Profile::getName($g);
		$f -> form = $a -> run();
		$f -> run();
	}

	public function manage() {
		if (CUrl::segment(3) === 'print')
			$j = TRUE;
		$e = "SELECT tbl_notice_clerk.clerk_id,tbl_notice_clerk.post,tbl_notice_clerk.place,tbl_notice_clerk.date_end,tbl_profile.name,tbl_profile.lastname FROM tbl_notice_clerk,tbl_profile WHERE tbl_notice_clerk.clerk_id=tbl_profile.clerk_id";
		$d = new CDatabase;
		$k = new CGrid;
		$k -> values = $d -> queryAll($e);
		$k -> headers = array('name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'post' => array('format' => 'model[Lookup,getById($value,notice_post)]', 'label' => '&#1662;&#1587;&#1578; &#1587;&#1575;&#1586;&#1605;&#1575;&#1606;&#1740;'), 'place' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => '&#1605;&#1581;&#1604; &#1582;&#1583;&#1605;&#1578;'), 'date_end' => array('format' => 'model[Cal,getDate($value)]'), );
		$k -> operations['view'] = FALSE;
		$k -> sort = 'date_end';
		$k -> counter = TRUE;
		$f = new CView;
		$l = '&#1604;&#1740;&#1587;&#1578; &#1575;&#1582;&#1591;&#1575;&#1585; &#1602;&#1585;&#1575;&#1585;&#1583;&#1575;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
		if ($j) {$k -> operations = FALSE;
			$k -> noSort = TRUE;
			$f -> layout = 'print';
			$f -> ptitle = '<h1>' . $l . '</h1>';
			$m = new User;
			$f -> producer = $m -> producer();
			$k -> paginate = FALSE;
		} else {$f -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'notice_clerk/manage/print', 'class="box" target="_blank"') . '</p></center>';
		}$f -> title = $l;
		$f -> grid = $k -> run();
		$f -> run();
	}

	public function edit() {$g = CUrl::segment(3);
		$d = new CDatabase;
		if (($n = $d -> getByPk($g)) == FALSE)
			CUrl::redirect(404);
		$f = new CView;
		$f -> model = $n;
		$h = new CJcalendar(FALSE);
		$f -> m = $h -> date('m', $n -> date_end);
		$f -> d = $h -> date('d', $n -> date_end);
		$f -> y = $h -> date('Y', $n -> date_end);
		$a = new CForm;
		if ($a -> validate()) {$d = new CDatabase;
			$h = new CJcalendar;
			$i = $h -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
			$d -> additional = array('date_end' => $i);
			$d -> update(array('clerk_id' => $g));
			CUrl::redirect('notice_clerk/manage');
		}$f = new CView;
		$f -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1582;&#1591;&#1575;&#1585; &#1602;&#1585;&#1575;&#1585;&#1583;&#1575;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; - ' . Profile::getName($g);
		$f -> form = $a -> run();
		$f -> run();
	}

	public function delete() {$d = new CDatabase;
		$d -> delete(array('clerk_id' => CUrl::segment(3)));
		CUrl::redirect('notice_clerk/manage');
	}

}
