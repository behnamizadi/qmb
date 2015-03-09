<?php
class clerkController {
	public function add() {$a = new CForm;
		$view = new CView;
		if (isset($_POST['submit'])) {$c = new Clerk;
			if (($d = $c -> getId($_POST['clerk_number'])) !== FALSE) {$a -> setError('clerk_number', 'این شماره کارمندی قبلا ثبت شده است.');
				$view -> error = '<div class="red">این شماره کارمندی قبلا ثبت شده است.برای ویرایش یا افزودن اطلاعات اضافی به مشخصات این کارمند لطفا <a href="' . CUrl::createUrl('clerk/edit/' . $d) . '">روی این لینک</a> کلیک نمایید.</div>';
			}
			if ($a -> validate() === TRUE) {$e = new CDatabase;
				$f = time();
				$e -> additional = array('time_added' => $f);
				$e -> insert();
				CUrl::redirect('profile/add/' . $e -> lastId() . '/' . $f . '/');
			}
		}$view -> title = 'ثبت اطلاعات کارمند';
		$view -> frun = $a -> run();
		$view -> run('clerk/add');
	}

	public function manage() {$g = new CGrid;
		$h = FALSE;
		if (CUrl::segment(3) === 'print')
			$h = TRUE;
		$j = "SELECT MAX(tbl_carrier.start),tbl_clerk.id,tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_profile.mobile,tbl_profile.sex,tbl_carrier.employment_status,tbl_carrier.job_status,tbl_carrier.clerk_id 
		FROM tbl_clerk,tbl_profile,tbl_carrier WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_carrier.clerk_id AND tbl_carrier.now_c='1' GROUP BY tbl_carrier.clerk_id ORDER BY tbl_carrier.job_status,tbl_clerk.clerk_number";
		$e = new CDatabase;
		$g -> values = $e -> queryAll($j);
		$g -> operations = array('edit' => FALSE);
		$g -> counter = TRUE;
		$g -> headers = array('clerk_number', 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'mobile' => array('label' => 'موبایل'), 'employment_status' => array('format' => 'model[Lookup,getById($value,employment_status)]', 'label' => 'وضعیت استخدام'), 'job_status' => array('format' => 'model[Lookup,getById($value,job_status)]', 'label' => 'وضعیت اشتغال'), 'sex' => array('format' => 'type[1:مرد,2:زن]', 'label' => 'جنسیت'));
		$view = new CView;
		$k = 'لیست کارمندان';
		if ($h) {$g -> operations = FALSE;
			$g -> noSort = TRUE;
			$g -> paginate = FALSE;
			$view -> layout = 'print2';
			$view -> ptitle = "<h1>$k</h1>";
			$l = new User;
			$view -> producer = $l -> producer();
		} else {$view -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'clerk/manage/print', 'class="box" target="_blank"') . '</p></center>';
		}$view -> grid = $g -> run();
		$view -> title = $k;
		$view -> run();
	}

	public function edit() {$m = CUrl::segment(3);
		$view = new CView;
		switch($m) {case  'profile' :
				$view -> title = 'ویرایش مشخصات فردی کارمند';
				break;
			case  'spouse' :
				$view -> title = 'ویرایش افراد تحت تکفل کارمند';
				break;
			case  'employment' :
				$view -> title = 'ویرایش اطلاعات پایه‌ای شغل کارمند';
				break;
			case  'education' :
				$view -> title = 'ویرایش اطلاعات تحصیلی کارمند';
				break;
			default :
				$view -> title = 'ویرایش اطلاعات کارمند';
		}
		if (is_numeric($m)) {$view -> clerk_id = $m;
			$j = "SELECT time_added FROM tbl_clerk WHERE id='$m'";
			$e = new CDatabase;
			$view -> time_added = $e -> queryOne($j) -> time_added;
			$view -> run('clerk/edit2');
		}$a = new CForm;
		if (isset($_POST['submit'])) {$c = new Clerk;
			$n = $c -> getId($_POST['clerk_number']);
			if (!$n) {$a -> setError('clerk_number', 'رکوردی با این شماره کارمندی وجود ندارد.');
			}
			if ($a -> validate() == TRUE) {
				switch($m) {case  'profile' :
						CUrl::redirect('profile/edit/' . $n);
						break;
					case  'spouse' :
						CUrl::redirect('spouse/edit/' . $n);
						break;
					case  'employment' :
						CUrl::redirect('employment/edit/' . $n);
						break;
					case  'education' :
						CUrl::redirect('education/manage/' . $n);
						break;
					default :
						$view -> clerk_id = $n;
						$j = "SELECT time_added FROM tbl_clerk WHERE id='$n'";
						$e = new CDatabase;
						$view -> time_added = $e -> queryOne($j) -> time_added;
						$view -> run('clerk/edit2');
				}
			}
		}$view -> form = $a -> run();
		$view -> layout = 'jquery';
		$view -> run('clerk/edit');
	}

	public function view() {$d = CUrl::segment(3);
		if (!$d)
			CUrl::redirect('clerk/manage');
		$e = new CDatabase;
		$p = new CJcalendar;
		$view = new CView;
		$q = "SELECT name,lastname,father,date_born,city_born,city_sodur,sh_sh,code_melli,takafol,married,religion FROM tbl_profile WHERE clerk_id='$d'";
		$s = $e -> queryOne($q);
		$s -> date_born = $p -> date("Y/m/d", $s -> date_born);
		$t = "SELECT branch_id FROM tbl_carrier WHERE clerk_id='$d' AND end=0";
		$u = '';
		if (($v = $e -> queryOne($t)) !== FALSE) {$w = new Ostan;
			$x = $w -> getName();
			if ($v -> branch_id != 0) {$u = $x;
				$j = "SELECT name,city FROM tbl_branch WHERE code='$v->branch_id'";
				if (($y = $e -> queryOne($j)) !== FALSE) {$z = new Cities;
					$z = $z -> getById($y -> city);
					$u .= "- شهر $z- شعبه $y->name";
				}
			} else {$u = "سرپرستی $x";
			}
		}$view -> jobPlace = $u;
		$c = new Clerk;
		$view -> clerk_number = $c -> getClerkNumber($d);
		if ($s -> married == 2)
			$view -> spouseJob = $e -> queryOne("SELECT job FROM tbl_spouse WHERE clerk_id='$d'") -> job;
		else
			$view -> spouseJob = '-';
		$aa = $e -> queryOne("SELECT date_employed,picture FROM tbl_employment WHERE clerk_id='$d'");
		$bb = $aa -> date_employed;
		$cc = $p -> difference($bb);
		$dd = '';
		if ($cc['year'] != 0)
			$dd .= $cc['year'] . ' سال و';
		$dd .= $cc['month'] . ' ماه و';
		$dd .= $cc['day'] . ' روز';
		$view -> timeEmployed = $dd;
		$view -> dateEmployed = $p -> date('Y/m/d', $bb);
		$view -> picture = $aa -> picture;
		$g = new CGrid;
		$g -> noSort = array('study_degree', 'study_field', 'date_get', 'place');
		$g -> table = 'tbl_education';
		$g -> headers = array('study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]', 'label' => 'مدرک تحصیلی'), 'study_field' => array('format' => 'model[StudyField,getById($value)]', 'label' => 'رشته تحصیلی'), 'date_get' => array('format' => 'model[Cal,getDate($value,Y)]', 'label' => 'تاریخ اخذ مدرک'), 'place' => array('label' => 'محل تحصیل'));
		$g -> operations = FALSE;
		$g -> condition = array('clerk_id' => $d);
		$view -> education = $g -> run();
		$g -> table = 'tbl_carrier';
		$g -> headers = array('hokm_type' => array('format' => 'model[Lookup,getById($value,hokm_type)]', 'label' => 'نوع حکم'), 'post' => array('format' => 'model[Lookup,getById($value,post)]', 'label' => 'پست سازمانی'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => 'محل خدمت'), 'start' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ شروع'), 'end' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ پایان'), 'emtiaz_shoghl' => array('label' => 'امتیاز شغل'), );
		$g -> sort = 'start';
		$g -> noSort = array('hokm_type', 'post', 'branch_id', 'start', 'end', 'emtiaz_shoghl');
		$view -> carrier = $g -> run();
		$view -> profile = $s;
		$current_year = $p -> date('Y', FALSE, FALSE) - 1;
		$ff = array();
		for ($counter = $current_year - 3; $counter <= $current_year; $counter++) {$j = "SELECT grade FROM tbl_evaluation WHERE clerk_id='$d' AND year='$counter'";
			$hh = $e -> queryOne($j);
			if ($hh)
				$ff[$counter] = $hh -> grade;
			else
				$ff[$counter] = '-';
		}
		$j = "SELECT COUNT(*) FROM tbl_training WHERE clerk_id='$d'";
		$view -> tCount = $e -> countRows($j);
		$j = "SELECT COUNT(*) FROM tbl_p_p WHERE clerk_id='$d' AND type='1'";
		$view -> p1Count = $e -> countRows($j);
		$j = "SELECT COUNT(*) FROM tbl_p_p WHERE clerk_id='$d' AND type='2'";
		$view -> p2Count = $e -> countRows($j);
		$view -> evResult = $ff;
		$view -> layout = 'clerkview';
		$l = new User;
		$view -> producer = $l -> producer();
		$view -> run();
	}

	public function search() {
		$ii = CUrl::segment(3);
		$h = FALSE;
		if (CUrl::segment(4) === 'print')
			$h = TRUE;
		if (!$ii)
			CUrl::redirect('clerk/index');
		$jj = new CDetail;
		$view = new CView;
		$e = new CDatabase;
		$e -> setTbl('tbl_profile');
		$s = $e -> getByPk($ii);
		if ($s) {$jj -> value = $s;
			$jj -> numberOfColumns = 4;
			$jj -> headers = array('name', 'lastname', 'father', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born', 'city_sodur', 'sh_sh', 'code_melli', 'religion', 'sex' => array('format' => 'type[1:مرد,2:زن]'), 'sarbazi' => array('format' => 'model[Lookup,getById($value,sarbazi)]'), 'married' => array('format' => 'type[1:مجرد,2:متاهل]'), 'tel', 'mobile', 'father_tel', 'takafol', 'address', 'father_address','religion');
			$view -> profile = $jj -> run();
		}
		if ($s -> married == 2) {
			$j = "SELECT * FROM tbl_spouse WHERE clerk_id='$ii'";
			$kk = $e -> queryOne($j);
			if ($kk) {
				$jj -> value = $kk;
				$jj -> numberOfColumns = 4;
				$jj -> headers = array('name', 'lastname', 'sh_sh', 'code_melli', 'father', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born', 'date_married' => array('format' => 'model[Cal,getDate($value)]'), 'study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]'), 'study_field' => array('format' => 'model[StudyField,getById($value)]'));
				$view -> spouse = $jj -> run();
			}
		}
		$e -> setTbl('tbl_employment');
		
		//-----------childs
		$child_query = "SELECT * FROM tbl_child WHERE clerk_id='$ii'";
		$childs = $e -> queryAll($child_query);
		if ($childs) {
			$g = new CGrid;
			$g -> operations = FALSE;
			$g -> values = $childs;
			$g -> headers = array('name', 'code_melli', 'date_born' => array('format' => 'model[Cal,getDate($value)]'), 'city_born');
			if ($h) {$g -> noSort = array('study_degree', 'study_field', 'date_get', 'place');
			}
			$view -> childs = $g -> run();
		}
		//------------end childs
		
		
		$aa = $e -> getByPk($ii);
		if ($aa) {$jj -> value = $aa;
			$jj -> numberOfColumns = 4;
			$jj -> headers = array('hesab', 'bon', 'bimeh', 'date_employed' => array('format' => 'model[Cal,getDate($value)]'), );
			$view -> employment = $jj -> run();
		}
		//------------------------------------
		$j = "SELECT * FROM tbl_education WHERE clerk_id='$ii' ORDER BY date_get";
		$ll = $e -> queryAll($j);
		if ($ll) {$g = new CGrid;
			$g -> operations = FALSE;
			$g -> values = $ll;
			$g -> headers = array('study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]'), 'study_field' => array('format' => 'model[StudyField,getById($value)]'), 'date_get' => array('format' => 'model[Cal,getDate($value,Y)]'), 'place');
			if ($h) {$g -> noSort = array('study_degree', 'study_field', 'date_get', 'place');
			}$view -> education = $g -> run();
		}
		//---------------------------
		$j = "SELECT * FROM tbl_carrier WHERE clerk_id='$ii' ORDER BY start";
		$mm = $e -> queryAll($j);
		if ($mm) {$g = new CGrid;
			$g -> operations = FALSE;
			$g -> values = $mm;
			$g -> headers = array('hokm_type' => array('format' => 'model[Lookup,getById($value,hokm_type)]', 'label' => 'نوع حکم'), 'post' => array('format' => 'model[Lookup,getById($value,post)]', 'label' => 'پست سازمانی'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => 'محل خدمت'), 'start' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ شروع'), 'end' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ پایان'), 'emtiaz_shoghl' => array('label' => 'امتیاز شغل'), );
			if ($h) {$g -> noSort = array('hokm_type', 'post', 'branch_id', 'start', 'end', 'emtiaz_shoghl');
			}
			$view -> carrier = $g -> run();
		}
		$p = new CJcalendar;
		$current_year = $p -> date('Y', FALSE, FALSE) - 1;
		$picquery = $e -> queryOne("SELECT date_employed,picture FROM tbl_employment WHERE clerk_id='$ii'");
		$view -> picture = $picquery -> picture;
		
		//----------------------------------------------------------
		$ff = array();
		for ($counter = $current_year - 3; $counter <= $current_year; $counter++) {
			$j = "SELECT grade,year FROM tbl_evaluation WHERE clerk_id='$ii' AND year='$counter'";
			$hh = $e -> queryOne($j);
			if ($hh)
				$ff[$counter] = $hh -> grade;
			else
				$ff[$counter] = '-';
		}
		$view -> evResult = $ff;
		//----------------------------------------------------------
		
		if ($h) {
			$view -> layout = 'print2';
			$view -> ptitle = '<h1>گزارش جامع اطلاعات ' . Profile::getName($ii) . '</h1>';
			$l = new User;
			$view -> producer = $l -> producer();
		} else {$view -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'clerk/search/' . $ii . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$view -> title = 'گزارش جامع اطلاعات کارمند: ' . Profile::getName($ii);
		$view -> run('clerk/search');
	}

	public function index() {$a = new CForm;
		$view = new CView;
		if (CUrl::segment(3) == 'view') {$view -> title = 'خلاصه وضعیت';
		} else {$view -> title = 'گزارش جامع اطلاعات کارمند';
		}
		if (isset($_POST['submit'])) {$c = new Clerk;
			$n = $c -> getId($_POST['clerk_number']);
			if (!$n) {$a -> setError('clerk_number', 'رکوردی با این شماره کارمندی وجود ندارد.');
			}
			if ($a -> validate() == TRUE) {
				if (CUrl::segment(3) == 'view') {CUrl::redirect('clerk/view/' . $n);
				} else {CUrl::redirect('clerk/search/' . $n);
				}
			}
		}$view -> layout = 'jquery';
		$view -> form = $a -> run();
		$view -> run('clerk/index');
	}

	public function delete() {$d = CUrl::segment(3);
		$nn = array('id' => $d);
		$e = new CDatabase;
		$e -> delete($nn);
		$nn = "WHERE clerk_id='$d'";
		$e -> setTbl('tbl_profile');
		$e -> delete($nn);
		$e -> setTbl('tbl_spouse');
		$e -> delete($nn);
		$e -> setTbl('tbl_child');
		$e -> delete($nn);
		$e -> setTbl('tbl_employment');
		$e -> delete($nn);
		$e -> setTbl('tbl_profile');
		$e -> delete($nn);
		$e -> setTbl('tbl_education');
		$e -> delete($nn);
		$e -> setTbl('tbl_carrier');
		$e -> delete($nn);
		$e -> setTbl('tbl_p_p');
		$e -> delete($nn);
		$e -> setTbl('tbl_training');
		$e -> delete($nn);
		$e -> setTbl('tbl_vacation');
		$e -> delete($nn);
		$e -> setTbl('tbl_vacation_hour');
		$e -> delete($nn);
		CUrl::redirect('clerk/manage');
	}

}
