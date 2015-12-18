<?php
return array(
    'add' => array('name' => array('type' => 'text', 'in' => 'class="txt" maxlength="40"', 'validation' => array('required,maxLength[40],unique[tbl_lookup]'), ), 'description' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60 ), 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="box"')), 
    'view' => array('reference' => 'model', 'name' => array('type' => 'text', 'in' => 'class="txt" maxlength="40"', 'validation' => array('required,maxLength[40]'), ), 'description' => array('type' => 'textarea', 'rows' => 10, 'cols' => 60),  'submit' => array('type' => 'submit', 'value' => 'ویرایش', 'in' => 'class="box"', 'decoration' => FALSE),) );
?>
