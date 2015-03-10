<?php
class profileController {
	public function add() {$a = CUrl::segment(3);
		$b = CUrl::segment(4);
		$c = new CView;
		$d = 'SELECT COUNT(*) FROM tbl_profile WHERE clerk_id=\'' . $a . '\'';
		$e = new CDatabase;
		if ($e -> countRows($d))
			CUrl::redirect('profile/edit/' . $a);
		if (Clerk::doesExist($a, $b)) {$f = new CForm;
			$f -> showFieldErrorText = FALSE;
			if (isset($_POST['submit'])) {
				if (isset($_POST['sex']) && $_POST['sex'] == 1 && empty($_POST['sarbazi'])) {$f -> setError('sarbazi', 'این فیلد برای جنسیت مرد، نمي‌تواند خالی بماند.');
				}
				if (isset($_POST['married']) && $_POST['married'] == 2 && empty($_POST['takafol'])) {$f -> setError('takafol', 'این فیلد برای افراد متاهل نمی‌تواند خالی بماند.');
				}
				if ($f -> validate() === TRUE) {$g = new CJcalendar;
					$h = $g -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
					$e -> additional = array('date_born' => $h, 'clerk_id' => $a);
					$e -> insert();
					if ($_POST['married'] == 2)
						CUrl::redirect('spouse/add/' . $a . '/' . $b . '/' . $_POST['takafol']);
					else
						CUrl::redirect('employment/add/' . $a . '/' . $b);
				}
			}
			$c -> title = 'افزودن کارمند';
			$c -> form = $f -> run();
			$c -> run('profile/create');
		} else {$c -> error = 'مشکلی در فرایند ثبت به وجود آمده است.';
			$c -> run();
		}
	}

	public function view() {$i = CUrl::segment(3);
		$j = new CDetail;
		$j -> headers = array('name', 'lastname', 'tel', 'mobile', 'father', 'date_born' => array('model[CJcalendar,date(Y/m/j,$value)]'), 'city_born', 'city_sodur', 'sh_sh', 'code_melli');
		$k = Clerk::getMarried($i);
		$l = array();
		if ($k == 'مجرد')
			$l['وضعیت تاهل'] = $k;
		else {$d = 'SELECT * FROM tbl_spouse WHERE clerk_id=\'' . $i . '\'';
			$e = new CDatabase;
			$m = $e -> queryOne($d);
			$l['نام همسر'] = $m -> name;
			$l['نام خانوادگی همسر'] = $m -> lastname;
			$l['شغل همسر'] = $m -> job;
			$l['نام پدر همسر'] = $m -> father;
			$l['شماره شناسنامه همسر'] = $m -> sh_sh;
			$l['کد ملی همسر'] = $m -> code_melli;
			$l['تعداد فرزند'] = $m -> number_of_children;
			if ($m -> number_of_children > 0) {$d = 'SELECT * FROM tbl_child WHERE clerk_id=\'' . $i . '\'';
				$n = $e -> queryAll($d);
				$o = 1;
				$b = new CJcalendar;
				foreach ($n as $p) {$l['نام فرزند' . $o] = $p -> name;
					$l['کد ملی' . $o] = $p -> code_melli;
					$l['تاریخ تولد' . $o] = $b -> date("Y/m/j", $p -> date_born);
					$o++;
				}
			}
		}$j -> additional = $l;
		$c = new CView;
		$c -> body = $j -> run();
		$c -> run('profile/view');
	}

	public function edit() {$i = CUrl::segment(3);
		$e = new CDatabase;
		if (($q = $e -> getByPk($i)) == FALSE)
			CUrl::redirect(404);
		$c = new CView;
		$c -> model = $q;
		$g = new CJcalendar(FALSE);
		$c -> m = $g -> date('m', $q -> date_born);
		$c -> d = $g -> date('d', $q -> date_born);
		$c -> y = $g -> date('Y', $q -> date_born);
		$f = new CForm;
		$f -> dontClose = TRUE;
		$f -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if (isset($_POST['married']) && $_POST['married'] == 2)
				$c -> takafol_display = '</td><td><div id="takafol_display"><label>تعداد تحت تفکل<span class="error">*</span></label>';
			if ($f -> validate() === TRUE) {$g = new CJcalendar;
				$h = $g -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
				$e -> additional = array('date_born' => $h);
				$e -> update(array('clerk_id' => $i));
				CUrl::redirect('clerk/manage');
			}
		}
		if ($q -> married == 2)
			$c -> takafol_display = '<td><div id="takafol_display"><label>تعداد تحت تفکل<span class="error">*</span></label>';
		else
			$c -> takafol_display = '<td><div id="takafol_display"  class="display_none"><label>تعداد تحت تفکل<span class="error">*</span></label>';
		$c -> form = $f -> run();
		$c -> run('profile/create');
	}

	public function delete() {$i = CUrl::segment(3);
		$r = array('id' => $i);
		$e = new CDatabase;
		$e -> delete($r);
		$r = array('clerk_id' => $i);
		$e -> setTbl('tbl_spouse');
		$e -> delete($r);
		$e -> setTbl('tbl_child');
		$e -> delete($r);
		CUrl::redirect('profile/manage');
	}

}
