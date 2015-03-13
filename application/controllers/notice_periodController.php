<?php
class notice_periodController {
    public function edit() {$a = new CDatabase;
        $b = "SELECT * FROM tbl_notice_period";
        $c = $a -> queryAll($b);
        $d = new CForm;
        if ($d -> validate()) {$e = $a -> escape($_POST['days1']);
            $f = $a -> escape($_POST['days2']);
            $b = "UPDATE tbl_notice_period SET days='$e' WHERE n_type='asr'";
            $a -> execute($b);
            $b = "UPDATE tbl_notice_period SET days='$f' WHERE n_type='clerk'";
            $a -> execute($b);
            CUrl::redirect('notice_period/manage');
        }$g = new CView;
        $g -> asr = $c[0] -> days;
        $g -> clerk = $c[1] -> days;
        $g -> form = $d -> run();
        $g -> title = 'تغییر بازه اخطار';
        $g -> run();
    }

    public function manage() {$h = new CGrid;
        $h -> operations = FALSE;
        $h -> counter = TRUE;
        $h -> headers = array('n_type' => array('format' => 'type[asr:باجه عصر,clerk:تمدید قرارداد]', 'label' => 'نوع اخطار'), 'days' => array('label' => 'بازه زمانی', 'format' => ' روز'));
        $g = new CView;
        $g -> grid = $h -> run();
        $g -> run();
    }

}