<?php
class notice_clerkController {
	public function index() {$a = new CForm;
		if (isset($_POST['submit'])) {$b = new Clerk;
			$c = $b -> getId($_POST['clerk_number']);
			if (!$c) {$a -> setError('clerk_number', 'رکوردی با این شماره کارمندی وجود ندارد.');
			}$d = new CDatabase;
			$e = 'SELECT COUNT(*) FROM tbl_notice_clerk WHERE clerk_id=\'' . $c . '\'';
			if ($d -> countRows($e)) {$a -> setError('clerk_number', 'قبلا برای این کارمند اخطار تمدید قرارداد ثبت شده است.');
			}
			if ($a -> validate() == TRUE) {CUrl::redirect('notice_clerk/add/' . $c);
			}
		}$f = new CView;
		$f -> title = 'ثبت اخطار قرارداد کارمند';
		$f -> form = $a -> run();
		$f -> run('clerk/edit');
	}

	public function add() {
	    $g = CUrl::segment(3);
		if (!$g) {CUrl::redirect('notice_clerk/index');
		}$a = new CForm;
		if ($a -> validate()) {
		    $d = new CDatabase;
			$h = new CJcalendar;
			$i = $h -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
			$d -> additional = array('clerk_id' => $g, 'date_end' => $i);
			$d -> insert();
			CUrl::redirect('notice_clerk/manage');
		}
		$f = new CView;
		$f -> title = 'ثبت اخطار قرارداد کارمند - ' . Profile::getName($g);
		$f -> form = $a -> run();
		$f -> run();
	}

	public function manage() {
	    $isprint = False;
		if (CUrl::segment(3) === 'print')
			$isprint = TRUE;
		$e = "SELECT tbl_notice_clerk.clerk_id,tbl_notice_clerk.post,tbl_notice_clerk.place,tbl_notice_clerk.date_end,tbl_profile.name,tbl_profile.lastname 
		FROM tbl_notice_clerk inner join tbl_profile 
		on tbl_notice_clerk.clerk_id=tbl_profile.clerk_id";
		$d = new CDatabase;
        $values = $d -> queryAll($e);
		$v= new CView;
        $v -> values= $values;
        $v -> isprint = $isprint;
        $v -> run('notice_clerk/manage');
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
		$f -> title = 'ویرایش اخطار قرارداد کارمند - ' . Profile::getName($g);
		$f -> form = $a -> run();
		$f -> run();
	}

	public function delete() {$d = new CDatabase;
		$d -> delete(array('clerk_id' => CUrl::segment(3)));
		CUrl::redirect('notice_clerk/manage');
	}

}