<?php
class study_fieldController {
	public function add() {$a = new CForm;
		$a -> showFieldErrorText = FALSE;
		$a -> dontClose = TRUE;
		$b = new CView;
		$c = CUrl::segment(3);
		if (isset($_POST['submit'])) {
			if (empty($_POST['study_degree'])) {$b -> error = '<span class="error">لطفا حداقل یکی از مقاطع تحصیلی را انتخاب نمایید.</span>';
				$a -> setError('study_degree', 'لطفا حداقل یکی از مقاطع تحصیلی را انتخاب نمایید.');
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
		$b -> title = 'افزودن رشته تحصیلی';
		$b -> run('study_field/add');
	}

	public function filter() {
		if (isset($_POST['submit'])) {CUrl::redirect('study_field/manage/' . $_POST['study_degree']);
		}$b = new CView;
		$b -> title = 'رشته‌های تحصیلی';
		$b -> run('study_field/filter');
	}

	public function manage() {$e = CUrl::segment(3);
		if (empty($e))
			CUrl::redirect('study_field/filter');
		$f = new CGrid;
		$f -> operations = array('view' => array('href'=>"study_field/view/".$value->id."/$e" , 'alt' => 'مشاهده', 'title' => 'مشاهده و ویرایش'), 'delete'=>array('href'=>"study_field/delete/".$value->id."/$e" ,'alt' => 'حذف', 'title' => 'حذف'), );
		$f -> condition = array('where' => array('study_degree' => $e));
		$f -> headers = array('title', 'study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]', 'label' => 'مقطع تحصیلی'));
		$b = new CView;
		$b -> body = $f -> run();
		$g = new Lookup;
		$b -> title = 'رشته‌های تحصیلی مقطع ' . $g -> getById($e, 'study_degree');
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
		$b -> title = 'جزئیات رشته تحصیلی';
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
