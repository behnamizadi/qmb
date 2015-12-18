<?php
class evaluationController {
	public function index() {$a = CUrl::segment(3);
		$cview = new CView;
		$c = '';
		if ($a == 'add') {
			$d = new CForm('addindex');
			$c = 'evaluation/index';
		} else {$e = TRUE;
			$d = new CForm('batchindex');
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
			if (!isset($e)) {$f = new Clerk;
				$g = $f -> getId($_POST['clerk_number']);
				if (!$g) {$d -> setError('clerk_number', 'رکوردی با این کد پرسنلی وجود ندارد.');
				}
			}
			if ($d -> validate()) {
				if ($a == 'add')
					CUrl::redirect('evaluation/add/' . $g . '/' . $_POST['year']);
				else {CUrl::redirect('evaluation/batch/' . $_POST['year']);
				}
			}
		}$h = new CJcalendar;
		$cview -> y = $h -> date('Y', FALSE, FALSE);
		if ($a == 'add')
			$cview -> title = 'ثبت/ ویرایش نمره ارزشیابی';
		else {$cview -> title = 'ثبت دسته‌ای نمره ارزشیابی';
		}$cview -> form = $d -> run();
		$cview -> run($c);
	}

	public function index2() {
		$d = new CForm;
		$d -> showFieldErrorText = FALSE;
		$cview = new CView;
		if ($d -> validate()) {
			CUrl::redirect('evaluation/all/' . $_POST['year']);
		}
		$h = new CJcalendar;
		$cview -> y = $h -> date('Y', FALSE, FALSE);
		$cview -> form = $d -> run();
		$cview -> title = 'گزارش نمرات ارزشیابی کل کارمندان';
		$cview -> run();
	}

	public function all() {$i = CUrl::segment(3);
        $j=FALSE;
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
		$m -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'grade' => array('label' => 'نمره ارزشیابی', 'onEmpty' => '-'), );
		$n = 'نمرات ارزشیابی همکاران در سال ' . $i;
		$cview = new CView;
		if ($j) {$m -> operations = FALSE;
			$m -> noSort = TRUE;
			$m -> paginate = FALSE;
			$cview -> layout = 'print';
			$cview -> ptitle = "<h1>$n</h1>";
			$o = new User;
			$cview -> producer = $o -> producer();
		} else {$cview -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'evaluation/all/' . $i . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$cview -> grid = $m -> run();
		$cview -> title = $n;
		$cview -> run();
	}

	public function add() {$cview = new CView;
		$p = CUrl::segment(3);
		$i = CUrl::segment(4);
		$cview -> title = 'ثبت نمره ارزشیابی ' . Profile::getName($p) . ' در سال ' . $i;
		if (Evaluation::unique($p, $i) == FALSE) {CUrl::redirect('evaluation/edit/' . $p . '/' . $i);
		}$d = new CForm;
		if ($d -> validate()) {$l = new CDatabase;
			$l -> additional = array('clerk_id' => $p, 'year' => $i);
			$l -> insert();
			$cview -> success = 'نمره ارزشیابی با موفقیت ثبت شد';
			$cview -> run();
		}$cview -> form = $d -> run();
		$cview -> run();
	}

	public function edit() {$p = CUrl::segment(3);
		$i = CUrl::segment(4);
		$k = "SELECT * FROM tbl_evaluation WHERE clerk_id='$p' AND year='$i'";
		$l = new CDatabase;
		if (($q = $l -> queryOne($k)) == FALSE) {CUrl::redirect(404);
		}$cview = new CView;
		$cview -> title = 'ثبت نمره ارزشیابی ' . Profile::getName($p) . ' در سال ' . $i;
		$d = new CForm;
		if ($d -> validate()) {$l = new CDatabase;
			$l -> update(array('clerk_id' => $p, 'year' => $i), array('grade' => $_POST['grade']));
			$cview -> success = 'نمره ارزشیابی با موفقیت ثبت شد';
			$cview -> run();
		}$cview -> model = $q;
		$cview -> form = $d -> run();
		$cview -> run();
	}

	public function batch() {
		$i = CUrl::segment(3);
		$l = new CDatabase;
		$h = new CJcalendar(FALSE);
		$r = $h -> mktime(0, 0, 0, 1, 1, $i + 1) - 86400;
		$k = "
		select emp.* from 
		(select prf.* from (
		select tbl_clerk.*,tbl_profile.name,tbl_profile.lastname from tbl_clerk left join tbl_profile on tbl_clerk.id=tbl_profile.clerk_id) as prf 
		left join tbl_employment on prf.id=tbl_employment.clerk_id where tbl_employment.date_employed <= $r) as emp 
		left join tbl_carrier on emp.id=tbl_carrier.clerk_id 
		where tbl_carrier.job_status=1 
		group by clerk_id order BY emp.clerk_number";
		$s = $l -> queryAll($k);
		$cview = new CView;
		$cview -> title = "ثبت نمره ارزشیابی دسته‌ای سال $i";
		if (isset($_POST['itisform'])) {
			foreach ($s as $f) {
				if (!empty($_POST[$f -> id])) {
					if (Evaluation::unique($f -> id, $i) == FALSE) {$l -> update(array('clerk_id' => $f -> id, 'year' => $i), array('grade' => $_POST[$f -> id]));
					} else {$l -> insert(array('clerk_id' => $f -> id, 'year' => $i, 'grade' => $_POST[$f -> id]));
					}
				}
			}$cview -> success = 'نمرات ارزشیابی با موفقیت ثبت شد';
			$cview -> run();
		}$cview -> clerks = $s;
		$cview -> run('evaluation/batch');
	}

}
