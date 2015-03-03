<?php
class notice_asrController {
	public function add() {$a = new CForm;
		if (isset($_POST['submit'])) {$b = new Branch;
			if ($b -> getNameById($_POST['code']) === FALSE) {$c = new Sar;
				if ($c -> getNameById($_POST['code']) === FALSE) {$a -> setError('code', '&#1588;&#1593;&#1576;&#1607; &#1740;&#1575; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740; &#1576;&#1575; &#1575;&#1740;&#1606; &#1705;&#1583; &#1583;&#1585; &#1587;&#1740;&#1587;&#1578;&#1605; &#1579;&#1576;&#1578; &#1606;&#1588;&#1583;&#1607; &#1575;&#1587;&#1578;');
				}
			}
			if ($a -> validate()) {$d = new CDatabase;
				$e = new CJcalendar;
				$f = $e -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
				$d -> additional = array('date_end' => $f);
				$d -> insert();
				CUrl::redirect('notice_asr/manage');
			}
		}$g = new CView;
		$g -> form = $a -> run();
		$g -> title = '&#1579;&#1576;&#1578; &#1575;&#1582;&#1591;&#1575;&#1585; &#1578;&#1605;&#1583;&#1740;&#1583; &#1576;&#1575;&#1580;&#1607; &#1593;&#1589;&#1585; &#1740;&#1575; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
		$g -> run();
	}

	public function manage() {
		$h=FALSE;
		if (CUrl::segment(3) === 'print')
			$h = TRUE;
		$i = "SELECT tbl_notice_asr.code,tbl_notice_asr.date_end,tbl_branch.name FROM tbl_notice_asr,tbl_branch   
		WHERE tbl_notice_asr.code=tbl_branch.code";
		$d = new CDatabase;
		$j = $d -> queryAll($i);
		if ($j === FALSE)
			$j = array();
		$i = "SELECT tbl_notice_asr.code,tbl_notice_asr.date_end,tbl_sar.name FROM tbl_notice_asr,tbl_sar  
		WHERE tbl_notice_asr.code=tbl_sar.code";
		$k = $d -> queryAll($i);
		if ($k === FALSE)
			$k = array();
		$l = array_merge((array)$j, (array)$k);
		$d = new CDatabase;
		$m = new CGrid;
		$m -> values = $l;
		$m -> headers = array('code', 'name', 'date_end' => array('format' => 'model[Cal,getDate($value)]'), );
		$m -> operations['view'] = FALSE;
		$m -> sort = 'date_end';
		$m -> counter = TRUE;
		$n = '&#1604;&#1740;&#1587;&#1578; &#1575;&#1582;&#1591;&#1575;&#1585; &#1578;&#1605;&#1583;&#1740;&#1583; &#1576;&#1575;&#1580;&#1607; &#1593;&#1589;&#1585; &#1608; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740;';
		$g = new CView;
		if ($h) {$m -> operations = FALSE;
			$m -> noSort = TRUE;
			$g -> layout = 'print';
			$g -> ptitle = '<h1>' . $n . '</h1>';
			$o = new User;
			$g -> producer = $o -> producer();
			$m -> paginate = FALSE;
		} else {$g -> pb = '<center><p>' . CUrl::createLink('&#1606;&#1587;&#1582;&#1607; &#1670;&#1575;&#1662;&#1740;', 'notice_asr/manage/print', 'class="box" target="_blank"') . '</p></center>';
		}$g -> title = $n;
		$g -> grid = $m -> run();
		$g -> run();
	}

	public function edit() {$p = CUrl::segment(3);
		$d = new CDatabase;
		if (($q = $d -> getByPk($p)) == FALSE)
			CUrl::redirect(404);
		$g = new CView;
		$g -> model = $q;
		$e = new CJcalendar(FALSE);
		$g -> m = $e -> date('m', $q -> date_end);
		$g -> d = $e -> date('d', $q -> date_end);
		$g -> y = $e -> date('Y', $q -> date_end);
		$a = new CForm;
		if ($a -> validate()) {$d = new CDatabase;
			$e = new CJcalendar;
			$f = $e -> mktime(0, 0, 0, (int)$_POST['m_end'], (int)$_POST['d_end'], (int)$_POST['y_end']) + 14400;
			$d -> update(array('code' => $p), array('date_end' => $f));
			CUrl::redirect('notice_asr/manage');
		}$b = new Branch;
		$g -> form = $a -> run();
		if (($s = $b -> getNameById($p)) != FALSE)
			$g -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1582;&#1591;&#1575;&#1585; &#1576;&#1575;&#1580;&#1607; &#1593;&#1589;&#1585; &#1588;&#1593;&#1576;&#1607; ' . $p . ' (' . $n . ')';
		else {$c = new Sar;
			$g -> title = '&#1608;&#1740;&#1585;&#1575;&#1740;&#1588; &#1575;&#1582;&#1591;&#1575;&#1585; &#1587;&#1585;&#1662;&#1585;&#1587;&#1578;&#1740; ' . $p . ' (' . $c -> getNameById($p) . ')';
		}$g -> run();
	}

	public function delete() {$d = new CDatabase;
		$d -> delete(array('code' => CUrl::segment(3)));
		CUrl::redirect('notice_asr/manage');
	}

}
?>
