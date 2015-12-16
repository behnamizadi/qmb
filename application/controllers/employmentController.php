<?php
class employmentController {
    public function add() {$a = CUrl::segment(3);
        $b = 'SELECT COUNT(*) FROM tbl_employment WHERE clerk_id=\'' . $a . '\'';
        $c = new CDatabase;
        if ($c -> countRows($b))
            CUrl::redirect('employment/edit/' . $a);
        $d = CUrl::segment(4);
        $e = new CView;
        if (Clerk::doesExist($a, $d)) {
			$f = new CForm;
            $f -> type = 'multipart/form-data';
            $f -> showFieldErrorText = FALSE;
            $g = new CValidator;
            if ($g -> unique('tbl_employment', 'clerk_id', $a) === FALSE) {$e -> error = 'برای این کد قبلا کارمندی سابقه اطلاعات شغلی وارد شده است. برای ویرایش اطلاعات سابقه شغلی کارمند مذکور روی این ' . CUrl::createLink('لینک', 'employment/edit/' . $a) . '‌ کلیک کنید';
                $e -> run();
            }
            if (isset($_POST['submit'])) {$h = new CUpload;
                $h -> allowedType = array('gif', 'jpeg', 'jpg', 'png', 'jpe', 'pjpeg', 'JPG', 'JPEG', 'GIF', 'PNG', 'JPE', 'PJPEG');
                $h -> maxSize = 52224;
                if ($h -> run('picture') === FALSE) {
                    if ($h -> errorType == CUpload::EXT) {$f -> setError('picture', 'فرمت های مجاز jpg،png،gif می‌باشند.');
                    } elseif ($h -> errorType == CUpload::MAX_SIZE) {$f -> setError('picture', 'حداکثر اندازه عکس، ۵۰ کیلوبایت می‌باشد.');
                    } else {$f -> setError('picture', $h -> errorMessage);
                    }
                } else {$i = $a . '_' . CGeneral::generateRandom(3) . '.' . $h -> extension;
                    if (!$h -> saveAs(ROOT . 'pics/' . $i)) {$f -> setError('picture', 'مشکلی در آپلود فایل پیش آمده است.');
                    }
                }
                if ($f -> validate() === TRUE && empty($j)) {$c = new CDatabase;
                    $k = new CJcalendar;
                    $l = $k -> mktime(0, 0, 0, (int)$_POST['m_employed'], (int)$_POST['d_employed'], (int)$_POST['y_employed']) + 14400;
                    $c -> additional = array('date_employed' => $l, 'picture' => $i, 'date_retired' => 0, 'clerk_id' => $a);
                    $c -> insert();
                    CUrl::redirect('education/add/' . $a . '/' . $d);
                }
            }$e -> title = 'اطلاعات پایه‌ای شغل ' . Profile::getName($a);
            $e -> form = $f -> run();
            $e -> run('employment/add');
        } else {$e -> error = 'مشکلی در فرایند ثبت به وجود آمده است.';
            $e -> run();
        }
    }

    public function edit() {$a = CUrl::segment(3);
        $c = new CDatabase;
        if (($m = $c -> getByPk($a)) == FALSE)
            CUrl::redirect(404);
        $e = new CView;
        $e -> model = $m;
        $k = new CJcalendar(FALSE);
        $e -> m = $k -> date('m', $m -> date_employed);
        $e -> d = $k -> date('d', $m -> date_employed);
        $e -> y = $k -> date('Y', $m -> date_employed);
        $n = new Clerk;
        $e -> clerk_number = $n -> getClerkNumber($a);
        $f = new CForm;
        $f -> dontClose = TRUE;
        $f -> showFieldErrorText = FALSE;
        $f -> type = 'multipart/form-data';
        $i = Employment::getPicture($a);
        if (isset($_POST['submit'])) {$h = new CUpload;
            $h -> allowedType = array('gif', 'jpeg', 'jpg', 'png', 'jpe', 'pjpeg');
            $h -> maxSize = 52224;
            if ($h -> run('picture', FALSE) === FALSE) {
                if ($h -> errorType == CUpload::EXT) {$f -> setError('picture', 'فرمت های مجاز jpg،png،gif می‌باشند.');
                } elseif ($h -> errorType == CUpload::MAX_SIZE) {$f -> setError('picture', 'حداکثر اندازه عکس، ۵۰ کیلوبایت می‌باشد.');
                } else {$f -> setError('picture', $h -> errorMessage);
                }
            } elseif ($h -> error == UPLOAD_ERR_OK) {$i = $a . '_' . CGeneral::generateRandom(3) . '.' . $h -> extension;
                if (!$h -> saveAs(ROOT . 'pics/' . $i)) {$f -> setError('picture', 'مشکلی در آپلود فایل پیش آمده است.');
                }
            }
            if ($f -> validate() === TRUE) {$k = new CJcalendar;
                $l = $k -> mktime(0, 0, 0, (int)$_POST['m_employed'], (int)$_POST['d_employed'], (int)$_POST['y_employed']);
                $c -> additional = array('date_employed' => $l, 'picture' => $i);
                $c -> update(array('clerk_id' => $a));
                $c -> setTbl('tbl_clerk');
                $c -> update(array('id' => $a), array('clerk_number' => $_POST['clerk_number']));
                CUrl::redirect('clerk/manage');
            }
        }$e -> form = $f;
        $e -> clerk_id = $a;
        $e -> fileName = $i;
        $e -> title = 'ویرایش اطلاعات شغلی ' . Profile::getName($a);
        $e -> run('employment/edit');
    }

