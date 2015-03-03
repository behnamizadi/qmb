<?php
$a = new Lookup;
$b = $a -> getAll('geo');
$c = $a -> getAll('degree');
$d = Cities::getCities();
$b['default'] = $d['default'] = $c['default'] = 'انتخاب';
$e = 'style="display: none;"';
if (isset($_POST['error']) && $_POST['error'] == 1)
	$e = '';
return array('search' => array('code' => array('type' => 'text', 'in' => 'class="txt"', 'validation' => 'required'), 'submit' => array('type' => 'submit', 'value' => 'جستجو', 'in' => 'class="box"', ), ), 'add' => array('<table class="create"><tr><td>', 'name' => array('type' => 'text', 'in' => 'class="txt" maxlength="30"', 'validation' => array('required,maxLength[50]'), ), '</td><td>', 'code' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'showFieldErrorText' => TRUE, 'validation' => array('required,maxLength[30],unique[tbl_branch],number'), ), '</td><td>', 'city' => array('type' => 'select', 'options' => $d, 'validation' => array('required'), ), '</td><td>', 'geo' => array('type' => 'select', 'options' => $b, 'validation' => array('required'), ), '</td></tr><tr><td>', '<label>تاریخ افتتاح<span class="error">*</span></label>', 'd_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 'm_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 'y_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'validation' => array('required'), ), '</td><td>', 'boss' => array('type' => 'text', 'in' => 'class="txt" maxlength="80"', 'validation' => array('required,maxLength[80]'), ), '</td><td>', 'tel' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td>', 'fax' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td></tr><tr><td>', 'mob' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td>', 'degree' => array('type' => 'select', 'options' => $c, 'validation' => array('required'), ), '</td><td><label>سال درجه فعلی<span class="error">*</span></label>', 'degree_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'validation' => array('required'), 'reference' => 'degree_start'), '</td><td>', 'zip' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'validation' => array('required,length[10],number'), ), '</td></tr><tr><td colspan="2">', 'address' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60, 'validation' => array('required'), ), '</td></tr></table><p><label> </label>', 'submit' => array('type' => 'submit', 'value' => 'مرحله بعد', 'in' => 'class="box"', 'decoration' => FALSE), '<a href="' . PHP40::get() -> homeUrl . 'index.php/branch/manage" class="box">بازگشت</a></p>'), 'degrees' => array('<table id="add_tbl" class="create" ' . $e . '><tr><td>', 'error' => array('type' => 'hidden', 'value' => 0), 'degree' => array('type' => 'select', 'options' => $c, 'label' => 'درجه', 'validation' => 'required'), '</td><td><label>سال<span class="error">*</span></label>', 'degree_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'validation' => 'required'), '</td><td>', 'submit' => array('type' => 'submit', 'value' => 'ثیت', 'in' => 'class="box"'), '</td></tr></table>'), 'info' => array('<table class="create"><tr><td>', 'reference' => 'model', 'name' => array('type' => 'text', 'in' => 'class="txt" maxlength="30"', 'validation' => array('maxLength[50]'), ), '</td><td>', 'code' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'showFieldErrorText' => TRUE, 'validation' => array('maxLength[30],number'), ), '</td><td>', 'city' => array('type' => 'select', 'options' => $d, 'validation' => array('required'), ), '</td><td>', 'geo' => array('type' => 'select', 'options' => $b, 'validation' => array('required'), ), '</td></tr><tr><td>', '<label>تاریخ افتتاح<span class="error">*</span></label>', 'd_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), 'reference' => 'd'), 'm_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'm'), 'y_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'validation' => array('required'), 'reference' => 'y'), '</td><td>', 'boss' => array('type' => 'text', 'in' => 'class="txt" maxlength="80"', 'validation' => array('required,maxLength[80]'), ), '</td><td>', 'tel' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td >', 'fax' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td></tr><tr><td>', 'mob' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15]'), ), '</td><td>', 'zip' => array('type' => 'text', 'in' => 'class="txt" maxlength="10"', 'validation' => array('required,length[10],number'), ), '</td></tr><tr><td colspan="2">', 'address' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60, 'validation' => array('required'), ), '</td></tr></table><p><label> </label>', 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="box"', 'decoration' => FALSE), '<a href="' . PHP40::get() -> homeUrl . 'index.php/branch/manage" class="box">بازگشت</a></p>'), 'props' => array('<table class="create"><tr><td>', 'pos' => array('type' => 'checkbox', 'value' => '<span style="font-size:12px">POS</span> شعبه‌ای', 'decoration' => FALSE), 'pos_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'atm' => array('type' => 'checkbox', 'value' => '<span style="font-size:12px">ATM</span>', 'decoration' => FALSE), 'atm_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'asr' => array('type' => 'checkbox', 'value' => 'باجه عصر', 'decoration' => FALSE), 'asr_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'mpls' => array('type' => 'checkbox', 'value' => '<span style="font-size:12px">MPLS</span>', 'decoration' => FALSE), 'mpls_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'adsl' => array('type' => 'checkbox', 'value' => '<span style="font-size:12px">ASDL</span>', 'decoration' => FALSE), 'adsl_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td></tr><tr><td>', 'vsat' => array('type' => 'checkbox', 'value' => '<span style="font-size:12px">VSAT</span>', 'decoration' => FALSE), 'vsat_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'card' => array('type' => 'checkbox', 'value' => 'آنی کارت', 'decoration' => FALSE), 'card_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'nobat' => array('type' => 'checkbox', 'value' => 'دستگاه نوبت‌دهی', 'decoration' => FALSE), 'nobat_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'dozdgir' => array('type' => 'checkbox', 'value' => 'دزدگیر', 'decoration' => FALSE), 'dozdgir_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'camera' => array('type' => 'checkbox', 'value' => 'دوربین', 'decoration' => FALSE), 'camera_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td></tr><tr><td>', 'copy' => array('type' => 'checkbox', 'value' => 'دستگاه کپی', 'decoration' => FALSE), 'copy_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'gas_cooler' => array('type' => 'checkbox', 'value' => 'کولر گازی', 'decoration' => FALSE), 'gas_cooler_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'water_cooler' => array('type' => 'checkbox', 'value' => 'کولر آبی', 'decoration' => FALSE), 'water_cooler_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'up_pool' => array('type' => 'checkbox', 'value' => 'پولشمار ایستاده', 'decoration' => FALSE), 'up_pool_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td><td>', 'miz_pool' => array('type' => 'checkbox', 'value' => 'پولشمار رومیزی', 'decoration' => FALSE), 'miz_pool_number' => array('type' => 'text', 'in' => 'class="props" readOnly="readOnly" maxLength="2"', 'validation' => 'number,maxValue[99]', 'decoration' => FALSE), '</td></tr></table>', 'submit' => array('type' => 'submit', 'value' => 'مرحله بعد', 'in' => 'class="box"', ), ), 'edit' => array('code' => array('type' => 'text', 'in' => 'class="txt"', 'validation' => array('required,number')), 'submit' => array('type' => 'submit', 'value' => 'مرحله بعد', 'in' => 'class="box"', )), 'degreeedit' => array('reference' => 'model', '<table class="create"><tr><td>', 'degree' => array('type' => 'select', 'options' => $c, 'label' => 'درجه', 'validation' => 'required'), '</td><td><label>سال<span class="error">*</span></label>', 'degree_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'validation' => 'required', ), '</td></tr></table>', 'submit' => array('type' => 'submit', 'value' => 'ثیت', 'in' => 'class="box"', 'decoration' => FALSE), ));
?>
