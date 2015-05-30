<?php
return array(
'batchindex' => array('year' => array('type' => 'select', 'options' => 'lastTenYears', 'reference' => 'y', 'validation' => array('required'), 'label' => 'سال'), 'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'ادامه')), 
'add,edit' => array('reference' => 'model', 'grade' => array('type' => 'text', 'in' => 'class="txt" maxLength="25"', 'validation' => array('required,number'), 'label' => 'نمره ارزشیابی'), 'submit' => array('type' => 'submit', 'in' => 'class="box"', 'value' => 'ثبت')),
 'index2' => array('year' => array('type' => 'select', 'options' => 'lastTenYears', 'validation' => 'required', 'label' => 'انتخاب سال', 'reference' => 'y'), 'filter' => array('type' => 'submit', 'value' => 'ارسال', 'in' => 'class="box"', ), ));
?>
