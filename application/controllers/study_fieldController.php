<?php
class study_fieldController {
	public function add() {$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		$a -> dontClose = TRUE;
		$b = new CView;
		$c = CUrl::segment(3);
		if (isset($_POST['submit'])) {
			if (empty($_POST['study_degree'])) {$b -> error = '<span class="error">&#1604;&#1591;&#1601;&#1575; &#1581;&#1583;&#1575;&#1602;&#1604; &#1740;&#1705;&#1740; &#1575;&#1586; &#1605;&#1602;&#1575;&#1591;&#1593; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740; &#1585;&#1575; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.</span>';
				$a -> setError('study_degree', '&#1604;&#1591;&#1601;&#1575; &#1581;&#1583;&#1575;&#1602;&#1604; &#1740;&#1705;&#1740; &#1575;&#1586; &#1605;&#1602;&#1575;&#1591;&#1593; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740; &#1585;&#1575; &#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1606;&#1605;&#1575;&#1740;&#1740;&#1583;.');
			}
			if ($a -> validate() === TRUE) {echo 't';
				$d = new CDatabase;
				foreach ($_POST['study_degree'] as $e) {$d -> additional = array('study_degree' => $e);
					$d -> insert();
				}
				if (empty($c))
					CUrl::redirect('study_field/filter');
				else
					CUrl::redirect('study_field/manage/' . $c);
			}
		}$b -> form = $a -> run();
		$b -> study_degree = $c;
		$b -> title = '&#1575;&#1601;&#1586;&#1608;&#1583;&#1606; &#1585;&#1588;&#1578;&#1607; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740;';
		$b -> run('study_field/add');
	}

	public function filter() {
		if (isset($_POST['submit'])) {CUrl::redirect('study_field/manage/' . $_POST['study_degree']);
		}$b = new CView;
		$b -> title = '&#1585;&#1588;&#1578;&#1607;&#8204;&#1607;&#1575;&#1740; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740;';
		$b -> run('study_field/filter');
	}

	public function manage() {$e = CUrl::segment(3);
		if (empty($e))
			CUrl::redirect('study_field/filter');
		$f = new CGrid;
		$f -> operations = array('edit' => FALSE, 'view' => FALSE, 'delete' => FALSE, "study_field/view/\$value->id/$e" => array('icon' => 'public/images/view.png', 'alt' => '&#1605;&#1588;&#1575;&#1607;&#1583;&#1607;', 'title' => '&#1605;&#1588;&#1575;&#1607;&#1583;&#1607; &#1608; &#1608;&#1740;&#1585;&#1575;&#1740;&#1588;'), "study_field/delete/\$value->id/$e" => array('icon' => 'public/images/delete.png', 'alt' => '&#1581;&#1584;&#1601;', 'title' => '&#1581;&#1584;&#1601;'), );
		$f -> condition = array('where' => array('study_degree' => $e));
		$f -> headers = array('title', 'study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]', 'label' => '&#1605;&#1602;&#1591;&#1593; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740;'));
		$b = new CView;
		$b -> body = $f -> run();
		$g = new Lookup;
		$b -> title = '&#1585;&#1588;&#1578;&#1607;&#8204;&#1607;&#1575;&#1740; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740; &#1605;&#1602;&#1591;&#1593; ' . $g -> getById($e, 'study_degree');
		$b -> study_degree = $e;
		$b -> run('study_field/manage');
	}

	public function view() {$h = CUrl::segment(3);
		$e = CUrl::segment(4);
		$d = new CDatabase;
		$i = $d -> getByPk($h);
		if ($i === FALSE)
			CUrl::redirect(404);
		$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		$a -> dontClose = TRUE;
		if (isset($_POST['submit'])) {
			if ($a -> validate() === TRUE) {$j = array('where' => array('id' => $h));
				$d -> update($j);
				CUrl::redirect('study_field/manage/' . $e);
			}
		}$b = new CView;
		$b -> model = $i;
		$b -> title = '&#1580;&#1586;&#1574;&#1740;&#1575;&#1578; &#1585;&#1588;&#1578;&#1607; &#1578;&#1581;&#1589;&#1740;&#1604;&#1740;';
		$b -> study_degree = $e;
		$b -> run('study_field/add');
	}

	public function delete() {$h = CUrl::segment(3);
		$k = "DELETE FROM tbl_study_field WHERE id='$h'";
		$d = new CDatabase;
		$d -> execute($k);
		if (!CUrl::segment(4))
			CUrl::redirect('study_field/filter');
		else
			CUrl::redirect('study_field/manage/' . CUrl::segment(4));
	}

	public function getByDegreeAjax() {$d = new CDatabase;
		$l = $d -> escape($_POST['study_degree']);
		$m = new StudyField;
		$n = $m -> getByDegree($l);
		$a = new CForm;
		echo $a -> options($n, 'study_field');
	}

}
