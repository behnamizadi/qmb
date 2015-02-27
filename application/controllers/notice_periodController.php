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
		$g -> title = '&#1578;&#1594;&#1740;&#1740;&#1585; &#1576;&#1575;&#1586;&#1607; &#1575;&#1582;&#1591;&#1575;&#1585;';
		$g -> run();
	}

	public function manage() {$h = new CGrid;
		$h -> operations = FALSE;
		$h -> counter = TRUE;
		$h -> headers = array('n_type' => array('format' => 'type[asr:&#1576;&#1575;&#1580;&#1607; &#1593;&#1589;&#1585;,clerk:&#1578;&#1605;&#1583;&#1740;&#1583; &#1602;&#1585;&#1575;&#1585;&#1583;&#1575;&#1583;]', 'label' => '&#1606;&#1608;&#1593; &#1575;&#1582;&#1591;&#1575;&#1585;'), 'days' => array('label' => '&#1576;&#1575;&#1586;&#1607; &#1586;&#1605;&#1575;&#1606;&#1740;', 'format' => ' &#1585;&#1608;&#1586;'));
		$g = new CView;
		$g -> grid = $h -> run();
		$g -> run();
	}

}
