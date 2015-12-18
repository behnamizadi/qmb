	<?php
class childController {
	public function manage() {
		$db = new CDatabase;
		$clerk_id = CUrl::segment(3);
		$cview = new CView;
		$profile = new Profile;
		if ($profile -> hasSpouse($clerk_id) == FALSE) {
		    $cview -> error = 'این کارمند مجرد می‌باشد یا تعداد افراد تحت تکفل صفر می‌باشد. لطفا ابتدا مشخصات فردی کارمند را ' . CUrl::createLink('ویرایش', 'clerk/edit/profile') . ' نمایید.';
			$cview -> run();
		}
		$form = new CForm;
		$form -> showFieldErrorText = FALSE;
		if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
			if ($form -> validate()) {
				$_POST['error'] = 0;
				$calendar = new CJcalendar;
				$born_date = $calendar -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']);				
				$h = "SELECT id FROM tbl_spouse WHERE clerk_id='$clerk_id'";
				$i = $db -> queryOne($h) -> id;
				$j = array('', $i, $clerk_id, $_POST['name'], $_POST['code_melli'], $born_date, $_POST['city_born']);
				$db -> insert($j);
			} else
				$_POST['error'] = 1;
		}
		$k = new CGrid;
		$k -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'child/edit/' . $clerk_id . '/$value->id' => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'child/delete/' . $clerk_id . '/$value->id' => array('icon' => 'public/images/delete.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), );
		$k -> condition = array('clerk_id' => $clerk_id);
		$k -> headers = array('name', 'code_melli', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born');
		$cview -> grid = $k -> run();
		$cview -> form = $form -> run();
		$cview -> title = 'مشخصات فرزندان ' . Profile::getName($clerk_id);
		$cview -> run('child/manage');
	}

	public function delete() {$clerk_id = CUrl::segment(3);
		$l = CUrl::segment(4);
		$db = new CDatabase;
		$db -> delete(array('id' => $l));
		CUrl::redirect('child/manage/' . $clerk_id);
	}

	public function edit() {
	    $clerk_id = CUrl::segment(3);
		$l = CUrl::segment(4);
		$db = new CDatabase;
		if (($m = $db -> getByPk($l)) == FALSE)
			CUrl::redirect(404);
		$cview = new CView;
		$form = new CForm;
		$form -> showFieldErrorText = FALSE;
		$calendar = new CJcalendar(FALSE);
		if ($form -> validate()) {
		    $born_date = $calendar -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
			$db -> additional = array('date_born' => $born_date);
			$db -> update(array('id' => $l));
			CUrl::redirect('child/manage/' . $clerk_id);
		}
		$cview -> m = $calendar -> date('m', $m -> date_born);
		$cview -> d = $calendar -> date('d', $m -> date_born);
		$cview -> y = $calendar -> date('Y', $m -> date_born);
		$cview -> model = $m;
		$cview -> form = $form -> run();
		$cview -> title = 'ویرایش مشخصات فرزند';
		$cview -> run();
	}

}
