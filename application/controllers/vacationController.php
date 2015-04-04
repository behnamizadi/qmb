<?php
class vacationController {
    public function proccess_yearly() {
        $clerk_id = $_REQUEST['clerk_id'];
        $action = (isset($_REQUEST["action"])) ? $_REQUEST["action"] : '';
        switch ($action) {
            case 'list' :
                echo Vacation::listYearlyVacation($clerk_id);
                break;
            case 'create' :
                echo Vacation::createYearlyVacation(array('clerk_id' => $clerk_id, 'year' => $_REQUEST['year'], 'all_v' => $_REQUEST['all_v'], 'used' => $_REQUEST['used'], 'wasted' => $_REQUEST['wasted'], 'saved' => $_REQUEST['saved']));
                break;
            case 'update' :
                echo Vacation::updateYearlyVacation(array('clerk_id' => $clerk_id, 'year' => $_REQUEST['year'], 'all_v' => $_REQUEST['all_v'], 'used' => $_REQUEST['used'], 'wasted' => $_REQUEST['wasted'], 'saved' => $_REQUEST['saved']));
                break;
            case 'delete' :
                Vacation::deleteYearlyVacation($clerk_id, $_REQUEST['year']);
                break;
            default :
                echo 1;
                break;
        }
    }

    public function yearly() {
        $view = new CView;
        $view -> title = Resource::get('yearly vacation');
        $view -> run('vacation/yearly');
    }

    public function hourly() {

    }

    public function daily() {

    }

    public function index() {
        $a = new CView;
        if (CUrl::segment(3) == 'add') {$b = new CForm('addindex');
            $a -> title = 'ثبت مرخصی';
            $a -> info = 'لطفا برای ثبت مرخصی‌های قبل از سال ۱۳۹۲ از قسمت ' . CUrl::createLink('«ثبت مرخصی سالانه»', 'vacation/index/addyear') . ' استفاده نمایید.';
        } elseif (CUrl::segment(3) == 'addyear') {$a -> title = 'ثبت مرخصی سالانه';
            $b = new CForm('addindex2');
            $a -> info = 'این قسمت برای تسریع در ثبت مرخصی‌های سال‌های قبل(قبل از سال ۱۳۹۲) که نیازی به جزئیاتشان احساس نمی‌شود، طراحی شده است. لطفا برای ثبت مرخصی امسال از ' . CUrl::createLink('«ثبت مرخصی»', 'vacation/index/add') . ' استفاده نمایید.';
        } else {$c = new CJcalendar;
            $a -> title = 'گزارش مرخصی کارمند';
            $a -> y = $c -> date('Y', FALSE, FALSE);
            $b = new CForm();
            $a -> info = 'در صورت عدم انتخاب سال کل مرخصی‌های کارمند نمایش داده خواهد شد.';
        }
        $b -> showFieldErrorText = FALSE;
        if (isset($_POST['submit'])) {$d = new Clerk;
            $e = $d -> getId($_POST['clerk_number']);
            if (!$e) {$b -> showFieldErrorText = TRUE;
                $b -> setError('clerk_number', 'رکوردی با این کد پرسنلی وجود ندارد.');
            }$f = isset($_POST['year']) ? $_POST['year'] : 0;
            if ($b -> validate() == TRUE) {
                if (CUrl::segment(3) == 'add')
                    CUrl::redirect('vacation/add/' . $e);
                if (CUrl::segment(3) == 'addyear') {CUrl::redirect('vacation/addyear/' . $e . '/' . $f);
                }CUrl::redirect('vacation/summ/' . $e . '/' . $f);
            }
        }$a -> form = $b -> run();
        $a -> run('vacation/index');
    }

    public function index2() {
        $b = new CForm;
        $b -> showFieldErrorText = FALSE;
        $a = new CView;
        if ($b -> validate()) {
            if (isset($_POST['vacation_type'])) {CUrl::redirect('vacation/all/' . $_POST['year'] . '/' . $_POST['vacation_type']);
            } else {CUrl::redirect('vacation/all/' . $_POST['year']);
            }
        }$c = new CJcalendar;
        $a -> y = $c -> date('Y', FALSE, FALSE);
        $a -> form = $b -> run();
        $a -> title = 'گزارش مرخصی کل کارمندان';
        $a -> run();
    }

