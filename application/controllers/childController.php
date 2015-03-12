<?php
class childController {
	public function manage() {
		$a = CUrl::segment(3);
		$b = new CView;
		$c = new Profile;
		if ($c -> hasSpouse($a) == FALSE) {$b -> error = 'این کارمند مجرد می‌باشد یا تعداد افراد تحت تکفل صفر می‌باشد. لطفا ابتدا مشخصات فردی کارمند را ' . CUrl::createLink('ویرایش', 'clerk/edit/profile') . ' نمایید.';
			$b -> run();
		}
		$b = new CView;
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
		$k -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'child/edit/' . $a . '/$value->id' => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'child/delete/' . $a . '/$value->id' => array('icon' => 'public/images/delete.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), );
		$k -> condition = array('clerk_id' => $a);
		$k -> headers = array('name', 'code_melli', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born');
		$b -> grid = $k -> run();
		$b -> form = $d -> run();
		$b -> title = 'مشخصات فرزندان ' . Profile::getName($a);
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
		$b -> title = 'ویرایش مشخصات فرزند';
		$b -> run();
	}
	public function add(){
		
	}

}
