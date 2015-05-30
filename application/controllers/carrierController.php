<?php
class carrierController {
	public function index() {$a = new CForm;
		if (isset($_POST['itisform'])) {$b = new Clerk;
			$c = $b -> getId($_POST['clerk_number']);
			if (!$c) {$a -> setError('clerk_number', 'رکوردی با این کد پرسنلی وجود ندارد.');
			}
			if ($a -> validate() == TRUE) {
				if (CUrl::segment(3) == 'add')
					CUrl::redirect('carrier/add/' . $c);
				else
					CUrl::redirect('carrier/summ/' . $c);
			}
		}$d = new CView;
		if (CUrl::segment(3) == 'add')
			$d -> title = 'ثبت مسیر شغلی کارمند';
		else
			$d -> title = 'گزارش مسیر شغلی';
		$d -> form = $a -> run();
		$d -> run('clerk/edit');
	}

	public function summ() {$c = CUrl::segment(3);
		if (!$c)
			CUrl::redirect('carrier/index');
		$e = FALSE;
		if (CUrl::segment(4) === 'print')
			$e = TRUE;
		$f = new CGrid;
		$f -> condition = array('clerk_id' => $c);
		$f -> sort = 'start';
		$f -> headers = array('employment_status' => array('format' => 'model[Lookup,getById($value,employment_status)]', 'label' => 'وضعیت استخدام'), 'job_status' => array('format' => 'model[Lookup,getById($value,job_status)]', 'label' => 'وضعیت اشتغال'), 'post' => array('format' => 'model[Lookup,getById($value,post)]', 'label' => 'پست سازمانی'), 'hokm_type' => array('format' => 'model[Lookup,getById($value,hokm_type)]', 'label' => 'نوع حکم'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => 'محل خدمت'), 'branch_id2' => array('format' => 'type[0:7800]', 'label' => 'کد محل خدمت'), 'start' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ شروع'), 'end' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ پایان'), 'emtiaz_shoghl' => array('label' => 'امتیاز شغل'), );
		$d = new CView;
		$f -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'carrier/edit/$value->id/' . $c => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'carrier/delete/$value->id/' . $c => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف', 'message' => 'واقعا می‌خوای حذفش کنی؟'));
		if ($e) {$f -> operations = FALSE;
			$f -> noSort = TRUE;
			$d -> layout = 'print';
			$d -> ptitle = '<h1>گزارش مسیر  شغلی ' . Profile::getName($c) . '</h1>';
			$g = new User;
			$d -> producer = $g -> producer();
		} else {$d -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'carrier/summ/' . $c . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$h = new CDatabase;
		$j = "SELECT * FROM tbl_carrier WHERE clerk_id='" . CUrl::segment(3) . "'";
		$l = $h -> queryAll($j);
		foreach ($l as $m => $n) {$l[$m] -> branch_id2 = $l[$m] -> branch_id;
		}$f -> values = $l;
		$d -> grid = $f -> run();
		$d -> c_id = $c;
		$d -> title = 'مسیر  شغلی ' . Profile::getName($c);
		$d -> print = $e;
		$d -> run('carrier/summ');
	}