    public function edit() {
        $g = new CDatabase;
        $h = CUrl::segment(3);
        if (($i = $g -> getByPk($h)) == FALSE)
            CUrl::redirect(404);
        $b = new CForm;
        $b -> showFieldErrorText = FALSE;
        $c = new CJcalendar(FALSE);
        if ($b -> validate()) {$j = $c -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']) + 14400;
            $k = ($_POST['period'] + $_POST['off_day']) * 24 * 3600;
            $m = $j + $k - 28800;
            $n = $_POST['description'];
            if ($_POST['off_day'] > 0)
                $n .= ' ' . $_POST['off_day'] . ' روز تعطیلی بین مرخصی';
            $g -> additional = array('date_start' => $j, 'date_end' => $m, 'description' => $n);
            $g -> update(array('id' => $h));
            CUrl::redirect('vacation/summ/' . CUrl::segment(4) . '/' . CUrl::segment(5));
        }$a = new CView;
        $a -> m = $c -> date('m', $i -> date_start);
        $a -> d = $c -> date('d', $i -> date_start);
        $a -> y = $c -> date('Y', $i -> date_start);
        $a -> model = $i;
        $a -> form = $b -> run();
        $a -> run();
    }

    public function search1() {
        $b = new CForm;
        $b -> showFieldErrorText = FALSE;
        $a = new CView;
        $a -> title = 'گزارش مرخصی';
        $a -> info = 'برای مرخصی‌های قبل از سال ۱۳۹۲، نوع مرخصی فقط استحقاقی در نظر گرفته خواهد شد.
		<br/>
		برای مشاهده مجموع مرخصی کارمندان از گزارش کل مرخصی کارمندان استفاده نمایید. نتیجه این گزارش برای مرخصی(و نه مجموع مرخصی‌ها) می‌باشد.
		<br/>
		«بیشتر» یا «کمتر» به معنی خود می‌باشند و مساوی را شامل نمی‌شوند. برای شمول مساوی یک رقم کمتر یا بیشتر از عدد مورد نظرتان را وارد نمایید.';
        if ($b -> validate()) {$o = !empty($_POST['type']) ? $_POST['type'] : 0;
            $p = !empty($_POST['period_range']) ? $_POST['period_range'] : 0;
            $k = !empty($_POST['period']) ? $_POST['period'] : 0;
            CUrl::redirect('vacation/search/' . $o . '/' . $_POST['y_start'] . '/' . $p . '/' . $k);
        }$a -> form = $b -> run();
        $a -> run();
    }

