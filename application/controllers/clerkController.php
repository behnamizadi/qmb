<?php
class clerkController {
	public function add() {$a = new CForm;
		$b = new CView;
		if (isset($_POST['submit'])) {$c = new Clerk;
			if (($d = $c -> getId($_POST['clerk_number'])) !== FALSE) {$a -> setError('clerk_number', '&#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1602;&#1576;&#1604;&#1575; &#1579;&#1576;&#1578; &#1588;&#1583;&#1607; &#1575;&#1587;&#1578;.');
				$b -> error = '<div class="red">&#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1602;&#1576;&#1604;&#1575; &#1579;&#1576;&#1578; &#1588;&#1583;&#1607; &#1575;&#1587;&#1578;.&#1576;&#1585;&#1575;&#1740; &#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1740;&#1575; &#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1575;&#1590;&#1575;&#1601;&#1740; &#1576;&#1607; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1575;&#1740;&#1606; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583; &#1604;&#1591;&#1601;&#1575; <a href="' . CUrl::createUrl('clerk/edit/' . $d) . '">&#1585;&#1608;&#1740; &#1575;&#1740;&#1606; &#1604;&#1740;&#1606;&#1705;</a> &#1705;&#1604;&#1740;&#1705; &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.</div>';
			}
			if ($a -> validate() === TRUE) {$e = new CDatabase;
				$f = time();
				$e -> additional = array('time_added' => $f);
				$e -> insert();
				CUrl::redirect('profile/add/' . $e -> lastId() . '/' . $f . '/');
			}
		}$b -> title = '&#1579;&#1576;&#1578; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
		$b -> frun = $a -> run();
		$b -> run('clerk/add');
	}