	public function add() {$c = CUrl::segment(3);
		if (!$c)
			CUrl::redirect('carrier/index/add');
		$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		if (isset($_POST['itisform'])) {$h = new CDatabase;
			$o = $h -> escape($_POST['c_path']);
			$p = FALSE;
			for ($q = 1; $q <= $o; $q++) {$r = TRUE;
				if ($q == 1) {
					if (!empty($_POST['place' . $q]) || !empty($_POST['employment_status' . $q]) || !empty($_POST['job_status' . $q]) || !empty($_POST['hokm_type' . $q]) || !empty($_POST['post' . $q]) || !empty($_POST['d_start' . $q]) || !empty($_POST['m_start' . $q]) || !empty($_POST['y_start' . $q])) {$r = FALSE;
					}
					if (!empty($_POST['place' . $q]) && !empty($_POST['employment_status' . $q]) && !empty($_POST['job_status' . $q]) && !empty($_POST['hokm_type' . $q]) && !empty($_POST['post' . $q]) && !empty($_POST['d_start' . $q]) && !empty($_POST['m_start' . $q]) && !empty($_POST['y_start' . $q])) {$r = TRUE;
						$p = TRUE;
					}
				} else {
					if (!empty($_POST['place' . $q]) || !empty($_POST['employment_status' . $q]) || !empty($_POST['job_status' . $q]) || !empty($_POST['hokm_type' . $q]) || !empty($_POST['post' . $q]) || !empty($_POST['d_start' . $q]) || !empty($_POST['m_start' . $q]) || !empty($_POST['y_start' . $q]) || !empty($_POST['d_end' . $q]) || !empty($_POST['m_end' . $q]) || !empty($_POST['y_end' . $q])) {$r = FALSE;
					}
					if (!empty($_POST['place' . $q]) && !empty($_POST['employment_status' . $q]) && !empty($_POST['job_status' . $q]) && !empty($_POST['hokm_type' . $q]) && !empty($_POST['post' . $q]) && !empty($_POST['d_start' . $q]) && !empty($_POST['m_start' . $q]) && !empty($_POST['y_start' . $q]) && !empty($_POST['d_end' . $q]) && !empty($_POST['m_end' . $q]) && !empty($_POST['y_end' . $q])) {$r = TRUE;
					}
				}
				if ($r == TRUE && !empty($_POST['hokm_type' . $q]) && $_POST['hokm_type' . $q] != 8)
					$r = FALSE;
				if ($r === FALSE) {
					if (empty($_POST['employment_status' . $q])) {$a -> setError('employment_status' . $q, 'e');
					}
					if (empty($_POST['job_status' . $q])) {$a -> setError('job_status' . $q, 'e');
					}
					if (empty($_POST['hokm_type' . $q])) {$a -> setError('hokm_type' . $q, 'e');
					}
					if (empty($_POST['post' . $q])) {$a -> setError('post' . $q, 'e');
					}
					if (isset($_POST['hokm_type' . $q]) && $_POST['hokm_type' . $q] != 8) {
					}
					if (empty($_POST['place' . $q])) {$a -> setError('place' . $q, 'ورود فیلد محل خدمت الزامیست.');
					}
					if (empty($_POST['d_start' . $q])) {$a -> setError('d_start' . $q, 'e');
					}
					if (empty($_POST['m_start' . $q])) {$a -> setError('m_start' . $q, 'e');
					}
					if (empty($_POST['y_start' . $q])) {$a -> setError('y_start' . $q, 'e');
					}
					if (empty($_POST['d_end' . $q]) && $q != 1) {$a -> setError('d_end' . $q, 'e');
					}
					if (empty($_POST['m_end' . $q]) && $q != 1) {$a -> setError('m_end' . $q, 'e');
					}
					if (empty($_POST['y_end' . $q]) && $q != 1) {$a -> setError('y_end' . $q, 'e');
					}
				}
				if (isset($_POST['place' . $q]) && $_POST['place' . $q] == '2') {
					if (empty($_POST['branches' . $q])) {$a -> setError('branches' . $q, 'e');
					}
				}
			}
			if ($a -> validate() === TRUE) {$h -> setTbl('tbl_carrier');
				$s = new CJcalendar;
				if ($p === TRUE) {$t = $s -> mktime(0, 0, 0, (int)$_POST['m_start1'], (int)$_POST['d_start1'], (int)$_POST['y_start1']) + 14400;
					$j = "SELECT id FROM tbl_carrier WHERE clerk_id='$c' AND end='0'";
					$u = $h -> queryOne($j);
					if ($u !== FALSE && $_POST['hokm_type1'] != 8) {$u = $u -> id;
						$v = $t - 24 * 3600;
						$j = "UPDATE tbl_carrier SET end='$v',now_c='0' WHERE id='$u'";
						$h -> execute($j);
					}$w = isset($_POST['branches1']) ? $_POST['branches1'] : 0;
					$x = isset($_POST['degree1']) ? $_POST['degree1'] : 0;
					$l = array('clerk_id' => $c, 'employment_status' => $_POST['employment_status1'], 'job_status' => $_POST['job_status1'], 'post' => $_POST['post1'], 'post2' => $x, 'hokm_type' => $_POST['hokm_type1'], 'branch_id' => $w, 'start' => $t, 'end' => 0, 'emtiaz_shoghl' => $_POST['emtiaz_shoghl1'], 'now_c' => 1);
					$h -> insert($l);
				}
				for ($q = 1; $q <= $o; $q++) {
					if (!empty($_POST['place' . $q]) && !empty($_POST['employment_status' . $q]) && !empty($_POST['job_status' . $q]) && !empty($_POST['hokm_type' . $q]) && !empty($_POST['post' . $q]) && !empty($_POST['emtiaz_shoghl' . $q]) && !empty($_POST['d_start' . $q]) && !empty($_POST['m_start' . $q]) && !empty($_POST['y_start' . $q]) && !empty($_POST['d_end' . $q]) && !empty($_POST['m_end' . $q]) && !empty($_POST['y_end' . $q])) {$y = $s -> mktime(0, 0, 0, (int)$_POST['m_start' . $q], (int)$_POST['d_start' . $q], (int)$_POST['y_start' . $q]) + 14400;
						$z = $s -> mktime(0, 0, 0, (int)$_POST['m_end' . $q], (int)$_POST['d_end' . $q], (int)$_POST['y_end' . $q]) + 14400;
						$w = isset($_POST['branches' . $q]) ? $_POST['branches' . $q] : 0;
						$x = isset($_POST['degree' . $q]) ? $_POST['degree' . $q] : 0;
						$l = array('clerk_id' => $c, 'employment_status' => $_POST['employment_status' . $q], 'job_status' => $_POST['job_status' . $q], 'post' => $_POST['post' . $q], 'post2' => $x, 'hokm_type' => $_POST['hokm_type' . $q], 'branch_id' => $w, 'start' => $y, 'end' => $z, 'emtiaz_shoghl' => $_POST['emtiaz_shoghl' . $q], );
						$h -> insert($l);
					}
				}CUrl::redirect('carrier/summ/' . $c);
			}
		}$d = new CView;
		$d -> f = $a;
		$d -> title = 'افزودن مسیر  شغلی ' . Profile::getName($c);
		$d -> run('carrier/add');
	}

