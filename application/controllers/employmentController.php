<?php
class employmentController {
	public function add() {$a = CUrl::segment(3);
		$b = 'SELECT COUNT(*) FROM tbl_employment WHERE clerk_id=\'' . $a . '\'';
		$c = new CDatabase;
		if ($c -> countRows($b))
			CUrl::redirect('employment/edit/' . $a);
		$d = CUrl::segment(4);
		$e = new CView;
		if (Clerk::doesExist($a, $d)) {$f = new CForm;
			$f -> type = 'multipart/form-data';
			$f -> showFieldErrorText = FALSE;
			$g = new CValidator;
			if ($g -> unique('tbl_employment', 'clerk_id', $a) === FALSE) {$e -> error = '&#1576;&#1585;&#1575;&#1740; &#1575;&#1740;&#1606; &#1705;&#1583; &#1602;&#1576;&#1604;&#1575; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1587;&#1575;&#1576;&#1602;&#1607; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1588;&#1594;&#1604;&#1740; &#1608;&#1575;&#1585;&#1583; &#1588;&#1583;&#1607; &#1575;&#1587;&#1578;. &#1576;&#1585;&#1575;&#1740; &#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1587;&#1575;&#1576;&#1602;&#1607; &#1588;&#1594;&#1604;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1605;&#1584;&#1705;&#1608;&#1585; &#1585;&#1608;&#1740; &#1575;&#1740;&#1606; ' . CUrl::createLink('&#1604;&#1740;&#1606;&#1705;', 'employment/edit/' . $a) . '&#8204; &#1705;&#1604;&#1740;&#1705; &#1705;&#1606;&#1740;&#1583;';
				$e -> run();
			}
			if (isset($_POST['submit'])) {$h = new CUpload;
				$h -> allowedType = array('gif', 'jpeg', 'jpg', 'png', 'jpe', 'pjpeg', 'JPG', 'JPEG', 'GIF', 'PNG', 'JPE', 'PJPEG');
				$h -> maxSize = 52224;
				if ($h -> run('picture') === FALSE) {
					if ($h -> errorType == CUpload::EXT) {$f -> setError('picture', '&#1601;&#1585;&#1605;&#1578; &#1607;&#1575;&#1740; &#1605;&#1580;&#1575;&#1586; jpg&#1548;png&#1548;gif &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1606;&#1583;.');
					} elseif ($h -> errorType == CUpload::MAX_SIZE) {$f -> setError('picture', '&#1581;&#1583;&#1575;&#1705;&#1579;&#1585; &#1575;&#1606;&#1583;&#1575;&#1586;&#1607; &#1593;&#1705;&#1587;&#1548; &#1781;&#1776; &#1705;&#1740;&#1604;&#1608;&#1576;&#1575;&#1740;&#1578; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583;.');
					} else {$f -> setError('picture', $h -> errorMessage);
					}
				} else {$i = $a . '_' . CGeneral::generateRandom(3) . '.' . $h -> extension;
					if (!$h -> saveAs(ROOT . 'pics/' . $i)) {$f -> setError('picture', '&#1605;&#1588;&#1705;&#1604;&#1740; &#1583;&#1585; &#1570;&#1662;&#1604;&#1608;&#1583; &#1601;&#1575;&#1740;&#1604; &#1662;&#1740;&#1588; &#1570;&#1605;&#1583;&#1607; &#1575;&#1587;&#1578;.');
					}
				}
				if ($f -> validate() === TRUE && empty($j)) {$c = new CDatabase;
					$k = new CJcalendar;
					$l = $k -> mktime(0, 0, 0, (int)$_POST['m_employed'], (int)$_POST['d_employed'], (int)$_POST['y_employed']) + 14400;
					$c -> additional = array('date_employed' => $l, 'picture' => $i, 'date_retired' => 0, 'clerk_id' => $a);
					$c -> insert();
					CUrl::redirect('education/add/' . $a . '/' . $d);
				}
			}$e -> title = '&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1662;&#1575;&#1740;&#1607;&#8204;&#1575;&#1740; &#1588;&#1594;&#1604; ' . Profile::getName($a);
			$e -> form = $f -> run();
			$e -> run('employment/add');
		} else {$e -> error = '&#1605;&#1588;&#1705;&#1604;&#1740; &#1583;&#1585; &#1601;&#1585;&#1575;&#1740;&#1606;&#1583; &#1579;&#1576;&#1578; &#1576;&#1607; &#1608;&#1580;&#1608;&#1583; &#1570;&#1605;&#1583;&#1607; &#1575;&#1587;&#1578;.';
			$e -> run();
		}
	}