	public function manage() {$g = new CGrid;
		$h = FALSE;
		if (CUrl::segment(3) === 'print')
			$h = TRUE;
		$j = "SELECT MAX(tbl_carrier.start),tbl_clerk.id,tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_profile.mobile,tbl_profile.sex,tbl_carrier.employment_status,tbl_carrier.job_status,tbl_carrier.clerk_id 
		FROM tbl_clerk,tbl_profile,tbl_carrier WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_carrier.clerk_id AND tbl_carrier.now_c='1' GROUP BY tbl_carrier.clerk_id ORDER BY tbl_carrier.job_status,tbl_clerk.clerk_number";
		$e = new CDatabase;
		$g -> values = $e -> queryAll($j);
		$g -> operations = array('edit' => FALSE);
		$g -> counter = TRUE;
		$g -> headers = array('clerk_number', 'name' => array('label' => '&#1606;&#1575;&#1605;'), 'lastname' => array('label' => '&#1606;&#1575;&#1605; &#1582;&#1575;&#1606;&#1608;&#1575;&#1583;&#1711;&#1740;'), 'mobile' => array('label' => '&#1605;&#1608;&#1576;&#1575;&#1740;&#1604;'), 'employment_status' => array('format' => 'model[Lookup,getById($value,employment_status)]', 'label' => '&#1608;&#1590;&#1593;&#1740;&#1578; &#1575;&#1587;&#1578;&#1582;&#1583;&#1575;&#1605;'), 'job_status' => array('format' => 'model[Lookup,getById($value,job_status)]', 'label' => '&#1608;&#1590;&#1593;&#1740;&#1578; &#1575;&#1588;&#1578;&#1594;&#1575;&#1604;'), 'sex' => array('format' => 'type[1:&#1605;&#1585;&#1583;,2:&#1586;&#1606;]', 'label' => '&#1580;&#1606;&#1587;&#1740;&#1578;'));
		$b = new CView;
		$k = '&#1604;&#1740;&#1587;&#1578; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1575;&#1606;';
		if ($h) {$g -> operations = FALSE;
			$g -> noSort = TRUE;
			$g -> paginate = FALSE;
			$b -> layout = 'print2';
			$b -> ptitle = "<h1>$k</h1>";
			$l = new User;
			$b -> producer = $l -> producer();
		} else {$b -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'clerk/manage/print', 'class="box" target="_blank"') . '</p></center>';
		}$b -> grid = $g -> run();
		$b -> title = $k;
		$b -> run();
	}

	public function edit() {$m = CUrl::segment(3);
		$b = new CView;
		switch($m) {case  'profile' :
				$b -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1605;&#1588;&#1582;&#1589;&#1575;&#1578; &#1601;&#1585;&#1583;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
				break;
			case  'spouse' :
				$b -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1601;&#1585;&#1575;&#1583; &#1578;&#1581;&#1578; &#1578;&#1705;&#1601;&#1604; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
				break;
			case  'employment' :
				$b -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1662;&#1575;&#1740;&#1607;&#8204;&#1575;&#1740; &#1588;&#1594;&#1604; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
				break;
			case  'education' :
				$b -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
				break;
			default :
				$b -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
		}
		if (is_numeric($m)) {$b -> clerk_id = $m;
			$j = "SELECT time_added FROM tbl_clerk WHERE id='$m'";
			$e = new CDatabase;
			$b -> time_added = $e -> queryOne($j) -> time_added;
			$b -> run('clerk/edit2');
		}$a = new CForm;
		if (isset($_POST['submit'])) {$c = new Clerk;
			$n = $c -> getId($_POST['clerk_number']);
			if (!$n) {$a -> setError('clerk_number', '&#1585;&#1705;&#1608;&#1585;&#1583;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;.');
			}
			if ($a -> validate() == TRUE) {
				switch($m) {case  'profile' :
						CUrl::redirect('profile/edit/' . $n);
						break;
					case  'spouse' :
						CUrl::redirect('spouse/edit/' . $n);
						break;
					case  'employment' :
						CUrl::redirect('employment/edit/' . $n);
						break;
					case  'education' :
						CUrl::redirect('education/manage/' . $n);
						break;
					default :
						$b -> clerk_id = $n;
						$j = "SELECT time_added FROM tbl_clerk WHERE id='$n'";
						$e = new CDatabase;
						$b -> time_added = $e -> queryOne($j) -> time_added;
						$b -> run('clerk/edit2');
				}
			}
		}$b -> form = $a -> run();
		$b -> layout = 'jquery';
		$b -> run('clerk/edit');
	}

	public function view() {$d = CUrl::segment(3);
		if (!$d)
			CUrl::redirect('clerk/manage');
		$e = new CDatabase;
		$p = new CJcalendar;
		$b = new CView;
		$q = "SELECT name,lastname,father,date_born,city_born,city_sodur,sh_sh,code_melli,takafol,married FROM tbl_profile WHERE clerk_id='$d'";
		$s = $e -> queryOne($q);
		$s -> date_born = $p -> date("Y/m/d", $s -> date_born);
		$t = "SELECT branch_id FROM tbl_carrier WHERE clerk_id='$d' AND end=0";
		$u = '';
		if (($v = $e -> queryOne($t)) !== FALSE) {$w = new Ostan;
			$x = $w -> getName();
			if ($v -> branch_id != 0) {$u = $x;
				$j = "SELECT name,city FROM tbl_branch WHERE code='$v->branch_id'";
				if (($y = $e -> queryOne($j)) !== FALSE) {$z = new Cities;
					$z = $z -> getById($y -> city);
					$u .= "- &#1588;&#1607;&#1585; $z- &#1588;&#1593;&#1576;&#1607; $y->name";
				}
			} else {$u = "&#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740; $x";
			}
		}$b -> jobPlace = $u;
		$c = new Clerk;
		$b -> clerk_number = $c -> getClerkNumber($d);
		if ($s -> married == 2)
			$b -> spouseJob = $e -> queryOne("SELECT job FROM tbl_spouse WHERE clerk_id='$d'") -> job;
		else
			$b -> spouseJob = '-';
		$aa = $e -> queryOne("SELECT date_employed,picture FROM tbl_employment WHERE clerk_id='$d'");
		$bb = $aa -> date_employed;
		$cc = $p -> difference($bb);
		$dd = '';
		if ($cc['year'] != 0)
			$dd .= $cc['year'] . ' &#1587;&#1575;&#1604; &#1608;';
		$dd .= $cc['month'] . ' &#1605;&#1575;&#1607; &#1608;';
		$dd .= $cc['day'] . ' &#1585;&#1608;&#1586;';
		$b -> timeEmployed = $dd;
		$b -> dateEmployed = $p -> date('Y/m/d', $bb);
		$b -> picture = $aa -> picture;
		$g = new CGrid;
		$g -> noSort = array('study_degree', 'study_field', 'date_get', 'place');
		$g -> table = 'tbl_education';
		$g -> headers = array('study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]', 'label' => '&#1605;&#1583;&#1585;&#1705; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740;'), 'study_field' => array('format' => 'model[StudyField,getById($value)]', 'label' => '&#1585;&#1588;&#1578;&#1607; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740;'), 'date_get' => array('format' => 'model[Cal,getDate($value,Y)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1575;&#1582;&#1584; &#1605;&#1583;&#1585;&#1705;'), 'place' => array('label' => '&#1605;&#1581;&#1604; &#1578;&#1581;&#1589;&#1740;&#1604;'));
		$g -> operations = FALSE;
		$g -> condition = array('clerk_id' => $d);
		$b -> education = $g -> run();
		$g -> table = 'tbl_carrier';
		$g -> headers = array('hokm_type' => array('format' => 'model[Lookup,getById($value,hokm_type)]', 'label' => '&#1606;&#1608;&#1593; &#1581;&#1705;&#1605;'), 'post' => array('format' => 'model[Lookup,getById($value,post)]', 'label' => '&#1662;&#1587;&#1578; &#1587;&#1575;&#1586;&#1605;&#1575;&#1606;&#1740;'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => '&#1605;&#1581;&#1604; &#1582;&#1583;&#1605;&#1578;'), 'start' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1588;&#1585;&#1608;&#1593;'), 'end' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1662;&#1575;&#1740;&#1575;&#1606;'), 'emtiaz_shoghl' => array('label' => '&#1575;&#1605;&#1578;&#1740;&#1575;&#1586; &#1588;&#1594;&#1604;'), );
		$g -> sort = 'start';
		$g -> noSort = array('hokm_type', 'post', 'branch_id', 'start', 'end', 'emtiaz_shoghl');
		$b -> carrier = $g -> run();
		$b -> profile = $s;
		$ee = $p -> date('Y', FALSE, FALSE) - 1;
		$ff = array();
		for ($gg = $ee - 3; $gg <= $ee; $gg++) {$j = "SELECT grade FROM tbl_evaluation WHERE clerk_id='$d' AND year='$gg'";
			$hh = $e -> queryOne($j);
			if ($hh)
				$ff[$gg] = $hh -> grade;
			else
				$ff[$gg] = '-';
		}$j = "SELECT COUNT(*) FROM tbl_training WHERE clerk_id='$d'";
		$b -> tCount = $e -> countRows($j);
		$j = "SELECT COUNT(*) FROM tbl_p_p WHERE clerk_id='$d' AND type='1'";
		$b -> p1Count = $e -> countRows($j);
		$j = "SELECT COUNT(*) FROM tbl_p_p WHERE clerk_id='$d' AND type='2'";
		$b -> p2Count = $e -> countRows($j);
		$b -> evResult = $ff;
		$b -> layout = 'clerkview';
		$l = new User;
		$b -> producer = $l -> producer();
		$b -> run();
	}

	public function search() {$ii = CUrl::segment(3);
		$h = FALSE;
		if (CUrl::segment(4) === 'print')
			$h = TRUE;
		if (!$ii)
			CUrl::redirect('clerk/index');
		$jj = new CDetail;
		$b = new CView;
		$e = new CDatabase;
		$e -> setTbl('tbl_profile');
		$s = $e -> getByPk($ii);
		if ($s) {$jj -> value = $s;
			$jj -> numberOfColumns = 4;
			$jj -> headers = array('name', 'lastname', 'father', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born', 'city_sodur', 'sh_sh', 'code_melli', 'religion', 'sex' => array('format' => 'type[1:&#1605;&#1585;&#1583;,2:&#1586;&#1606;]'), 'sarbazi' => array('format' => 'model[Lookup,getById($value,sarbazi)]'), 'married' => array('format' => 'type[1:&#1605;&#1580;&#1585;&#1583;,2:&#1605;&#1578;&#1575;&#1607;&#1604;]'), 'tel', 'mobile', 'father_tel', 'takafol', 'address', 'father_address');
			$b -> profile = $jj -> run();
		}
		if ($s -> married == 2) {$j = "SELECT * FROM tbl_spouse WHERE clerk_id='$ii'";
			$kk = $e -> queryOne($j);
			if ($kk) {$jj -> value = $kk;
				$jj -> numberOfColumns = 4;
				$jj -> headers = array('name', 'lastname', 'sh_sh', 'code_melli', 'father', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born', 'date_married' => array('format' => 'model[Cal,getDate($value)]'), 'study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]'), 'study_field' => array('format' => 'model[StudyField,getById($value)]'));
				$b -> spouse = $jj -> run();
			}
		}$e -> setTbl('tbl_employment');
		$aa = $e -> getByPk($ii);
		if ($aa) {$jj -> value = $aa;
			$jj -> numberOfColumns = 4;
			$jj -> headers = array('hesab', 'bon', 'bimeh', 'date_employed' => array('format' => 'model[Cal,getDate($value)]'), );
			$b -> employment = $jj -> run();
		}$j = "SELECT * FROM tbl_education WHERE clerk_id='$ii' ORDER BY date_get";
		$ll = $e -> queryAll($j);
		if ($ll) {$g = new CGrid;
			$g -> operations = FALSE;
			$g -> values = $ll;
			$g -> headers = array('study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]'), 'study_field' => array('format' => 'model[StudyField,getById($value)]'), 'date_get' => array('format' => 'model[Cal,getDate($value,Y)]'), 'place');
			if ($h) {$g -> noSort = array('study_degree', 'study_field', 'date_get', 'place');
			}$b -> education = $g -> run();
		}$j = "SELECT * FROM tbl_carrier WHERE clerk_id='$ii' ORDER BY start";
		$mm = $e -> queryAll($j);
		if ($mm) {$g = new CGrid;
			$g -> operations = FALSE;
			$g -> values = $mm;
			$g -> headers = array('hokm_type' => array('format' => 'model[Lookup,getById($value,hokm_type)]', 'label' => '&#1606;&#1608;&#1593; &#1581;&#1705;&#1605;'), 'post' => array('format' => 'model[Lookup,getById($value,post)]', 'label' => '&#1662;&#1587;&#1578; &#1587;&#1575;&#1586;&#1605;&#1575;&#1606;&#1740;'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => '&#1605;&#1581;&#1604; &#1582;&#1583;&#1605;&#1578;'), 'start' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1588;&#1585;&#1608;&#1593;'), 'end' => array('format' => 'model[Cal,getDate($value)]', 'label' => '&#1578;&#1575;&#1585;&#1740;&#1582; &#1662;&#1575;&#1740;&#1575;&#1606;'), 'emtiaz_shoghl' => array('label' => '&#1575;&#1605;&#1578;&#1740;&#1575;&#1586; &#1588;&#1594;&#1604;'), );
			if ($h) {$g -> noSort = array('hokm_type', 'post', 'branch_id', 'start', 'end', 'emtiaz_shoghl');
			}$b -> carrier = $g -> run();
		}$p = new CJcalendar;
		$ee = $p -> date('Y', FALSE, FALSE) - 1;
		$ff = array();
		for ($gg = $ee - 3; $gg <= $ee; $gg++) {$j = "SELECT grade FROM tbl_evaluation WHERE clerk_id='$ii' AND year='$gg'";
			$hh = $e -> queryOne($j);
			if ($hh)
				$ff[$gg] = $hh -> grade;
			else
				$ff[$gg] = '-';
		}$b -> evResult = $ff;
		if ($h) {$b -> layout = 'print2';
			$b -> ptitle = '<h1>&#1711;&#1586;&#1575;&#1585;&#1588; &#1580;&#1575;&#1605;&#1593; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; ' . Profile::getName($ii) . '</h1>';
			$l = new User;
			$b -> producer = $l -> producer();
		} else {$b -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'clerk/search/' . $ii . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$b -> title = '&#1711;&#1586;&#1575;&#1585;&#1588; &#1580;&#1575;&#1605;&#1593; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;: ' . Profile::getName($ii);
		$b -> run('clerk/search');
	}

	public function index() {$a = new CForm;
		$b = new CView;
		if (CUrl::segment(3) == 'view') {$b -> title = '&#1582;&#1604;&#1575;&#1589;&#1607; &#1608;&#1590;&#1593;&#1740;&#1578;';
		} else {$b -> title = '&#1711;&#1586;&#1575;&#1585;&#1588; &#1580;&#1575;&#1605;&#1593; &#1575;&#1591;&#1604;&#1575;&#1593;&#1575;&#1578; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;';
		}
		if (isset($_POST['submit'])) {$c = new Clerk;
			$n = $c -> getId($_POST['clerk_number']);
			if (!$n) {$a -> setError('clerk_number', '&#1585;&#1705;&#1608;&#1585;&#1583;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1588;&#1605;&#1575;&#1585;&#1607; &#1705;&#1575;&#1585;&#1605;&#1606;&#1583;&#1740; &#1608;&#1580;&#1608;&#1583; &#1606;&#1583;&#1575;&#1585;&#1583;.');
			}
			if ($a -> validate() == TRUE) {
				if (CUrl::segment(3) == 'view') {CUrl::redirect('clerk/view/' . $n);
				} else {CUrl::redirect('clerk/search/' . $n);
				}
			}
		}$b -> layout = 'jquery';
		$b -> form = $a -> run();
		$b -> run('clerk/index');
	}

	public function delete() {$d = CUrl::segment(3);
		$nn = array('id' => $d);
		$e = new CDatabase;
		$e -> delete($nn);
		$nn = "WHERE clerk_id='$d'";
		$e -> setTbl('tbl_profile');
		$e -> delete($nn);
		$e -> setTbl('tbl_spouse');
		$e -> delete($nn);
		$e -> setTbl('tbl_child');
		$e -> delete($nn);
		$e -> setTbl('tbl_employment');
		$e -> delete($nn);
		$e -> setTbl('tbl_profile');
		$e -> delete($nn);
		$e -> setTbl('tbl_education');
		$e -> delete($nn);
		$e -> setTbl('tbl_carrier');
		$e -> delete($nn);
		$e -> setTbl('tbl_p_p');
		$e -> delete($nn);
		$e -> setTbl('tbl_training');
		$e -> delete($nn);
		$e -> setTbl('tbl_vacation');
		$e -> delete($nn);
		$e -> setTbl('tbl_vacation_hour');
		$e -> delete($nn);
		CUrl::redirect('clerk/manage');
	}

}
