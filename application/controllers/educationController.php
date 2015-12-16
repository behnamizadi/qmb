<?php
class educationController {
	public function add() {
		$view = new CView;
		$clerk_id = CUrl::segment(3);
		$sql = 'SELECT COUNT(*) FROM tbl_education WHERE clerk_id=\'' . $clerk_id . '\'';
		$db = new CDatabase;
		if ($db -> countRows($sql))
			CUrl::redirect('education/manage/' . $clerk_id);
		$time_added = CUrl::segment(4);
		$form = new CForm;
		if (Clerk::doesExist($clerk_id, $time_added)) 
		{			
			if ($_SERVER['REQUEST_METHOD'] == 'POST')  
			{
				$db = new CDatabase;
				$g = 7;
				$h = TRUE;
				for ($j = 2; $j <= $g; $j++) {$k = TRUE;
					if (!empty($_POST['study_field' . $j]) || !empty($_POST['y_get' . $j]) || !empty($_POST['place' . $j])) {$h = FALSE;
						$k = FALSE;
					}
					if (!empty($_POST['study_field' . $j]) && !empty($_POST['y_get' . $j]) && !empty($_POST['place' . $j])) {$k = TRUE;
					}
					if ($k == FALSE) {
						if (empty($_POST['study_field' . $j])) {$form -> setError('study_field' . $j, 'e');
						}
						if (empty($_POST['y_get' . $j])) {$form -> setError('y_get' . $j, 'e');
						}
						if (empty($_POST['place' . $j])) {$form -> setError('place' . $j, 'e');
						}
					}
				}
				if ($form -> validate() === TRUE) {
					if ($h == TRUE) {
						$db -> additional = array('clerk_id' => $clerk_id, 'study_degree' => 1, 'study_field' => 0, 'date_get' => 0, 'place' => 0);
						$db -> insert();
					} else {
						$l = new CJcalendar;
						for ($j = 2; $j <= $g; $j++) {
							if (!empty($_POST['study_field' . $j]) && !empty($_POST['y_get' . $j]) && !empty($_POST['place' . $j])) {$m = $l -> mktime(0, 0, 0, 1, 1, (int)$_POST['y_get' . $j]) + 14400;
								$db -> additional = array('clerk_id' => $clerk_id, 'study_degree' => $j, 'study_field' => $_POST['study_field' . $j], 'date_get' => $m, 'place' => $_POST['place' . $j]);
								$db -> insert();
							}
						}
					}
					CUrl::redirect('education/manage');
				}
			}
			$view -> title = 'ورود اطلاعات تحصیلی ' . Profile::getName($clerk_id);
			$view -> form = $form -> run();
			$view -> run('education/add');
		} else {$view -> error = 'مشکلی در فرایند ثبت به وجود آمده است.';
			$view -> run('education/add');
		}
		
	}

	public function manage() {
	    $clerk_id = CUrl::segment(3);
		$view = new CView;
		$form = new CForm;
		$form -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if ($form -> validate()) {$_POST['error'] = 0;
				$l = new CJcalendar;
				$m = $l -> mktime(0, 0, 0, 1, 1, (int)$_POST['y_get']);
				$db = new CDatabase;
				$db -> additional = array('clerk_id' => $clerk_id, 'date_get' => $m);
				$db -> insert();
			} else{
				$_POST['error'] = 1;}
		}
		$n = new CGrid;
		$n -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'education/edit/' . $clerk_id . '/$value->id' => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'education/delete/' . $clerk_id . '/$value->id' => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف'), );
		$n -> condition = array('clerk_id' => $clerk_id);
		$n -> headers = array('study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]'), 'study_field' => array('format' => 'model[StudyField,getById($value)]'), 'date_get' => array('format' => 'model[Cal,getDate($value,Y)]'), 'place');
		$view -> sfs = StudyField::getAll();
		$view -> grid = $n -> run();
		$view -> form = $form -> run();
		$view -> title = 'اطلاعات تحصیلی ' . Profile::getName($clerk_id);
		$view -> run('education/manage');
	}

	public function delete() {$clerk_id = CUrl::segment(3);
		$o = CUrl::segment(4);
		$db = new CDatabase;
		$db -> delete(array('id' => $o));
		CUrl::redirect('education/manage/' . $clerk_id);
	}

	public function edit() {$clerk_id = CUrl::segment(3);
		$o = CUrl::segment(4);
		$db = new CDatabase;
		if (($p = $db -> getByPk($o)) == FALSE)
			CUrl::redirect(404);
		$view = new CView;
		$q = new StudyField;
		$view -> sfs = $q -> getByDegree($p -> study_degree);
		$form = new CForm;
		$form -> showFieldErrorText = FALSE;
		$l = new CJcalendar(FALSE);
		if ($form -> validate()) {$m = $l -> mktime(0, 0, 0, 1, 1, (int)$_POST['y_get']) + 14400;
			$db -> additional = array('date_get' => $m);
			$db -> update(array('id' => $o));
			CUrl::redirect('education/manage/' . $clerk_id);
		}$view -> y = $l -> date('Y', $p -> date_get);
		$view -> model = $p;
		$view -> form = $form -> run();
		$view -> title = 'ویرایش اطلاعات تحصیلی';
		$view -> run('education/edit');
	}

}
	