	public function edit() {$a = CUrl::segment(3);
		$c = new CDatabase;
		if (($m = $c -> getByPk($a)) == FALSE)
			CUrl::redirect(404);
		$e = new CView;
		$e -> model = $m;
		$k = new CJcalendar(FALSE);
		$e -> m = $k -> date('m', $m -> date_employed);
		$e -> d = $k -> date('d', $m -> date_employed);
		$e -> y = $k -> date('Y', $m -> date_employed);
		$n = new Clerk;
		$e -> clerk_number = $n -> getClerkNumber($a);
		$f = new CForm;
		$f -> dontClose = TRUE;
		$f -> showFieldErrorText = FALSE;
		$f -> type = 'multipart/form-data';
		$i = Employment::getPicture($a);
		if (isset($_POST['submit'])) {$h = new CUpload;
			$h -> allowedType = array('gif', 'jpeg', 'jpg', 'png', 'jpe', 'pjpeg');
			$h -> maxSize = 52224;
			if ($h -> run('picture', FALSE) === FALSE) {
				if ($h -> errorType == CUpload::EXT) {$f -> setError('picture', '&#1601;&#1585;&#1605;&#1578; &#1607;&#1575;&#1740; &#1605;&#1580;&#1575;&#1586; jpg&#1548;png&#1548;gif &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1606;&#1583;.');
				} elseif ($h -> errorType == CUpload::MAX_SIZE) {$f -> setError('picture', '&#1581;&#1583;&#1575;&#1705;&#1579;&#1585; &#1575;&#1606;&#1583;&#1575;&#1586;&#1607; &#1593;&#1705;&#1587;&#1548; &#1781;&#1776; &#1705;&#1740;&#1604;&#1608;&#1576;&#1575;&#1740;&#1578; &#1605;&#1740;&#8204;&#1576;&#1575;&#1588;&#1583;.');
				} else {$f -> setError('picture', $h -> errorMessage);
				}
			} elseif ($h -> error == UPLOAD_ERR_OK) {$i = $a . '_' . CGeneral::generateRandom(3) . '.' . $h -> extension;
				if (!$h -> saveAs(ROOT . 'pics/' . $i)) {$f -> setError('picture', '&#1605;&#1588;&#1705;&#1604;&#1740; &#1583;&#1585; &#1570;&#1662;&#1604;&#1608;&#1583; &#1601;&#1575;&#1740;&#1604; &#1662;&#1740;&#1588; &#1570;&#1605;&#1583;&#1607; &#1575;&#1587;&#1578;.');
				}
			}
			if ($f -> validate() === TRUE) {$k = new CJcalendar;
				$l = $k -> mktime(0, 0, 0, (int)$_POST['m_employed'], (int)$_POST['d_employed'], (int)$_POST['y_employed']);
				$c -> additional = array('date_employed' => $l, 'picture' => $i);
				$c -> update(array('clerk_id' => $a));
				$c -> setTbl('tbl_clerk');
				$c -> update(array('id' => $a), array('clerk_number' => $_POST['clerk_number']));
				CUrl::redirect('clerk/manage');
			}
		}$e -> form = $f;
		$e -> clerk_id = $a;
		$e -> fileName = $i;
		$e -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1588;&#1594;&#1604;&#1740; ' . Profile::getName($a);
		$e -> run('employment/edit');
	}

