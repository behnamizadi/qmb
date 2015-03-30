<?php
class p_pController {
	public function index() {$a = new CForm;
		if (isset($_POST['submit'])) {$b = new Clerk;
			$c = $b -> getId($_POST['clerk_number']);
			if (!$c) {$a -> setError('clerk_number', 'رکوردی با این کد پرسنلی وجود ندارد.');
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
				$e -> title = 'ثبت تشویق';
			else
				$e -> title = 'ثبت تنبیه';
		} else
			$e -> title = 'گزارش تشویقات/ تنبیهات کارمند';
		$e -> form = $a -> run();
		$e -> run('clerk/edit');
	}

	public function index2() {$a = new CForm;
		if ($a -> validate() == TRUE) {CUrl::redirect('p_p/all/' . $_POST['type'] . '/' . $_POST['year']);
		}$e = new CView;
		$e -> title = 'گزارش تشویقات/تنبیهات کل کارمندان';
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
		$k -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'p_p/edit/$value->id/0/' . $f . '/' . $d => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'p_p/delete/$value->id/0/' . $f . '/' . $d => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف', 'message' => 'واقعا می‌خوای حذفش کنی؟'));
		$k -> counter = TRUE;
		$k -> sort = 'date_added DESC';
		$k -> headers = array('name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'title', 'type' => array('format' => 'type[1:تشویق,2:تنبیه]'), 'date_added' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ اجرا'), 'set_by', 'hokm_number', 'description');
		$e = new CView;
		if ($d == 1)
			$n = 'گزارش تشویقات کل کارمندان در سال ' . $f;
		else
			$n = 'گزارش تنبیهات کل کارمندان در سال ' . $f;
		if ($h) {$k -> operations = FALSE;
			$k -> noSort = TRUE;
			$e -> layout = 'print';
			$e -> ptitle = '<h1>' . $n . '</h1>';
			$o = new User;
			$e -> producer = $o -> producer();
			$k -> paginate = FALSE;
		} else {$e -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'p_p/all/' . $d . '/' . $f . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$e -> title = $n;
		$e -> grid = $k -> run();
		$e -> run();
	}

	public function add() {$c = CUrl::segment(3);
		$d = CUrl::segment(4);
		$e = new CView;
		if (!$c) {
			if (!$d) {$e -> error = 'مشکلی در روند ثبت پیش آمده است';
				$e -> run();
			}CUrl::redirect('p_p/index/add/' . $d);
		}
		if ($d == 1)
			$e -> title = 'ثبت تشویق برای ' . Profile::getName($c);
		else {$e -> title = 'ثبت تنبیه برای ' . Profile::getName($c);
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
		$k -> headers = array('title', 'type' => array('format' => 'type[1:تشویق,2:تنبیه]'), 'date_added' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ اجرا'), 'set_by', 'hokm_number', 'description');
		$k -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'p_p/edit/$value->id/' . $c => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'p_p/delete/$value->id/' . $c => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف', 'message' => 'واقعا می‌خوای حذفش کنی؟'));
		if ($h) {$k -> operations = FALSE;
			$k -> noSort = TRUE;
			$k -> paginate = FALSE;
		}$e = new CView;
		$e -> grid = $k -> run();
		$e -> c_id = $c;
		$e -> title = 'تشویقات و تنبیهات ' . Profile::getName($c);
		$e -> print = $h;
		if ($h) {$e -> layout = 'print';
			$e -> ptitle = '<h1>تشویقات و تنبیهات ' . Profile::getName($c) . '</h1>';
			$o = new User;
			$e -> producer = $o -> producer();
		} else {$e -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'p_p/summ/' . $c . '/print', 'class="box" target="_blank"') . '</p></center>';
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
		$e -> title = 'ویرایش تشویق/تنبیه ' . Profile::getName($r);
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
