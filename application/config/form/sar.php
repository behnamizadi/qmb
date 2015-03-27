<?php
$a = new Lookup;
$b = $a -> getAll('geo');
$c = $a -> getAll('sar_degree');
$d = Cities::getCities();
$b['default'] = $d['default'] = $c['default'] = 'انتخاب';
$e = 'style="display: none;"';
if (isset($_POST['error']) && $_POST['error'] == 1)
    $e = '';
return array('add' => array('reference' => 'model', '<table class="create"><tr><td>', 'name' => array('type' => 'text', 'in' => 'class="txt" maxlength="30"', 'validation' => array('required,maxLength[50]'), ), '</td><td>', 'code' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'showFieldErrorText' => TRUE, 'validation' => array('required,maxLength[30],unique[tbl_sar],number'), ), '</td><td>', 'city' => array('type' => 'select', 'options' => $d, 'validation' => array('required'), ), '</td><td>', 'geo' => array('type' => 'select', 'options' => $b, 'validation' => array('required'), ), '</td></tr><tr><td>', '<label>تاریخ افتتاح<span class="error">*</span></label>', 'd_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 'm_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 'y_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => array('required'), ), '</td><td>', 'boss' => array('type' => 'text', 'in' => 'class="txt" maxlength="80"', 'validation' => array('required,maxLength[80]'), ), '</td><td>', 'tel' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td>', 'fax' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td></tr><tr><td>', 'mob' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td>', 'zip' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'validation' => array('required,length[10],number'), ), '</td></tr><tr><td colspan="2">', 'address' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60, 'validation' => array('required'), ), '</td></tr></table><p><label> </label>', 'submit' => array('type' => 'submit', 'value' => 'مرحله بعد', 'in' => 'class="btn btn-primary"', 'decoration' => FALSE), '<a href="' . PHP40::get() -> homeUrl . 'index.php/sar/manage" class="box">بازگشت</a></p>', ), 'info' => array('reference' => 'model', '<table class="create"><tr><td>', 'name' => array('type' => 'text', 'in' => 'class="txt" maxlength="30"', 'validation' => array('required,maxLength[50]'), ), '</td><td>', 'code' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'showFieldErrorText' => TRUE, 'validation' => array('required,maxLength[30],unique[tbl_sar],number'), ), '</td><td>', 'city' => array('type' => 'select', 'options' => $d, 'validation' => array('required'), ), '</td><td>', 'geo' => array('type' => 'select', 'options' => $b, 'validation' => array('required'), ), '</td></tr><tr><td>', '<label>تاریخ افتتاح<span class="error">*</span></label>', 'd_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), 'reference' => 'd'), 'm_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'm'), 'y_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => array('required'), 'reference' => 'y'), '</td><td>', 'boss' => array('type' => 'text', 'in' => 'class="txt" maxlength="80"', 'validation' => array('required,maxLength[80]'), ), '</td><td>', 'tel' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td>', 'fax' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td></tr><tr><td>', 'mob' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td>', 'zip' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'validation' => array('required,length[10],number'), ), '</td></tr><tr><td colspan="2">', 'address' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60, 'validation' => array('required'), ), '</td></tr></table><p><label> </label>', 'submit' => array('type' => 'submit', 'value' => 'ویرایش', 'in' => 'class="box"', 'decoration' => FALSE), '<a href="' . PHP40::get() -> homeUrl . 'index.php/sar/manage" class="box">بازگشت</a></p>', ), 'edit' => array('code' => array('type' => 'text', 'in' => 'class="txt"', 'validation' => array('required,number')), 'submit' => array('type' => 'submit', 'value' => 'مرحله بعد', 'in' => 'class="box"', )), 'degrees' => array('<table id="add_tbl" class="create" ' . $e . '><tr><td>', 'error' => array('type' => 'hidden', 'value' => 0), 'degree' => array('type' => 'select', 'options' => $c, 'label' => 'درجه', 'validation' => 'required'), '</td><td><label>سال<span class="error">*</span></label>', 'degree_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => 'required'), '</td><td>', 'submit' => array('type' => 'submit', 'value' => 'ثیت', 'in' => 'class="box"'), '</td></tr></table>'), 'degreeedit' => array('reference' => 'model', '<table class="create"><tr><td>', 'degree' => array('type' => 'select', 'options' => $c, 'label' => 'درجه', 'validation' => 'required'), '</td><td><label>سال<span class="error">*</span></label>', 'degree_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears', 'validation' => 'required', ), '</td></tr></table>', 'submit' => array('type' => 'submit', 'value' => 'ثیت', 'in' => 'class="box"', 'decoration' => FALSE), ));
?>