    public function bimeh() {$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.bimeh 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
        $o = new CGrid;
        $o -> counter = TRUE;
        $o -> operations = FALSE;
        $o -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'bimeh' => array('label' => 'شماره بیمه'), );
        $c = new CDatabase;
        $o -> values = $c -> queryAll($b);
        $e = new CView;
        $e -> grid = $o -> run();
        $e -> title = 'شماره بیمه کارمندان';
        $e -> run();
    }

    public function date_employed() {$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.date_employed 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
        $o = new CGrid;
        $o -> counter = TRUE;
        $o -> operations = FALSE;
        $o -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'date_employed' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ استخدام'), );
        $c = new CDatabase;
        $o -> values = $c -> queryAll($b);
        $e = new CView;
        $e -> grid = $o -> run();
        $e -> title = 'تاریخ استخدام کارمندان';
        $e -> run();
    }

    public function hesab() {
        $b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.hesab 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
        $o = new CGrid;
        $o -> counter = TRUE;
        $o -> operations = FALSE;
        $o -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'hesab' => array('label' => 'شماره حساب'), );
        $c = new CDatabase;
        $o -> values = $c -> queryAll($b);
        $e = new CView;
        $e -> grid = $o -> run();
        $e -> title = 'شماره حساب کارمندان';
        $e -> run();
    }

    public function bon() {$b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.bon 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
        $o = new CGrid;
        $o -> counter = TRUE;
        $o -> operations = FALSE;
        $o -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'bon' => array('label' => 'شماره بن‌کارت'), );
        $c = new CDatabase;
        $o -> values = $c -> queryAll($b);
        $e = new CView;
        $e -> grid = $o -> run();
        $e -> title = 'شماره بن‌کارت کارمندان';
        $e -> run();
    }

    public function mixed() {$print = FALSE;
        if (CUrl::segment(3) === 'print')
            $print = TRUE;
        $b = "SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_employment.bon,tbl_employment.hesab,tbl_employment.date_employed,tbl_employment.bimeh 
        FROM tbl_clerk,tbl_profile,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id ORDER BY tbl_clerk.clerk_number";
        $o = new CGrid;
        $o -> counter = TRUE;
        $o -> operations = FALSE;
        $o -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'date_employed' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ استخدام'), 'hesab' => array('label' => 'شماره حساب'), 'bon' => array('label' => 'شماره بن‌کارت'), 'bimeh' => array('label' => 'شماره بیمه'), );
        $c = new CDatabase;
        $o -> values = $c -> queryAll($b);
        $e = new CView;
        $q = 'اطلاعات کلی کارمندان';
        $e -> title = $q;
        if ($print) {$o -> operations = FALSE;
            $o -> noSort = TRUE;
            $o -> paginate = FALSE;
            $e -> layout = 'print';
            $e -> ptitle = "<h1>$q</h1>";
            $r = new User;
            $e -> producer = $r -> producer();
        } else {$e -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'employment/mixed/print', 'class="btn btn-primary" target="_blank"') . '</p></center>';
        }$e -> grid = $o -> run();
        $e -> run();
    }

}