	public function edit() {$aa = CUrl::segment(3);
		$bb = CUrl::segment(4);
		$h = new CDatabase;
		if (($cc = $h -> getByPk($aa)) == FALSE) {CUrl::redirect(404);
		}$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		$dd = TRUE;
		if (!empty($_POST['d_end']) || !empty($_POST['m_end']) || !empty($_POST['y_end']))
			$dd = FALSE;
		if (!empty($_POST['d_end']) && !empty($_POST['m_end']) && !empty($_POST['y_end']))
			$dd = TRUE;
		if (isset($_POST['place']) && $_POST['place'] == '2') {
			if (empty($_POST['branches'])) {$a -> setError('branches', 'e');
			}
		}
		if (!$dd) {
			if (empty($_POST['m_end']))
				$a -> setError('m_end', 'e');
			if (empty($_POST['d_end']))
				$a -> setError('d_end', 'e');
			if (empty($_POST['y_end']))
				$a -> setError('y_end', 'e');
		}$s = new CJcalendar(FALSE);
		if ($a -> validate()) {$t = $s -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']) + 14400;
			if (!empty($_POST['d_end']) && !empty($_POST['m_end']) && !empty($_POST['y_end'])) {$ee = $s -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
			} else {$ee = 0;
			}$x = isset($_POST['degree']) ? $_POST['degree'] : 0;
			$w = isset($_POST['branches']) ? $_POST['branches'] : 0;
			$h -> additional = array('post2' => $x, 'branch_id' => $w, 'start' => $t, 'end' => $ee, );
			$h -> update(array('id' => $aa));
			CUrl::redirect('carrier/summ/' . $bb);
		}$d = new CView;
		$d -> ms = $s -> date('m', $cc -> start);
		$d -> ds = $s -> date('d', $cc -> start);
		$d -> ys = $s -> date('Y', $cc -> start);
		$d -> me = empty($cc -> end) ? 0 : $s -> date('m', $cc -> end);
		$d -> de = empty($cc -> end) ? 0 : $s -> date('d', $cc -> end);
		$d -> ye = empty($cc -> end) ? 0 : $s -> date('Y', $cc -> end);
		$d -> degree = $cc -> post2;
		if ($cc -> branch_id != 0) {$d -> branch_display = '</td></tr><tr><td><div id="branch_display"><label>شعبه<span class="error">*</span></label>';
			$d -> place_id = 2;
			$d -> branch = $cc -> branch_id;
		} else {$d -> branch_display = '</td></tr><tr><td><div id="branch_display" class="display_none"><label>شعبه<span class="error">*</span></label>';
			$d -> place_id = 1;
		}$d -> model = $cc;
		$d -> form = $a -> run();
		$d -> title = 'ویرایش مسیر شغلی ' . Profile::getName($bb);
		$d -> run('carrier/edit');
	}

	public function delete() {$h = new CDatabase;
		$h -> delete(array('id' => CUrl::segment(3)));
		CUrl::redirect('carrier/summ/' . CUrl::segment(4));
	}

}
