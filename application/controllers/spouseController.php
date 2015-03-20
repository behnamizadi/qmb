<?php
class spouseController {
    public function index() {$a = new CForm;
        if ($a -> validate()) {CUrl::redirect('spouse/add/' . CUrl::segment(3) . '/' . CUrl::segment(4) . '/' . $_POST['takafol']);
        }$b = new CView;
        $b -> form = $a -> run();
        $b -> title = 'تعداد افراد تحت تکفل';
        $b -> run();
    }

    public function add() {$c = CUrl::segment(3);
        $d = 'SELECT COUNT(*) FROM tbl_spouse WHERE clerk_id=\'' . $c . '\'';
        $e = new CDatabase;
        if ($e -> countRows($d))
            CUrl::redirect('spouse/edit/' . $c);
        $f = CUrl::segment(5);
        $g = CUrl::segment(4);
        $b = new CView;
        if ($f == FALSE) {$d = "SELECT takafol FROM tbl_profile WHERE clerk_id='$c'";
            $e = new CDatabase;
            $h = $e -> queryOne($d);
            if ($h) {$f = $h -> takafol;
                if ($f == 0) {$b -> error = 'این کارمند مجرد می‌باشد یا تعداد افراد تحت تکفل صفر می‌باشد. لطفا ابتدا مشخصات فردی کارمند را ' . CUrl::createLink('ویرایش', 'clerk/edit/profile') . ' نمایید.';
                    $b -> run();
                }
            } else {$b -> error = 'این کارمند مجرد می‌باشد یا تعداد افراد تحت تکفل صفر می‌باشد. لطفا ابتدا مشخصات فردی کارمند را ' . CUrl::createLink('ویرایش', 'clerk/edit/profile') . ' نمایید.';
                $b -> run();
            }
        }$j = $f - 1;
        if ($j < 0)
            CUrl::redirect(404);
        if (Clerk::doesExist($c, $g)) {$a = new CForm;
            $a -> showFieldErrorText = FALSE;
            $a -> dontClose = TRUE;
            if (isset($_POST['submit'])) {$e = new CDatabase;
                $k = new CValidator;
                if ($_POST['study_degree'] == 2 || $_POST['study_degree'] == 3 || $_POST['study_degree'] == 4 || $_POST['study_degree'] == 5 || $_POST['study_degree'] == 6 || $_POST['study_degree'] == 7) {
                    if (empty($_POST['study_field'])) {$a -> setError('study_field', 'لطفا فیلد رشته تحصیلی را انتخاب کنید.');
                    }
                }
                for ($l = 1; $l <= $j; $l++) {
                    if ($k -> required($_POST['ch_name' . $l]) === FALSE) {$a -> setError('ch_name' . $l, 'ورود نام فرزند الزامیست باشد.(فرزند ' . $l . ')');
                    }
                    if ($k -> maxLength($_POST['ch_name' . $l], 30) === FALSE) {$a -> setError('ch_name' . $l, 'نام فرزند نمی‌تواند بیشتر از ۳۰ کاراکتر باشد.(فرزند ' . $l . ')');
                    }
                    if ($k -> required($_POST['ch_code' . $l]) === FALSE) {$a -> setError('ch_code' . $l, 'ورود کد ملی فرزند الزامیست باشد.(فرزند ' . $l . ')');
                    }
                    if ($k -> length($_POST['ch_code' . $l], 10) === FALSE) {$a -> setError('ch_code' . $l, 'کد ملی فرزند باید ۱۰ رقمی باشد.(فرزند ' . $l . ')');
                    }
                    if ($k -> number($_POST['ch_code' . $l]) === FALSE) {$a -> setError('ch_code' . $l, 'کد ملی فرزند باید عددی باشد.(فرزند ' . $l . ')');
                    }
                    if (empty($_POST['y_born' . $l])) {$a -> setError('y_born' . $l, 'لطفا تاریخ تولد را به صورت کامل وارد نمایید.(فرزند.' . $l . ')');
                    }
                    if (empty($_POST['d_born' . $l])) {$a -> setError('d_born' . $l, 'd');
                    }
                    if (empty($_POST['m_born' . $l])) {$a -> setError('m_born' . $l, 'm');
                    }
                    if (empty($_POST['city_born' . $l])) {$a -> setError('city_born' . $l, 'm');
                    }
                    if ($k -> maxLength($_POST['city_born' . $l], 30) === FALSE) {$a -> setError('city_born' . $l, 'v');
                    }
                }
                if ($a -> validate() === TRUE) {$m = new CJcalendar;
                    $e = new CDatabase;
                    $n = $m -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
                    $o = $m -> mktime(0, 0, 0, (int)$_POST['m_married'], (int)$_POST['d_married'], (int)$_POST['y_married']) + 14400;
                    $e -> additional = array('clerk_id' => $c, 'number_of_children' => $j, 'date_born' => $n, 'date_married' => $o);
                    $e -> insert();
                    $p = $e -> lastId();
                    $e -> setTbl('tbl_child');
                    for ($l = 1; $l <= $j; $l++) {$n = $m -> mktime(0, 0, 0, (int)$_POST['m_born' . $l], (int)$_POST['d_born' . $l], (int)$_POST['y_born' . $l]) + 14400;
                        $e -> additional = array('parent_id' => $p, 'clerk_id' => $c, 'name' => $_POST['ch_name' . $l], 'code_melli' => $_POST['ch_code' . $l], 'date_born' => $n, 'city_born' => $_POST['city_born' . $l]);
                        $e -> insert();
                    }CUrl::redirect('employment/add/' . $c . '/' . $g);
                }
            }$b -> title = 'ورود اطلاعات خانواده ' . Profile::getName($c);
            $b -> number_of_children = $j;
            $b -> clerk_id = $c;
            $b -> f = $a;
            $b -> run('spouse/add');
        } else {$b -> error = 'مشکلی در فرایند ثبت به وجود آمده است.';
            $b -> run();
        }
    }

