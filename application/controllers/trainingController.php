<?php
class trainingController {
	public function index() {$a = CUrl::segment(3);
		$b = new CForm;
		if (isset($_POST['submit'])) {$c = new Clerk;
			$d = $c -> getId($_POST['clerk_number']);
			if (!$d) {$b -> setError('clerk_number', 'رکوردی با این کد پرسنلی وجود ندارد.');
			}
			if ($b -> validate() == TRUE) {
				if ($a == 'add')
					CUrl::redirect('training/add/' . $d);
				else
					CUrl::redirect('training/summ/' . $d);
			}
		}$e = new CView;
		if ($a == 'add')
			$e -> title = 'ثبت دوره آموزشی';
		else
			$e -> title = 'دوره‌های آموزشی گذرانده';
		$e -> form = $b -> run();
		$e -> run('clerk/edit');
	}

	public function index2() {$b = new CForm;
		if ($b -> validate() == TRUE) {
			if (CUrl::segment(3) == 2) {CUrl::redirect('training/notitle/' . $_POST['title']);
			} else
				CUrl::redirect('training/title/' . $_POST['title']);
		}$e = new CView;
		if (CUrl::segment(3) == 2)
			$e -> title = 'دوره‌های طی نشده توسط کارمند';
		else
			$e -> title = 'گزارش بر اساس عنوان دوره';
		$e -> form = $b -> run();
		$e -> run();
	}

	public function title() {$f = CUrl::segment(3);
		if (!$f)
			CUrl::redirect('training/index2');
		$g = FALSE;
		if (CUrl::segment(4) === 'print')
			$g = TRUE;
		$h = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_training.title,tbl_training.period,tbl_training.grade,tbl_training.place,tbl_training.date_start,tbl_carrier.branch_id
			FROM tbl_clerk,tbl_profile,tbl_training,tbl_carrier
			WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_training.clerk_id AND tbl_clerk.id=tbl_carrier.clerk_id AND tbl_training.title='$f' 
			GROUP BY tbl_carrier.clerk_id ORDER BY tbl_clerk.clerk_number";
		$i = new CDatabase;
		$j = $i -> queryAll($h);
		foreach ($j as $m => $n) {$j[$m] -> branch_id2 = $j[$m] -> branch_id;
		}$o = new CGrid;
		$o -> values = $j;
		$o -> counter = TRUE;
		$o -> operations = FALSE;
		$o -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'title' => array('format' => 'model[Lookup,getById($value,training)]'), 'period' => array('format' => ' ساعت'), 'grade', 'date_start' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ شروع'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => 'محل خدمت'), 'branch_id2' => array('format' => 'type[0:7800]', 'label' => 'کد محل خدمت'), );
		$e = new CView;
		$p = new Lookup;
		$q = $p -> getById($f, 'training');
		$r = 'گزارش بر اساس عنوان دوره: ' . $q;
		if ($g) {$o -> operations = FALSE;
			$o -> noSort = TRUE;
			$e -> layout = 'print';
			$e -> ptitle = '<h1>' . $r . '</h1>';
			$s = new User;
			$e -> producer = $s -> producer();
			$o -> paginate = FALSE;
		} else {$e -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'training/title/' . $f . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$e -> grid = $o -> run();
		$e -> title = $r;
		$e -> run();
	}

	public function notitle() {$f = CUrl::segment(3);
		if (!$f)
			CUrl::redirect('training/index2/2');
		if (CUrl::segment(4) === 'print')
			$g = TRUE;
		$h = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_carrier.branch_id,tbl_carrier.post,tbl_carrier.post
			FROM tbl_clerk,tbl_profile,tbl_carrier
			WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_carrier.clerk_id AND tbl_clerk.id NOT IN (SELECT clerk_id FROM tbl_training WHERE tbl_training.title='$f') AND tbl_carrier.now_c='1' AND tbl_carrier.hokm_type<>8 AND tbl_carrier.job_status =1
			GROUP BY tbl_carrier.clerk_id ORDER BY tbl_clerk.clerk_number";
		$i = new CDatabase;
		$j = $i -> queryAll($h);
		foreach ($j as $m => $n) {$j[$m] -> branch_id2 = $j[$m] -> branch_id;
		}$o = new CGrid;
		$o -> values = $j;
		$o -> counter = TRUE;
		$o -> operations = FALSE;
		$o -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => 'محل خدمت'), 'branch_id2' => array('format' => 'type[0:7800]', 'label' => 'کد محل خدمت'), 'post' => array('format' => 'model[Lookup,getById($value,post)]', 'label' => 'پست سازمانی'), );
		$e = new CView;
		$p = new Lookup;
		$q = $p -> getById($f, 'training');
		$r = 'گزارش دوره های طی نشده: ' . $q;
		if ($g) {$o -> operations = FALSE;
			$o -> noSort = TRUE;
			$e -> layout = 'print';
			$e -> ptitle = '<h1>' . $r . '</h1>';
			$s = new User;
			$e -> producer = $s -> producer();
			$o -> paginate = FALSE;
		} else {$e -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'training/notitle/' . $f . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$e -> grid = $o -> run();
		$e -> title = $r;
		$e -> run();
	}

