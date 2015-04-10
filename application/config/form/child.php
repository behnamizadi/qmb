<?php
return array(
'manage'=> array('<table id="add_tbl" class="create"><tr><td>', 
'name' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ),
'code_melli' => array('type' => 'text',  'validation' => array('required,length[10],number'), ), 
'<label>تاریخ تولد<span class="error">*</span></label>', 
'd_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 
'm_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 
'y_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => Utility::years(30,0), 'validation' => array('required'), ), 
'city_born' => array('type' => 'text', 'validation' => array('required,maxLength[30]'), ),  
'submit' => array('type' => 'submit', 'value' => 'ثبت', 'decoration' => FALSE, 'in' => 'class="btn btn-primary"'), 
'' => array('type' => 'extra', 'reference' => 'clerk_id')),
'edit'=> array('<table id="add_tbl" class="create"><tr><td>', 
'name' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ),
'code_melli' => array('type' => 'text',  'validation' => array('required,length[10],number'), ), 
'<label>تاریخ تولد<span class="error">*</span></label>', 
'd_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 
'm_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 
'y_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => Utility::years(30,0), 'validation' => array('required'), ), 
'city_born' => array('type' => 'text', 'validation' => array('required,maxLength[30]'), ),  
'submit' => array('type' => 'submit', 'value' => 'ثبت', 'decoration' => FALSE, 'in' => 'class="btn btn-primary"'), 
'' => array('type' => 'extra', 'reference' => 'clerk_id')),
);
?>