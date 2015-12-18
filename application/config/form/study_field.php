<?php
$a = new Lookup;
$b = $a -> getAll('study_degree');
unset($b[1]);
return array(
'add' => array(
	'title' => array('type' => 'text', 'in' => 'class = "txt" maxLength="80"', 'validation' => array('required,maxLength[50]'), ),
	'study_degree' => array('type' => 'select', 'options' => $b, 'validation' => array('required', 'message' => array('required' => 'لطفا حداقل یکی از مقاطع تحصیلی را انتخاب نمایید.')), ),
	'error' => array('type' => 'view_isset'), 
	'description' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60), 
	'submit' => array('type' => 'submit', 'in' => 'class="btn btn-primary"', 'value' => 'ثبت', 'decoration' => FALSE)),
'filter' => array(
    'study_degree' => array('type' => 'select', 'options' => $b,), 
    'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'مرحله بعد', 'decoration' => FALSE)), 
'edit' => array('reference' => 'model', 'title' => array('type' => 'text', 'in' => 'class = "txt" maxLength="80"', 'validation' => array('required,maxLength[50]'), ), 
    'study_degree' => array('type' => 'select', 'options' => $b, 'validation' => array('required', 'message' => array('required' => 'لطفا حداقل یکی از مقاطع تحصیلی را انتخاب نمایید.')), ),
    'description' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60), 
    'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'ثبت', 'decoration' => FALSE)),    
    );
