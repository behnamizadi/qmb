<?php
class educationController {
	public function add() {
		$a = new CView;
		$b = CUrl::segment(3);
		$c = 'SELECT COUNT(*) FROM tbl_education WHERE clerk_id=\'' . $b . '\'';
		$d = new CDatabase;
		if ($d -> countRows($c))
			CUrl::redirect('education/manage/' . $b);
		$e = CUrl::segment(4);
		if (Clerk::doesExist($b, $e)) {$f = new CForm;
			$f -> showFieldErrorText = FALSE;
			if (isset($_POST['submit'])) {$d = new CDatabase;
				$g = 7;
				$h = TRUE;
				for ($j = 2; $j <= $g; $j++) {$k = TRUE;
					if (!empty($_POST['study_field' . $j]) || !empty($_POST['y_get' . $j]) || !empty($_POST['place' . $j])) {$h = FALSE;
						$k = FALSE;
					}
					if (!empty($_POST['study_field' . $j]) && !empty($_POST['y_get' . $j]) && !empty($_POST['place' . $j])) {$k = TRUE;
					}
					if ($k == FALSE) {
						if (empty($_POST['study_field' . $j])) {$f -> setError('study_field' . $j, 'e');
						}
						if (empty($_POST['y_get' . $j])) {$f -> setError('y_get' . $j, 'e');
						}
						if (empty($_POST['place' . $j])) {$f -> setError('place' . $j, 'e');
						}
					}
				}
				if ($f -> validate() === TRUE) {
					if ($h == TRUE) {$d -> additional = array('clerk_id' => $b, 'study_degree' => 1, 'study_field' => 0, 'date_get' => 0, 'place' => 0);
						$d -> insert();
					} else {$l = new CJcalendar;
						for ($j = 2; $j <= $g; $j++) {
							if (!empty($_POST['study_field' . $j]) && !empty($_POST['y_get' . $j]) && !empty($_POST['place' . $j])) {$m = $l -> mktime(0, 0, 0, 1, 1, (int)$_POST['y_get' . $j]) + 14400;
								$d -> additional = array('clerk_id' => $b, 'study_degree' => $j, 'study_field' => $_POST['study_field' . $j], 'date_get' => $m, 'place' => $_POST['place' . $j]);
								$d -> insert();
							}
						}
					}CUrl::redirect('clerk/manage');
				}
			}$a -> title = 'ورود اطلاعات تحصیلی ' . Profile::getName($b);
			$a -> form = $f -> run();
			$a -> run('education/add');
		} else {$a -> error = 'مشکلی در فرایند ثبت به وجود آمده است.';
			$a -> run();
		}
	}

	public function manage() {
	    $b = CUrl::segment(3);
		$a = new CView;
		$f = new CForm;
		$f -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if ($f -> validate()) {$_POST['error'] = 0;
				$l = new CJcalendar;
				$m = $l -> mktime(0, 0, 0, 1, 1, (int)$_POST['y_get']);
				$d = new CDatabase;
				$d -> additional = array('clerk_id' => $b, 'date_get' => $m);
				$d -> insert();
			} else{
				$_POST['error'] = 1;}
		}
		$n = new CGrid;
		$n -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'education/edit/' . $b . '/$value->id' => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'education/delete/' . $b . '/$value->id' => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف'), );
		$n -> condition = array('clerk_id' => $b);
		$n -> headers = array('study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]'), 'study_field' => array('format' => 'model[StudyField,getById($value)]'), 'date_get' => array('format' => 'model[Cal,getDate($value,Y)]'), 'place');
		$a -> sfs = StudyField::getAll();
		$a -> grid = $n -> run();
		$a -> form = $f -> run();
		$a -> title = 'اطلاعات تحصیلی ' . Profile::getName($b);
		$a -> run('education/manage');
	}

	public function delete() {$b = CUrl::segment(3);
		$o = CUrl::segment(4);
		$d = new CDatabase;
		$d -> delete(array('id' => $o));
		CUrl::redirect('education/manage/' . $b);
	}

	public function edit() {$b = CUrl::segment(3);
		$o = CUrl::segment(4);
		$d = new CDatabase;
		if (($p = $d -> getByPk($o)) == FALSE)
			CUrl::redirect(404);
		$a = new CView;
		$q = new StudyField;
		$a -> sfs = $q -> getByDegree($p -> study_degree);
		$f = new CForm;
		$f -> showFieldErrorText = FALSE;
		$l = new CJcalendar(FALSE);
		if ($f -> validate()) {$m = $l -> mktime(0, 0, 0, 1, 1, (int)$_POST['y_get']) + 14400;
			$d -> additional = array('date_get' => $m);
			$d -> update(array('id' => $o));
			CUrl::redirect('education/manage/' . $b);
		}$a -> y = $l -> date('Y', $p -> date_get);
		$a -> model = $p;
		$a -> form = $f -> run();
		$a -> title = 'ویرایش اطلاعات تحصیلی';
		$a -> run('education/edit');
	}

}