	public function summ() {$d = CUrl::segment(3);
		if (!$d)
			CUrl::redirect('training/index');
		$g = FALSE;
		if (CUrl::segment(4) === 'print')
			$g = TRUE;
		$o = new CGrid;
		$o -> condition = array('clerk_id' => $d);
		$o -> sort = 'date_start DESC';
		$o -> headers = array('title' => array('format' => 'model[Lookup,getById($value,training)]'), 'code', 't_cat' => array('format' => 'model[Lookup,getById($value,t_cat)]'), 'date_start' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ شروع', 'onEmpty' => '-'), 'date_end' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ پایان', 'onEmpty' => '-'), 'period' => array('format' => ' ساعت', ), 'place', 'date_exam' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ آزمون', 'onEmpty' => '-'), 'grade', 'point', 'has_license' => array('format' => 'type[1:دارد,2:ندارد]'), 'is_passed' => array('format' => 'type[1:قبول,2:رد]'), 'description');
		$o -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'training/edit/$value->id/' . $d => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'training/delete/$value->id/' . $d => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف', 'message' => 'واقعا می‌خوای حذفش کنی؟'));
		if ($g) {$o -> operations = FALSE;
			$o -> noSort = TRUE;
		}$e = new CView;
		$e -> grid = $o -> run();
		$e -> c_id = $d;
		if ($g) {$e -> layout = 'print2';
			$e -> ptitle = '<h1>دوره‌های آموزشی ' . Profile::getName($d) . '</h1>';
			$s = new User;
			$e -> producer = $s -> producer();
		} else {$e -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'training/summ/' . $d . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$e -> title = 'دوره‌های آموزشی ' . Profile::getName($d);
		$e -> print = $g;
		$e -> run('training/summ');
	}

	public function add() {$t = CUrl::segment(3);
		if (!$t)
			CUrl::redirect('training/index');
		$b = new CForm;
		$b -> showFieldErrorText = FALSE;
		$e = new CView;
		if ($b -> validate() === TRUE) {$u = new CJcalendar;
			$v = $w = $x = 0;
			if (!empty($_POST['d_start']) && !empty($_POST['m_start']) && !empty($_POST['y_start']))
				$w = $u -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']) + 14400;
			if (!empty($_POST['d_end']) && !empty($_POST['m_end']) && !empty($_POST['y_end']))
				$x = $u -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
			if (!empty($_POST['d_exam']) && !empty($_POST['m_exam']) && !empty($_POST['y_exam']))
				$v = $u -> mktime(0, 0, 0, (int)$_POST['m_exam'], (int)$_POST['d_exam'], (int)$_POST['y_exam']) + 14400;
			$i = new CDatabase;
			$i -> additional = array('clerk_id' => $t, 'date_start' => $w, 'date_end' => $x, 'date_exam' => $v, );
			$i -> insert();
			CUrl::redirect('training/summ/' . $t);
		}$e = new CView;
		$e -> form = $b -> run();
		$e -> title = 'ثبت دوره ' . Profile::getName($t);
		$e -> run();
	}

	public function edit() {$y = CUrl::segment(3);
		$t = CUrl::segment(4);
		$i = new CDatabase;
		if (($z = $i -> getByPk($y)) == FALSE) {CUrl::redirect(404);
		}$b = new CForm;
		$b -> showFieldErrorText = FALSE;
		$u = new CJcalendar(FALSE);
		if ($b -> validate()) {$v = $w = $x = 0;
			if (!empty($_POST['d_start']) && !empty($_POST['m_start']) && !empty($_POST['y_start']))
				$w = $u -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']) + 14400;
			if (!empty($_POST['d_end']) && !empty($_POST['m_end']) && !empty($_POST['y_end']))
				$x = $u -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
			if (!empty($_POST['d_exam']) && !empty($_POST['m_exam']) && !empty($_POST['y_exam']))
				$v = $u -> mktime(0, 0, 0, (int)$_POST['m_exam'], (int)$_POST['d_exam'], (int)$_POST['y_exam']) + 14400;
			$i -> additional = array('date_start' => $w, 'date_end' => $x, 'date_exam' => $v);
			$i -> update(array('id' => $y));
			CUrl::redirect('training/summ/' . $t);
		}$e = new CView;
		if ($z -> date_start) {$e -> ms = $u -> date('m', $z -> date_start);
			$e -> ds = $u -> date('d', $z -> date_start);
			$e -> ys = $u -> date('Y', $z -> date_start);
		}
		if ($z -> date_end) {$e -> me = $u -> date('m', $z -> date_end);
			$e -> de = $u -> date('d', $z -> date_end);
			$e -> ye = $u -> date('Y', $z -> date_end);
		}
		if ($z -> date_exam) {$e -> mex = $u -> date('m', $z -> date_exam);
			$e -> dex = $u -> date('d', $z -> date_exam);
			$e -> yex = $u -> date('Y', $z -> date_exam);
		}$e -> model = $z;
		$e -> form = $b -> run();
		$e -> title = 'ویرایش دوره ' . Profile::getName($t);
		$e -> run();
	}

	public function delete() {$i = new CDatabase;
		$i -> delete(array('id' => CUrl::segment(3)));
		CUrl::redirect('training/summ/' . CUrl::segment(4));
	}

	public function search() {$b = new CForm;
		if (isset($_POST['submit'])) {
			if (!empty($_POST['d_start'])) {
				if (empty($_POST['m_start']))
					$b -> setError('m_start', 'e');
				if (empty($_POST['y_start']))
					$b -> setError('y_start', 'e');
			}
			if (!empty($_POST['m_start'])) {
				if (empty($_POST['y_start']))
					$b -> setError('y_start', 'e');
			}
			if (!empty($_POST['d_end'])) {
				if (empty($_POST['m_end']))
					$b -> setError('m_end', 'e');
				if (empty($_POST['y_end']))
					$b -> setError('y_end', 'e');
			}
			if (!empty($_POST['m_end'])) {
				if (empty($_POST['y_end']))
					$b -> setError('y_end', 'e');
			}
			if (!empty($_POST['d_exam'])) {
				if (empty($_POST['m_exam']))
					$b -> setError('m_exam', 'e');
				if (empty($_POST['y_exam']))
					$b -> setError('y_exam', 'e');
			}
			if (!empty($_POST['m_exam'])) {
				if (empty($_POST['y_exam']))
					$b -> setError('y_exam', 'e');
			}
			if ($b -> validate()) {$i = new CDatabase;
				$aa = array('title' => '', 'code' => '', 't_cat' => '', 'place' => '', 'has_license' => '', 'is_passed' => '');
				if (!empty($_POST['title'])) {$aa['title'] .= $_POST['title'];
				} else {unset($aa['title']);
				}
				if (!empty($_POST['code'])) {$aa['code'] .= $_POST['code'];
				} else {unset($aa['code']);
				}
				if (!empty($_POST['t_cat'])) {$aa['t_cat'] .= $_POST['t_cat'];
				} else {unset($aa['t_cat']);
				}
				if (!empty($_POST['place'])) {$aa['place'] .= $_POST['place'];
				} else {unset($aa['place']);
				}
				if (!empty($_POST['has_license'])) {$aa['has_license'] .= $_POST['has_license'];
				} else {unset($aa['has_license']);
				}
				if (!empty($_POST['is_passed'])) {$aa['is_passed'] .= $_POST['is_passed'];
				} else {unset($aa['is_passed']);
				}$u = new CJcalendar;
				$bb = empty($_POST['d_start']) ? 0 : $_POST['d_start'];
				$cc = empty($_POST['m_start']) ? 0 : $_POST['m_start'];
				$dd = empty($_POST['y_start']) ? 0 : $_POST['y_start'];
				if ($dd) {$ee = $u -> mktime(0, 0, 0, $cc, $bb, $dd);
					switch($_POST['start_range']) {case  'less' :
							$ee = $ee - 1;
							$ff = "date_start <= '$ee'";
							break;
						case  'more' :
							if ($cc <= 6)
								$ee = $ee + 31 * 86400 + 86400;
							else {$ee = $ee + 30 * 86400 + 86400;
							}$ff = "date_start >= '$ee'";
							break;
						case  'equal' :
							if ($bb != 0) {$gg = $ee + 24 * 60 * 60 - 1;
								$ff = "date_start Between $ee AND $gg";
							} elseif ($cc != 0) {
								if ($cc <= 6)
									$hh = $ee + 31 * 86400;
								else {$hh = $ee + 30 * 86400;
								}$ff = "date_start Between $ee AND $hh";
							} else {
								if ($u -> isLeap($dd) == 0) {$ii = $ee + 365 * 86400 + 86400;
								} else {$ii = $ee + 366 * 86400 + 86400;
								}$ff = "date_start Between $ee AND $ii";
							}
							break;
					}
				}$jj = empty($_POST['d_end']) ? 0 : $_POST['d_end'];
				$kk = empty($_POST['m_end']) ? 0 : $_POST['m_end'];
				$ll = empty($_POST['y_end']) ? 0 : $_POST['y_end'];
				if ($ll) {$mm = $u -> mktime(0, 0, 0, $kk, $jj, $ll);
					switch($_POST['end_range']) {case  'less' :
							$mm = $mm - 1;
							$nn = "date_end <= '$mm'";
							break;
						case  'more' :
							if ($kk <= 6)
								$mm = $mm + 31 * 86400 + 86400;
							else {$mm = $mm + 30 * 86400 + 86400;
							}$nn = "date_end >= '$mm'";
							break;
						case  'equal' :
							if ($jj != 0) {$gg = $mm + 24 * 60 * 60 - 1;
								$nn = "date_end Between $mm AND $gg";
							} elseif ($kk != 0) {
								if ($kk <= 6)
									$hh = $mm + 31 * 86400;
								else {$hh = $mm + 30 * 86400;
								}$nn = "date_end Between $mm AND $hh";
							} else {
								if ($u -> isLeap($ll) == 0) {$ii = $mm + 365 * 86400 + 86400;
								} else {$ii = $mm + 366 * 86400 + 86400;
								}$nn = "date_end Between $mm AND $ii";
							}
							break;
					}
				}$oo = empty($_POST['d_exam']) ? 0 : $_POST['d_exam'];
				$pp = empty($_POST['m_exam']) ? 0 : $_POST['m_exam'];
				$qq = empty($_POST['y_exam']) ? 0 : $_POST['y_exam'];
				if ($qq)
					if ($qq) {$rr = $u -> mktime(0, 0, 0, $pp, $oo, $qq);
						switch($_POST['exam_range']) {case  'less' :
								$rr = $rr - 1;
								$ss = "date_exam <= '$rr'";
								break;
							case  'more' :
								if ($pp <= 6)
									$rr = $rr + 31 * 86400 + 86400;
								else {$rr = $rr + 30 * 86400 + 86400;
								}$ss = "date_exam >= '$rr'";
								break;
							case  'equal' :
								if ($oo != 0) {$gg = $rr + 24 * 60 * 60 - 1;
									$ss = "date_exam Between $rr AND $gg";
								} elseif ($pp != 0) {
									if ($pp <= 6)
										$hh = $rr + 31 * 86400;
									else {$hh = $rr + 30 * 86400;
									}$ss = "date_exam Between $rr AND $hh";
								} else {
									if ($u -> isLeap($qq) == 0) {$ii = $rr + 365 * 86400 + 86400;
									} else {$ii = $rr + 366 * 86400 + 86400;
									}$ss = "date_exam Between $rr AND $ii";
								}
								break;
						}
					}
				if (!empty($_POST['period'])) {
					switch($_POST['period_range']) {case  "less" :
							$tt = 'period < ' . $i -> escape($_POST['period']);
							break;
						case  'more' :
							$tt = 'period > ' . $i -> escape($_POST['period']);
							break;
						case  'equal' :
							$tt = 'period = \'' . $i -> escape($_POST['period']) . '\'';
							break;
					}
				}
				if (!empty($_POST['grade'])) {
					switch($_POST['grade_range']) {case  "less" :
							$uu = 'grade < ' . $i -> escape($_POST['grade']);
							break;
						case  'more' :
							$uu = 'grade > ' . $i -> escape($_POST['grade']);
							break;
						case  'equal' :
							$uu = 'grade = \'' . $i -> escape($_POST['grade']) . '\'';
							break;
					}
				}
				if (!empty($_POST['point'])) {
					switch($_POST['point_range']) {case  "less" :
							$vv = 'point < ' . $i -> escape($_POST['point']);
							break;
						case  'more' :
							$vv = 'point > ' . $i -> escape($_POST['point']);
							break;
						case  'equal' :
							$vv = 'point = \'' . $i -> escape($_POST['point']) . '\'';
							break;
					}
				}$i = new CDatabase;
				$h = $i -> where($aa);
				if (isset($ff)) {
					if (!empty($h))
						$h .= ' AND ' . $ff;
					else
						$h .= ' WHERE ' . $ff;
				}
				if (isset($nn)) {
					if (!empty($h))
						$h .= ' AND ' . $nn;
					else
						$h .= ' WHERE ' . $nn;
				}
				if (isset($ss)) {
					if (!empty($h))
						$h .= ' AND ' . $ss;
					else
						$h .= ' WHERE ' . $ss;
				}
				if (isset($tt)) {
					if (!empty($h))
						$h .= ' AND ' . $tt;
					else
						$h .= ' WHERE ' . $tt;
				}
				if (isset($uu)) {
					if (!empty($h))
						$h .= ' AND ' . $uu;
					else
						$h .= ' WHERE ' . $uu;
				}
				if (isset($vv)) {
					if (!empty($h))
						$h .= ' AND ' . $vv;
					else
						$h .= ' WHERE ' . $vv;
				}$h = 'SELECT * FROM tbl_training ' . $h;
				$ww = $i -> queryAll($h);
				var_dump($ww);
				exit();
			}
		}$e = new CView;
		$e -> form = $b -> run();
		$e -> run();
	}

}