    public function search() {
        $f = CUrl::segment(4);
        if (!$f)
            CUrl::redirect('vacation/search1');
        $o = CUrl::segment(3);
        $p = CUrl::segment(5);
        $k = CUrl::segment(6);
        $a = new CView;
        $g = new CDatabase;
        $q = '';
        $r = '';
        if ($f < 1392) {$a -> info = '';
            $f = $g -> escape($f);
            $s = "tbl_vacation_year.year='$f'";
            if (!empty($k)) {
                switch($p) {case  "less" :
                        $t = 'tbl_vacation_year.used < ' . $g -> escape($k);
                        $r = '- کمتر از ' . $k . ' روز ';
                        break;
                    case  'more' :
                        $t = 'tbl_vacation_year.used > ' . $g -> escape($k);
                        $r = '- بیشتر از ' . $k . ' روز ';
                        break;
                    case  'equal' :
                        $t = 'tbl_vacation_year.used = \'' . $g -> escape($k) . '\'';
                        $r = '-' . $k . ' روز ';
                        break;
                }
            }
            if (isset($s)) {$q .= ' AND ' . $s;
                if (isset($t))
                    $q .= ' AND ' . $t;
            } elseif (isset($t)) {$q .= ' AND ' . $t;
            }
            $u = 'SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_vacation_year.* FROM tbl_profile,tbl_vacation_year,tbl_clerk  
						WHERE tbl_profile.clerk_id=tbl_vacation_year.clerk_id AND tbl_clerk.id=tbl_vacation_year.clerk_id ' . $q;
            $v = new CGrid;
            $v -> operations = FALSE;
            $v -> values = $g -> queryAll($u);
            $v -> counter = TRUE;
            $v -> sort = 'used DESC';
            $v -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'year' => array('label' => 'سال'), 'all_v' => array('label' => 'کل مرخصی'), 'used' => array('label' => 'استفاده شده'), 'saved' => array('label' => 'ذخیره شده', ), );
            $a -> grid = $v -> run();
            $a -> run();
        } else {
            if (!empty($o)) {$x = "tbl_vacation.type='$o'";
            }$c = new CJcalendar;
            $z = $c -> mktime(0, 0, 0, 1, 1, $f);
            $aa = $z + 365 * 86400 + 86399;
            $s = "tbl_vacation.date_start Between $z AND $aa";
            if (!empty($k)) {
                switch($p) {case  "less" :
                        $t = 'tbl_vacation.period < ' . $g -> escape($k);
                        $r = '- کمتر از ' . $k . ' روز ';
                        break;
                    case  'more' :
                        $t = 'tbl_vacation.period > ' . $g -> escape($k);
                        $r = '- بیشتر از -' . $k . ' روز ';
                        break;
                    case  'equal' :
                        $t = 'tbl_vacation.period = \'' . $g -> escape($k) . '\'';
                        $r = '-' . $k . ' روز ';
                        break;
                }
            }
            if (isset($x)) {$q .= ' AND ' . $x;
                if (isset($s))
                    $q .= ' AND ' . $s;
                if (isset($t))
                    $q .= ' AND ' . $t;
            } elseif (isset($s)) {$q .= ' AND ' . $s;
                if (isset($t))
                    $q .= ' AND ' . $t;
            } elseif (isset($t)) {$q .= ' AND ' . $t;
            }
            if ($q) {$u = 'SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_vacation.clerk_id,SUM(tbl_vacation.period) FROM tbl_profile,tbl_vacation,tbl_clerk  
						WHERE tbl_profile.clerk_id=tbl_vacation.clerk_id AND tbl_clerk.id=tbl_vacation.clerk_id ' . $q . ' GROUP BY tbl_vacation.clerk_id ORDER BY SUM(tbl_vacation.period)';
                $v = new CGrid;
                $v -> values = $g -> queryAll($u);
                $v -> operations = FALSE;
                $v -> counter = TRUE;
                $v -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'SUM(tbl_vacation.period)' => array('format' => ' روز', 'label' => 'مدت مرخصی'), );
                $bb = new Lookup;
                $cc = $bb -> getById($o, 'vacation');
                $dd = ' گزارش مرخصی ' . $cc . $r . '-سال ' . $f;
                $ee = FALSE;
                if (CUrl::segment(7) === 'print')
                    $ee = TRUE;
                if ($ee) {$v -> operations = FALSE;
                    $v -> noSort = TRUE;
                    $v -> paginate = FALSE;
                    $a -> layout = 'print';
                    $a -> ptitle = '<h1>' . $dd . '</h1>';
                    $ff = new User;
                    $a -> producer = $ff -> producer();
                } else {$o = !empty($o) ? $o : 0;
                    $k = !empty($k) ? $k : 0;
                    $a -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'vacation/search/' . $o . '/' . $f . '/' . $p . '/' . $k . '/print', 'class="box" target="_blank"') . '</p></center>';
                }$a -> title = $dd;
                $a -> grid = $v -> run();
                $a -> run();
            }
        }
    }

    public function t_search1() {
        $b = new CForm;
        $b -> showFieldErrorText = FALSE;
        $a = new CView;
        $a -> title = 'گزارش زمانی مرخصی';
        if ($b -> validate()) {$o = !empty($_POST['type']) ? $_POST['type'] : 0;
            CUrl::redirect('vacation/t_search/' . $o . '/' . $_POST['y_start'] . '/' . $_POST['m_start'] . '/' . $_POST['d_start'] . '/' . $_POST['y_end'] . '/' . $_POST['m_end'] . '/' . $_POST['d_end']);
        }$a -> form = $b -> run();
        $a -> run();
    }

    public function t_search() {
        $o = CUrl::segment(3);
        $gg = CUrl::segment(4);
        $hh = CUrl::segment(5);
        $ii = CUrl::segment(6);
        $jj = CUrl::segment(7);
        $kk = CUrl::segment(8);
        $ll = CUrl::segment(9);
        $ee = FALSE;
        if (CUrl::segment(10) === 'print')
            $ee = TRUE;
        if (!$gg || !$hh || !$ii || !$jj || !$kk || !$ll)
            CUrl::redirect('vacation/t_search1');
        $a = new CView;
        $bb = new Lookup;
        $cc = $bb -> getById($o, 'vacation');
        $dd = "گزارش مرخصی $cc کارمندان از تاریخ $gg/$hh/$ii تا تاریخ $jj/$kk/$ll";
        $a -> title = $dd;
        $q = '';
        if (!empty($o)) {$x = "tbl_vacation.type='$o'";
        }$c = new CJcalendar;
        $z = $c -> mktime(0, 0, 0, $hh, $ii, $gg);
        $mm = $c -> mktime(23, 59, 59, $kk, $ll, $jj);
        if (isset($x))
            $q = ' AND ' . $x;
        $q .= ' AND date_start >= ' . $z . ' AND date_end <= ' . $mm;
        $u = 'SELECT tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_vacation.clerk_id,SUM(tbl_vacation.period) FROM tbl_profile,tbl_vacation,tbl_clerk  
						WHERE tbl_profile.clerk_id=tbl_vacation.clerk_id AND tbl_clerk.id=tbl_vacation.clerk_id ' . $q . ' GROUP BY tbl_vacation.clerk_id ORDER BY SUM(tbl_vacation.period) DESC';
        $g = new CDatabase;
        $v = new CGrid;
        $v -> values = $g -> queryAll($u);
        $v -> operations = FALSE;
        $v -> counter = TRUE;
        $v -> headers = array('clerk_number' => array('label' => 'کد پرسنلی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'SUM(tbl_vacation.period)' => array('format' => ' روز', 'label' => 'مدت مرخصی'), );
        if ($ee) {$v -> operations = FALSE;
            $v -> noSort = TRUE;
            $v -> paginate = FALSE;
            $a -> layout = 'print';
            $a -> ptitle = '<h1>' . $dd . '</h1>';
            $ff = new User;
            $a -> producer = $ff -> producer();
        } else {$o = !empty($o) ? $o : 0;
            $a -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'vacation/t_search/' . $o . '/' . $gg . '/' . $hh . '/' . $ii . '/' . $jj . '/' . $kk . '/' . $ll . '/print', 'class="box" target="_blank"') . '</p></center>';
        }$a -> grid = $v -> run();
        $a -> run();
    }

    public function delete() {
        $g = new CDatabase;
        $g -> delete(array('id' => CUrl::segment(3)));
        CUrl::redirect('vacation/summ/' . CUrl::segment(4) . '/' . CUrl::segment(5));
    }

    public function summ() {$clerk_id = CUrl::segment(3);
        if (!$clerk_id)
            CUrl::redirect('vacation/index');
        $v = new CGrid;
        $v -> counter = TRUE;
        $c = new CJcalendar(FALSE);
        if (($oo = CUrl::segment(4)) !== FALSE) {$f = $c -> mktime(0, 0, 0, 1, 1, $oo);
            $aa = $f + 31536000;
            if ($c -> checkdate(12, 30, (int)$oo))
                $aa += 86400;
            $v -> condition = "WHERE date_start BETWEEN $f AND $aa AND clerk_id='$clerk_id'";
        } else {$v -> condition = "WHERE clerk_id='$clerk_id'";
        }$v -> operations = array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'vacation/edit/$value->id/' . $clerk_id . '/' . $oo => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'vacation/delete/$value->id/' . $clerk_id . '/' . $oo => array('icon' => 'public/images/delete.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), );
        $v -> sort = 'hokm_number DESC';
        $v -> headers = array('date_added' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ حکم'), 'hokm_number', 'date_start' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ شروع'), 'date_end' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ پایان'), 'period', 'type' => array('format' => 'model[Lookup,getById($value,vacation)]', ), 'description');
        $a = new CView;
        $pp = new CDetail;
        $pp -> value = FALSE;
        if (empty($oo)) {$oo = $c -> date('Y', FALSE, FALSE);
        }$qq = $v -> run();
        if ($qq == CGrid::NOTFOUND && $oo < 1392) {$qq = '';
            $pp -> additional = Vacation::getStat($clerk_id, $oo, TRUE);
        } else {$pp -> additional = Vacation::getStat($clerk_id, $oo);
        }$a -> grid = $qq;
        $a -> c_id = $clerk_id;
        $a -> title = 'گزارش مرخصی ' . Profile::getName($clerk_id);
        $a -> y = $oo;
        $pp -> numberOfColumns = 3;
        $a -> detail = $pp -> run();
        $a -> run('vacation/summ');

    }

    public function summprint() {
        $clerk_id = CUrl::segment(3);
        if (!$clerk_id)
            CUrl::redirect('vacation/index');
        $v = new CGrid;
        $v -> counter = TRUE;
        $c = new CJcalendar(FALSE);
        if (($oo = CUrl::segment(4)) !== FALSE) {$f = $c -> mktime(0, 0, 0, 1, 1, $oo);
            $aa = $f + 31536000;
            if ($c -> checkdate(12, 30, (int)$oo))
                $aa += 86400;
            $v -> condition = "WHERE date_start BETWEEN $f AND $aa AND clerk_id='$clerk_id'";
        } else {$v -> condition = "WHERE clerk_id='$clerk_id'";
        }$v -> sort = 'hokm_number DESC';
        $v -> headers = array('date_added' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ حکم'), 'hokm_number', 'date_start' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ شروع'), 'date_end' => array('format' => 'model[Cal,getDate($value)]', 'label' => 'تاریخ پایان'), 'period' => array('format' => ' روز'), 'type' => array('format' => 'model[Lookup,getById($value,vacation)]', ), );
        $v -> operations = FALSE;
        $v -> noSort = array('date_added', 'hokm_number', 'date_start', 'date_end', 'period', 'type');
        $v -> paginate = FALSE;
        $a = new CView;
        $dd = Profile::getName($clerk_id);
        if ($oo) {$dd .= ' در سال ' . $oo;
        }$a -> title = $dd;
        $pp = new CDetail;
        $pp -> numberOfColumns = 3;
        $pp -> value = FALSE;
        if (empty($oo)) {$oo = $c -> date('Y', FALSE, FALSE);
        }$qq = $v -> run();
        if ($qq == CGrid::NOTFOUND && $oo < 1392) {$qq = '';
            $pp -> additional = Vacation::getStat($clerk_id, $oo, TRUE);
        } else {$pp -> additional = Vacation::getStat($clerk_id, $oo);
        }$a -> detail = $pp -> run();
        $a -> layout = 'vacationview';
        $a -> grid = $v -> run();
        $ff = new User;
        $a -> producer = $ff -> producer();
        $a -> y = $oo;
        $a -> run();
    }

    public function all() {
        $ONE_DAY = 86400;
        $ONE_YEAR = 31536000;
        $year = CUrl::segment(3);
        $vac_type = CUrl::segment(4);
        $is_print = FALSE;
        if (CUrl::segment(5) === 'print')
            $is_print = TRUE;
        $year = (int)$year;
        if (!$year)
            CUrl::redirect('vacation/index2');
        $a = new CView;
        $c = new CJcalendar(FALSE);
        $f = $c -> mktime(0, 0, 0, 1, 1, $year);
        $aa = $f + $ONE_YEAR;
        if ($c -> checkdate(12, 30, $year))
            $aa += $ONE_DAY;
        $u = "SELECT tbl_profile.clerk_id,tbl_profile.name,tbl_profile.lastname FROM tbl_profile,tbl_carrier 
		WHERE tbl_carrier.clerk_id=tbl_profile.clerk_id AND tbl_carrier.job_status='1' AND tbl_carrier.now_c='1' AND  tbl_carrier.hokm_type<>8";
        $g = new CDatabase;
        $clercks = $g -> queryAll($u);
        $qq = array();
        foreach ($clercks as $clerck) {
            $u = "SELECT clerk_number FROM tbl_clerk WHERE id='$clerck->clerk_id'";
            $clerk_number = $g -> queryOne($u) -> clerk_number;
            $u = "SELECT * FROM tbl_vacation_year WHERE clerk_id='$clerck->clerk_id' AND year='$year'";
            if (($vv = $g -> queryOne($u)) !== FALSE) {
                $ww = $vv -> all_v - $vv -> used;
                $qq[] = (object) array('clerk_id' => $clerck -> clerk_id, 'clerk_number' => $clerk_number, 'name' => $clerck -> name, 'lastname' => $clerck -> lastname, 'used' => $vv -> used, 'remaining' => $ww, 'wasted' => $vv -> wasted, 'saved' => $vv -> saved);
            } else {
                $u = "SELECT date_employed FROM tbl_employment WHERE clerk_id='$clerck->clerk_id'";
                $xx = $g -> queryOne($u) -> date_employed;
                if ($c -> date('Y', $xx) <= $year) {
                    $u = "SELECT SUM(period) FROM tbl_vacation WHERE clerk_id='$clerck->clerk_id' AND date_start BETWEEN $f AND $aa AND type='$vac_type'";
                    $used = $g -> sumRows('period', $u);
                    if ($year >= 1392) {$zz = 26;
                        if ($year == $c -> date('Y', $xx)) {$aaa = $c -> date('d', $xx);
                            $zz = (12 - $c -> date('m', $xx)) * 2.17;
                            if ($aaa > 1 && $aaa <= 5)
                                $zz += 2.17;
                            elseif ($aaa > 5 && $aaa <= 10)
                                $zz += 1.74;
                            elseif ($aaa > 10 && $aaa <= 15)
                                $zz += 1.31;
                            elseif ($aaa > 15 && $aaa <= 20)
                                $zz += 0.88;
                            elseif ($aaa > 20 && $aaa <= 25)
                                $zz += 0.45;
                        }
                    } else {$zz = 30;
                        if ($year == $c -> date('Y', $xx)) {$aaa = $c -> date('d', $xx);
                            $zz = (12 - $c -> date('m', $xx)) * 2.5;
                            if ($aaa > 1 && $aaa <= 5)
                                $zz += 2.5;
                            elseif ($aaa > 5 && $aaa <= 10)
                                $zz += 2;
                            elseif ($aaa > 10 && $aaa <= 15)
                                $zz += 1.5;
                            elseif ($aaa > 15 && $aaa <= 20)
                                $zz += 1;
                            elseif ($aaa > 20 && $aaa <= 25)
                                $zz += 0.5;
                        }
                    }
                    $ww = $zz - $used;
                    if ($ww > 15) {$bbb = 15;
                        $ccc = $ww - 15;
                    } else {$bbb = $ww;
                        $ccc = 0;
                    }
                    $used = round($used);
                    $qq[] = (object) array('clerk_id' => $clerck -> clerk_id, 'clerk_number' => $clerk_number, 'name' => $clerck -> name, 'lastname' => $clerck -> lastname, 'used' => $used, 'remaining' => round($ww), 'wasted' => round($ccc), 'saved' => round($bbb));
                }
            }
        }//end foreach
        $v = new CGrid;
        $v -> sort = 'used DESC';
        $v -> operations = array('edit' => FALSE, 'delete' => FALSE, 'view' => FALSE, 'vacation/summ/$value->clerk_id/' . $year => array('in' => 'target="_blank"', 'icon' => 'public/images/view.png', 'alt' => 'مشاهده', 'title' => 'مشاهده'));
        $v -> pk = 'clerk_id';
        $v -> values = $qq;
        $v -> counter = TRUE;
        if ($vac_type != 1) {$v -> headers = array('name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'clerk_number' => array('label' => 'کد پرسنلی'), 'used' => array('label' => 'تعداد روزهای استفاده شده'), );
        } else {
            if ($c -> date('Y') == (int)$year) {$v -> headers = array('name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'clerk_number' => array('label' => 'کد پرسنلی'), 'used' => array('label' => 'تعداد روزهای استفاده شده'), 'remaining' => array('label' => 'مانده مرخصی'), 'saved' => array('label' => 'قایل ذخیره در سال جاری'), );
            } else {$v -> headers = array('name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'clerk_number' => array('label' => 'کد پرسنلی'), 'used' => array('label' => 'تعداد روزهای استفاده شده'), 'remaining' => array('label' => 'مانده مرخصی'), 'wasted' => array('label' => 'سوخت شده'), 'saved' => array('label' => 'قایل ذخیره در سال جاری'), );
            }
        }$a = new CView;
        $bb = new Lookup;
        $cc = $bb -> getById($vac_type, 'vacation');
        if ($year < 1393)
            $dd = 'گزارش مرخصی ' . $cc . ' کل کارمندان سال ' . $year . ' تا تاریخ ' . $year . '/12/29';
        else
            $dd = 'گزارش مرخصی ' . $cc . ' کل کارمندان سال ' . $year . ' تا تاریخ ' . $c -> date('Y/m/d');
        if ($is_print) {
            $v -> operations = FALSE;
            $v -> noSort = TRUE;
            $v -> paginate = FALSE;
            $a -> layout = 'print';
            $a -> ptitle = "<h1>$dd</h1>";
            $ff = new User;
            $a -> producer = $ff -> producer();
        } else {
            $a -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'vacation/all/' . $year . '/' . $vac_type . '/print', 'target="_blank"') . '</p></center>';
        }
        $a -> grid = $v -> run();
        $a -> title = $dd;
        $a -> run();
    }

    public function add() {
        $clerk_id = CUrl::segment(3);
        if (!$clerk_id)
            CUrl::redirect('vacation/index/add');
        $b = new CForm;
        $b -> showFieldErrorText = FALSE;
        $c = new CJcalendar;
        if ($b -> validate()) {
            $g = new CDatabase;
            $j = $c -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']) + 14400;
            if ($_POST['type'] == 6) {$g -> setTbl('tbl_vacation_hour');
                $g -> additional = array('clerk_id' => $clerk_id, 'date_start' => $j);
                $g -> insert();
                $this -> checkHour($j, $clerk_id);
            } else {$k = ($_POST['period'] + $_POST['off_day']) * 24 * 3600;
                $m = $j + $k - 28800;
                $u = "SELECT hokm_number FROM tbl_vacation ORDER BY id DESC LIMIT 0,1";
                $ddd = $g -> queryOne($u);
                if (!$ddd)
                    $ddd = 1;
                else
                    $ddd = $ddd -> hokm_number + 1;
                $n = $_POST['description'];
                if ($_POST['off_day'] > 0)
                    $n .= ' ' . $_POST['off_day'] . ' روز تعطیلی بین مرخصی';
                $g -> additional = array('clerk_id' => $clerk_id, 'date_start' => $j, 'date_end' => $m, 'hokm_number' => $ddd, 'date_added' => time(), 'description' => $n);
                $g -> insert();
            }$oo = $c -> date('Y', FALSE, FALSE);
            CUrl::redirect('vacation/summ/' . $clerk_id . '/' . $oo);
        }$a = new CView;
        $a -> y = $c -> date('Y', FALSE, FALSE);
        $a -> m = $c -> date('m', FALSE, FALSE);
        $a -> d = $c -> date('d', FALSE, FALSE);
        $a -> form = $b -> run();
        $a -> c_id = $clerk_id;
        $a -> title = 'ثبت مرخصی برای ' . Profile::getName($clerk_id);
        $a -> run('vacation/add');
    }

    public function addyear() {
        $clerk_id = CUrl::segment(3);
        $f = CUrl::segment(4);
        if (!$clerk_id || !$f)
            CUrl::redirect('vacation/index/addyear');
        $b = new CForm;
        $b -> showFieldErrorText = FALSE;
        $a = new CView;
        $eee = Profile::getName($clerk_id);
        $g = new CDatabase;
        $u = "SELECT COUNT(*) FROM tbl_vacation_year WHERE clerk_id='$clerk_id' AND year='$f'";
        $g = new CDatabase;
        if ($g -> countRows($u)) {$a -> error = 'قبلا برای ' . Profile::getName($clerk_id) . ' مرخصی سالانه برای سال ' . $f . ' وارد شده است. برای ویرایش روی این ' . CUrl::createLink('لینک', 'vacation/edityear/' . $clerk_id . '/' . $f) . ' کلیک کنید.';
            $a -> run();
        }$u = "SELECT date_employed FROM tbl_employment WHERE clerk_id='$clerk_id'";
        $xx = $g -> queryOne($u) -> date_employed;
        $c = new CJcalendar(FALSE);
        if ($c -> date('Y', $xx) > $f) {$a -> error = Profile::getName($clerk_id) . ' در سال ' . $c -> date('Y', $xx) . ' استخدام شده است و امکان ثبت مرخصی سالانه برای سال ' . $f . ' برای ایشان امکان‌پذیر نمی‌باشد!';
            $a -> run();
        }
        if (isset($_POST['submit'])) {
            if ($b -> validate()) {$g -> setTbl('tbl_vacation_year');
                $g -> additional = array('clerk_id' => $clerk_id, 'year' => $f);
                $g -> insert();
                CUrl::redirect('vacation/index/addyear');
            }
        }$a -> title = 'ثبت مرخصی سالانه ' . $eee . '-سال ' . $f;
        $a -> form = $b -> run();
        $a -> run();
    }

    public function edityear() {
        $clerk_id = CUrl::segment(3);
        $f = CUrl::segment(4);
        if (!$clerk_id || !$f)
            CUrl::redirect(404);
        $g = new CDatabase;
        $u = "SELECT * FROM tbl_vacation_year WHERE clerk_id='$clerk_id' AND year='$f'";
        if (($i = $g -> queryOne($u)) == FALSE)
            CUrl::redirect(404);
        $eee = Profile::getName($clerk_id);
        $u = "SELECT date_employed FROM tbl_employment WHERE clerk_id='$clerk_id'";
        $xx = $g -> queryOne($u) -> date_employed;
        $c = new CJcalendar(FALSE);
        $a = new CView;
        if ($c -> date('Y', $xx) > $f) {$a -> error = Profile::getName($clerk_id) . ' در سال ' . $c -> date('Y', $xx) . ' استخدام شده است و امکان ثبت مرخصی سالانه برای سال ' . $f . ' برای ایشان امکان‌پذیر نمی‌باشد!';
            $a -> run();
        }$b = new CForm;
        $b -> showFieldErrorText = FALSE;
        if ($b -> validate()) {$g -> setTbl('tbl_vacation_year');
            $q = array('clerk_id' => $clerk_id, 'year' => $f);
            $g -> update($q);
            CUrl::redirect('vacation/all/' . $f);
        }$a -> title = 'ویرایش مرخصی سالانه ' . $eee . '-سال ' . $f;
        $a -> model = $i;
        $a -> form = $b -> run();
        $a -> run();
    }

    private function checkHour($fff, $clerk_id) {
        $u = "SELECT id,period FROM tbl_vacation_hour WHERE date_start='$fff' AND omitted='0'";
        $g = new CDatabase;
        if (($ggg = $g -> queryAll($u)) !== FALSE) {$hhh = 0;
            foreach ($ggg as $iii) {$hhh += $iii -> period;
            }
            if ($hhh > 3) {
                foreach ($ggg as $iii) {$u = "UPDATE tbl_vacation_hour SET omitted='1' WHERE id='" . $iii -> id . "'";
                    $g -> execute($u);
                }$g -> setTbl('tbl_vacation');
                $u = "SELECT hokm_number FROM tbl_vacation ORDER BY id DESC LIMIT 0,1";
                $ddd = $g -> queryOne($u);
                if ($ddd)
                    $ddd = $ddd -> hokm_number + 1;
                else
                    $ddd = 1;
                $jjj = array('clerk_id' => $clerk_id, 'type' => 1, 'date_start' => $fff, 'date_end' => $fff + 86399, 'period' => 1, 'hokm_number' => $ddd, 'description' => 'مرخصی ساعتی بیشتر از ۳ ساعت در یک روز ' . $_POST['description']);
                $g -> insert($jjj);
            }
        }$c = new CJcalendar;
        $kkk = $c -> date('W', $fff);
        $u = "SELECT id,period,date_start FROM tbl_vacation_hour WHERE date_start BETWEEN $fff-604799 AND $fff+600000 AND omitted='0'";
        if (($ggg = $g -> queryAll($u)) !== FALSE) {$hhh = 0;
            $lll = array();
            foreach ($ggg as $iii) {
                if (($c -> date('W', $iii -> date_start)) == $kkk) {$hhh += $iii -> period;
                    $lll[] = $iii -> id;
                }
            }
            if ($hhh > 7) {
                if (!empty($lll)) {
                    foreach ($lll as $iii) {$u = "UPDATE tbl_vacation_hour SET omitted='1' WHERE id='" . $iii . "'";
                        $g -> execute($u);
                    }
                }$g -> setTbl('tbl_vacation');
                $u = "SELECT hokm_number FROM tbl_vacation ORDER BY id DESC LIMIT 0,1";
                $ddd = $g -> queryOne($u);
                if ($ddd)
                    $ddd = $ddd -> hokm_number + 1;
                else
                    $ddd = 1;
                $jjj = array('clerk_id' => $clerk_id, 'type' => 1, 'date_start' => $fff, 'date_end' => $fff + 86399, 'period' => 1, 'hokm_number' => $ddd, 'description' => 'مرخصی ساعتی بیشتر از 7 ساعت در یک هفته ' . $_POST['description']);
                $g -> insert($jjj);
            }
        }
    }

}
?>