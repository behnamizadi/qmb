<?php
$a = new Lookup;
$c = $a -> getAll('post');
$d = $a -> getAll('degree');
$e = $a -> getAll('employment_status');
$f = $a -> getAll('job_status');
$g = $a -> getAll('hokm_type');
$h = new Branch;
$i = $h -> getByOstan();
return array('index' => array('<p><label for="clerk_number">شماره کارمندی<span class="error">*</span></label>', 
'clerk_number' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'decoration' => FALSE), 
'search' => array('type' => 'button', 'value' => '...', 'decoration' => FALSE),'</p>',
  'submit' => array('type' => 'submit','in' => 'class="box"', 'value' => 'مرحله بعد')),
     'edit' => array('reference' => 'model',
      '<table class="create">
      <tr>
      	<td>','employment_status' => array('type' => 'select','options' => $e, 'validation' => array('required'),
         'label' => 'وضعیت استخدام'), '</td>
         <td>', 'job_status' => array('type' => 'select', 'options' => $f, 'validation' => array('required'), 'label' => 'وضعیت اشتغال'), '</td>
         <td>', 'hokm_type' => array('type' => 'select', 'options' => $g, 'validation' => array('required'), 'label' => 'نوع حکم'), '</td>
      </tr>
         <tr>
         	<td><label>تاریخ شروع<span class="error">*</span></label>', 'd_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => 'required', 'reference' => 'ds', ), 'm_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => 'required', 'reference' => 'ms', ), 'y_start' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'validation' => 'required', 'reference' => 'ys', ), '</td>
         	<td><label>تاریخ پایان</label>', 'd_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'reference' => 'de', ), 'm_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'reference' => 'me', ), 'y_end' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1386_1393', 'reference' => 'ye', ), '</td><td>', 'post' => array('type' => 'select', 'options' => $c, 'validation' => array('required'), 'label' => 'پست سازمانی'), '</td></tr><tr><td>', 'degree' => array('type' => 'select', 'options' => $d, 'label' => 'درجه', 'default' => 'انتخاب', 'reference' => 'degree'), '</td><td>', 'emtiaz_shoghl' => array('type' => 'text', 'label' => 'امتیاز شغل', 'validation' => array('required'), 'in' => 'class="txt" maxlength="30"'), '</td><td>', 'place' => array('type' => 'radio', 'value' => array(1 => 'سرپرستی', 2 => 'شعبه'), 'label' => 'محل خدمت<span class="error">*</span>', 'in' => array(1 => 'class="fadeout"', 2 => 'class="fadein"'), 'showFieldErrorText' => TRUE, 'reference' => 'place_id'), 'branch_display' => array('type' => 'view_isset'), 'branches' => array('type' => 'select', 'options' => $i, 'label' => 'درجه', 'decoration' => FALSE, 'default' => 'انتخاب', 'reference' => 'branch'), '</div></td>
         </tr></table>',
          'submit' => array('type' => 'submit', 'value' => 'ویرایش', 'in' => 'class="box"')));
?>
