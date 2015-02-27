<?php
class childController {
	public function manage() {$a = CUrl::segment(3);
		$b = new CView;
		$c = new Profile;
		if ($c -> hasSpouse($a) == FALSE) {$b -> error = '&#1575;&#1740;&#1606; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1605;&#1580;&#1585;&#1583; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583; &#1740;&#1575; &#1578;&#1593;&#1583;&#1575;&#1583; &#1575;&#1601;&#1585;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1705;&#1601;&#1604; &#1589;&#1601;&#1585; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583;. &#1604;&#1591;&#1601;&#1575; &#1575;&#1576;&#1578;&#1583;&#1575; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1601;&#1585;&#1583;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1585;&#1575; ' . CUrl::createLink('&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'clerk/edit/profile') . ' &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.';
			$b -> run();
		}$b = new CView;
		$d = new CForm;
		$d -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if ($d -> validate()) {$_POST['error'] = 0;
				$e = new CJcalendar;
				$f = $e -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']);
				$g = new CDatabase;
				$h = "SELECT id FROM tbl_spouse WHERE clerk_id='$a'";
				$i = $g -> queryOne($h) -> id;
				$j = array('', $i, $a, $_POST['name'], $_POST['code_melli'], $f, $_POST['city_born']);
				$g -> insert($j);
			} else
				$_POST['error'] = 1;
		}$k = new CGrid;
		$k -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'child/edit/' . $a . '/$value->id' => array('icon' => 'public/images/edit.png', 'alt' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'title' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;'), 'child/delete/' . $a . '/$value->id' => array('icon' => 'public/images/delete.png', 'alt' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;', 'title' => '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588;'), );
		$k -> condition = array('clerk_id' => $a);
		$k -> headers = array('name', 'code_melli', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born');
		$b -> grid = $k -> run();
		$b -> layout = 'jquery';
		$b -> form = $d -> run();
		$b -> title = '&#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1601;&#1585;&#1586;&#1606;&#1583;&#1575;&#1606; ' . Profile::getName($a);
		$b -> run('child/manage');
	}

	public function delete() {$a = CUrl::segment(3);
		$l = CUrl::segment(4);
		$g = new CDatabase;
		$g -> delete(array('id' => $l));
		CUrl::redirect('child/manage/' . $a);
	}

	public function edit() {$a = CUrl::segment(3);
		$l = CUrl::segment(4);
		$g = new CDatabase;
		if (($m = $g -> getByPk($l)) == FALSE)
			CUrl::redirect(404);
		$b = new CView;
		$d = new CForm;
		$d -> showFieldErrorText = FALSE;
		$e = new CJcalendar(FALSE);
		if ($d -> validate()) {$f = $e -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
			$g -> additional = array('date_born' => $f);
			$g -> update(array('id' => $l));
			CUrl::redirect('child/manage/' . $a);
		}$b -> m = $e -> date('m', $m -> date_born);
		$b -> d = $e -> date('d', $m -> date_born);
		$b -> y = $e -> date('Y', $m -> date_born);
		$b -> model = $m;
		$b -> form = $d -> run();
		$b -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1601;&#1585;&#1586;&#1606;&#1583;';
		$b -> run();
	}

}