	public function bimeh() {$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.bimeh 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
		$o = new CGrid;
		$o -> counter = TRUE;
		$o -> operations = FALSE;
		$o -> headers = array('clerk_number' => array('label' => '&#1705;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740;'), 'name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'bimeh' => array('label' => '&#1588;&#1605;&#1575;&#1585;&#1607; &#1576;&#1740;&#1605;&#1607;'), );
		$c = new CDatabase;
		$o -> values = $c -> queryAll($b);
		$e = new CView;
		$e -> grid = $o -> run();
		$e -> title = '&#1588;&#1605;&#1575;&#1585;&#1607; &#1576;&#1740;&#1605;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1575;&#1606;';
		$e -> run();
	}

	public function date_employed() {$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.date_employed 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
		$o = new CGrid;
		$o -> counter = TRUE;
		$o -> operations = FALSE;
		$o -> headers = array('clerk_number' => array('label' => '&#1705;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740;'), 'name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'date_employed' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1575;&#1587;&#1578;&#1582;&#1583;&#1575;&#1605;'), );
		$c = new CDatabase;
		$o -> values = $c -> queryAll($b);
		$e = new CView;
		$e -> grid = $o -> run();
		$e -> title = '&#1578;&#1575;&#1585;&#1740;&#1582; &#1575;&#1587;&#1578;&#1582;&#1583;&#1575;&#1605; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1575;&#1606;';
		$e -> run();
	}

	public function hesab() {
		$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.hesab 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
		$o = new CGrid;
		$o -> counter = TRUE;
		$o -> operations = FALSE;
		$o -> headers = array('clerk_number' => array('label' => '&#1705;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740;'), 'name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'hesab' => array('label' => '&#1588;&#1605;&#1575;&#1585;&#1607; &#1581;&#1587;&#1575;&#1576;'), );
		$c = new CDatabase;
		$o -> values = $c -> queryAll($b);
		$e = new CView;
		$e -> grid = $o -> run();
		$e -> title = '&#1588;&#1605;&#1575;&#1585;&#1607; &#1581;&#1587;&#1575;&#1576; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1575;&#1606;';
		$e -> run();
	}

	public function bon() {$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.bon 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
		$o = new CGrid;
		$o -> counter = TRUE;
		$o -> operations = FALSE;
		$o -> headers = array('clerk_number' => array('label' => '&#1705;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740;'), 'name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'bon' => array('label' => '&#1588;&#1605;&#1575;&#1585;&#1607; &#1576;&#1606;&#8204;&#1705;&#1575;&#1585;&#1578;'), );
		$c = new CDatabase;
		$o -> values = $c -> queryAll($b);
		$e = new CView;
		$e -> grid = $o -> run();
		$e -> title = '&#1588;&#1605;&#1575;&#1585;&#1607; &#1576;&#1606;&#8204;&#1705;&#1575;&#1585;&#1578; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1575;&#1606;';
		$e -> run();
	}

	public function mixed() {$p = FALSE;
		if (CUrl::segment(3) === 'print')
			$p = TRUE;
		$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.bon,tbl_employment.hesab,tbl_employment.date_employed,tbl_employment.bimeh 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
		$o = new CGrid;
		$o -> counter = TRUE;
		$o -> operations = FALSE;
		$o -> headers = array('name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'clerk_number' => array('label' => '&#1705;&#1583; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740;'), 'date_employed' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1575;&#1587;&#1578;&#1582;&#1583;&#1575;&#1605;'), 'hesab' => array('label' => '&#1588;&#1605;&#1575;&#1585;&#1607; &#1581;&#1587;&#1575;&#1576;'), 'bon' => array('label' => '&#1588;&#1605;&#1575;&#1585;&#1607; &#1576;&#1606;&#8204;&#1705;&#1575;&#1585;&#1578;'), 'bimeh' => array('label' => '&#1588;&#1605;&#1575;&#1585;&#1607; &#1576;&#1740;&#1605;&#1607;'), );
		$c = new CDatabase;
		$o -> values = $c -> queryAll($b);
		$e = new CView;
		$q = '&#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1705;&#1604;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1575;&#1606;';
		$e -> title = $q;
		if ($p) {$o -> operations = FALSE;
			$o -> noSort = TRUE;
			$o -> paginate = FALSE;
			$e -> layout = 'print2';
			$e -> ptitle = "<h1>$q</h1>";
			$r = new User;
			$e -> producer = $r -> producer();
		} else {$e -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'employment/mixed/print', 'class="box" target="_blank"') . '</p></center>';
		}$e -> grid = $o -> run();
		$e -> run();
	}

}
