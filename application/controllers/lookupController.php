<?php
class lookupController {
    private $manage = array('post' => 'پست‌های سازمانی', 'employment_status' => 'وضعیت‌های استخدامی', 'job_status' => 'وضعیت‌های اشتغال', 'sarbazi' => 'عناوین سربازی', 'geo' => 'مناطق جغرافیایی', 'degree' => 'درجات', 'study_degree' => 'مقاطع تحصیلی', 'study_field' => 'رشته‌های تحصیلی', 'vacation' => 'انواع مرخصی', 'hokm_type' => 'انواع حکم استخدامی', 't_cat' => 'رده دوره‌های آموزشی', 'training' => 'دوره‌های آموزشی', 'notice_post' => 'سمت‌های دارای اخطار');
    private $add = array('post' => 'افزودن پست سازمانی', 'employment_status' => 'افزودن وضعیت استخدامی', 'job_status' => 'افزودن وضعیت اشتغال', 'sarbazi' => 'افزودن عنوان سربازی', 'geo' => 'افزودن منطقه جغرافیایی', 'degree' => 'افزودن درجه', 'study_degree' => 'افزودن مقطع تحصیلی', 'study_field' => 'افزودن رشته تحصیلی', 'vacation' => 'افزودن عنوان مرخصی', 'hokm_type' => 'افزودن نوع حکم', 't_cat' => 'افزودن رده دوره', 'training' => 'افزودن دوره آموزشی', 'notice_post' => 'افزودن سمت دارای اخطار');
    private $view = array('post' => 'جزئیات پست سازمانی', 'employment_status' => 'جزئیات وضعیت استخدامی', 'job_status' => 'جزئیات وضعیت اشتغال', 'sarbazi' => 'جزئیات عنوان سربازی', 'geo' => 'جزئیات منطقه جغرافیایی', 'degree' => 'جزئیات درجه', 'study_degree' => 'جزئیات مقطع تحصیلی', 'study_field' => 'جزئیات رشته تحصیلی', 'vacation' => 'جزئیات عنوان مرخصی', 'hokm_type' => 'جزئیات نوع حکم', 't_cat' => 'جزئیات رده آموزشی', 'training' => 'جزپیات دوره آموزشی', 'notice_post' => 'جزئیات سمت دارای اخطار');
    public function add() {
        $type = CUrl::segment(3);
        $e = new CForm();
        $e -> dontClose = TRUE;
        if (isset($_POST['submit']) && !empty($type)) {
            if ($e -> validate() === TRUE) {
				$f = new Lookup;
                $f -> add($type);
                CUrl::redirect('lookup/manage/' . $type);
            }
        }
        $c = new CView;
        $c -> type = $type;
        $c -> form = $e -> run();
        if (isset($this -> add[$type]))
            $c -> title = $this -> add[$type];
        $c -> run('lookup/add');
    }

    public function manage() {$type = CUrl::segment(3);
        $g = new CGrid($type);
        $g -> headers = array('name', 'description');
        $g -> table = 'tbl_lookup';
        $g -> counter = TRUE;
        $g -> condition = array('type' => $type);
        $g -> operations = array('edit' => FALSE, 'view' => FALSE, 'delete' => FALSE, "lookup/view/$type/" . '$value->id' => array('icon' => 'public/images/view.png', 'alt' => 'مشاهده', 'title' => 'مشاهده و ویرایش'), "lookup/delete/$type/" . '$value->id' => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف'));
        $c = new CView;
        $c -> body = $g -> run();
        $c -> type = $type;
        $c -> add = "افزودن" ;
        if (isset($this -> manage[$type]))
            $c -> title = $this -> manage[$type];
        if (isset($this -> add[$type]))
            $c -> add = $this -> add[$type];
        $c -> run('lookup/manage');
    }

    public function view() {$type = CUrl::segment(3);
        $h = CUrl::segment(4);
        $i = new CDatabase;
        $j = $i -> getByPk($h);
        if ($j === FALSE)
            CUrl::redirect(404);
        $e = new CForm();
        $e -> dontClose = TRUE;
        if (isset($_POST['submit'])) {
            if ($e -> validate() === TRUE) {$k = array('where' => array('id' => $h));
                $i -> update($k);
                CUrl::redirect('lookup/manage/' . $type);
            }
        }$c = new CView;
        $c -> model = $j;
        $c -> form = $e -> run();
        $c -> type = $type;
        if (isset($this -> view[$type]))
            $c -> title = $this -> view[$type];
        $c -> run('lookup/add');
    }

    public function delete() {$type = CUrl::segment(3);
        $h = CUrl::segment(4);
        $l = 'DELETE FROM tbl_lookup WHERE id="' . $h . '"';
        $i = new CDatabase;
        $i -> execute($l);
        CUrl::redirect('lookup/manage/' . $type);
    }

}