    public function edit() {$c = CUrl::segment(3);
        $b = new CView;
        $q = new Profile;
        if ($q -> hasSpouse($c) == FALSE) {$b -> error = 'این کارمند مجرد می‌باشد یا تعداد افراد تحت تکفل صفر می‌باشد. لطفا ابتدا مشخصات فردی کارمند را ' . CUrl::createLink('ویرایش', 'clerk/edit/profile') . ' نمایید.';
            $b -> run();
        }$e = new CDatabase;
        $e -> pk = 'clerk_id';
        if (($s = $e -> getByPk($c)) == FALSE) {$d = "SELECT time_added FROM tbl_clerk WHERE id='$c'";
            $e = new CDatabase;
            $h = $e -> queryOne($d);
            if ($h) {$t = $h -> time_added;
                CUrl::redirect('spouse/add/' . $c . '/' . $t);
            } else {$b -> error = 'کارمندی با این شماره کارمندی وجود ندارد یا مشخصات خانواده کارمند ثبت نشده است.';
                $b -> run();
            }
        }$m = new CJcalendar(FALSE);
        $u = new StudyField;
        $b -> mb = $m -> date('m', $s -> date_born);
        $b -> db = $m -> date('d', $s -> date_born);
        $b -> yb = $m -> date('Y', $s -> date_born);
        $b -> mm = $m -> date('m', $s -> date_married);
        $b -> dm = $m -> date('d', $s -> date_married);
        $b -> ym = $m -> date('Y', $s -> date_married);
        $b -> study_field = Spouse::getStudyField($c);
        $b -> sfs = $u -> getByDegree($s -> study_degree);
        $a = new CForm;
        $a -> showFieldErrorText = FALSE;
        if ($a -> validate()) {$n = $m -> mktime(0, 0, 0, (int)$_POST['m_born'], (int)$_POST['d_born'], (int)$_POST['y_born']) + 14400;
            $o = $m -> mktime(0, 0, 0, (int)$_POST['m_married'], (int)$_POST['d_married'], (int)$_POST['y_married']) + 14400;
            $e -> additional = array('date_born' => $n, 'date_married' => $o);
            $e -> update(array('clerk_id' => $c));
            CUrl::redirect('clerk/manage');
        }$b -> model = $s;
        $b -> clerk_id = $c;
        $b -> title = 'ویرایش اطلاعات خانواده ' . Profile::getName($c);
        $b -> form = $a -> run();
        $b -> run('spouse/edit');
    }

}
?>