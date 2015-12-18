<?php
$a = new Lookup;
$b = $a -> getAll('sarbazi');
$b['default'] = 'انتخاب';
$display=' style="display:none"';
if (isset($_POST['married']) && $_POST['married'] == 2){
    $display='';
}
	
return array(
'add' => array(
    'reference' => 'model',
    'name' => array('type' => 'text', 'validation' => array('required,maxLength[30]'), ), 
    'lastname' => array('type' => 'text', 'value' => '','validation' => array('required,maxLength[50]'),), 
    'father' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ), 
    '<div class="form-group"><label class="col-xs-3 col-md-3 col-sm-3 ">تاریخ تولد<span class="error">*</span></label>', 
        'd_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), ), 
        'm_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), ), 
        'y_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => Utility::years(70,-10), 'validation' => array('required'), ),
    '</div>', 
    'city_born' => array('type' => 'text', 'validation' => array('required,maxLength[30]'), ), 
    'city_sodur' => array('type' => 'text','validation' => array('required,maxLength[30]'), ), 
    'sh_sh' => array('type' => 'text',  'validation' => array('required,maxLength[10],number'), ), 
    'code_melli' => array('type' => 'text',  'validation' => array('number,required,length[10]'), ), 
    'religion' => array('type' => 'text',  'validation' => array('required'), ), 
    'sex' => array('type' => 'radio', 'value' => array(1 => 'مرد', 2 => 'زن'), 'showFieldErrorText' => TRUE, 'validation' => array('required'), ),
    'sarbazi' => array('type' => 'select', 'options' => $b, ), 
    'married' => array('type' => 'radio', 
        'value' => array(1 => 'مجرد', 2 => 'متاهل'), 
        'in' => array(1 => 'id="motahel"', 2 => 'id="mojarad"'), 'showFieldErrorText' => TRUE, 'validation' => array('required'), ),
    'takafol' => array('in'=>'id="takafol"'.$display ,'type' => 'text', 'validation' => array('maxLength[2],maxValue[99],natural'), ), 
    'tel' => array('type' => 'text', 'validation' => array('required,maxLength[15],number'), ), 
    'mobile' => array('type' => 'text',  'validation' => array('required,maxLength[11],number'), ), 
    'father_tel' => array('type' => 'text', 'validation' => array('maxLength[15],number'), ),
    'address' => array('type' => 'textarea', 'rows' => 6, 'cols' => 60, 'validation' => array('required'), ), 
    'father_address' => array('type' => 'textarea', 'rows' => 6, 'cols' => 60, ), 
    'submit' => array('type' => 'submit', 'value' => 'مرحله بعد')), 
    
'edit' => array('reference' => 'model', 'name' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ), 
    'lastname' => array('type' => 'text', 'value' => '', 'in' => 'class="txt" maxlength="50"', 'validation' => array('required,maxLength[50]'), ), 
    'father' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ), 
    '<label>تاریخ تولد<span class="error">*</span></label>', 
    'd_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month', 'validation' => array('required'), 'reference' => 'd'), 
    'm_born' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year', 'validation' => array('required'), 'reference' => 'm'), 
    'y_born' => array('decoration' => FALSE, 'type' => 'select', 'options' =>Utility::years(70,-10), 'validation' => array('required'), 'reference' => 'y'), 
    'city_born' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ),  'city_sodur' => array('type' => 'text',  'validation' => array('required,maxLength[30]'), ), 
    'sh_sh' => array('type' => 'text',  'validation' => array('required,maxLength[10],number'), ), 
    'code_melli' => array('type' => 'text',  'validation' => array('number,required,length[10]'), ), 
    'religion' => array('type' => 'text',  'validation' => array('required'), ), 
    'sex' => array('type' => 'radio', 'value' => array(1 => 'مرد', 2 => 'زن'), 'showFieldErrorText' => TRUE, 'validation' => array('required'), ), 
    'sarbazi' => array('type' => 'select', 'options' => $b, ),
    'married' => array('type' => 'radio', 'value' => array(1 => 'مجرد', 2 => 'متاهل'), 'showFieldErrorText' => TRUE, 'validation' => array('required'), ), 
    'takafol' => array('in'=>'id="takafol"'.$display ,'type' => 'text', 'validation' => array('maxLength[2],maxValue[99],natural'), ), 
    'tel' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15],number'), ), 'mobile' => array('type' => 'text', 'in' => 'class="txt" maxlength="11"', 'validation' => array('required,maxLength[11],number'), ),  
    'father_tel' => array('type' => 'text', 'in' => 'class="txt" maxlength="15"', 'validation' => array('required,maxLength[15],number'), ), 
    'address' => array('type' => 'textarea', 'rows' => 6, 'cols' => 60, 'validation' => array('required'), ), 'father_address' => array('type' => 'textarea', 'rows' => 6, 'cols' => 60, 'validation' => array('required'), ),
    'description' => array('type' => 'textarea', 'rows' => 2, 'cols' => 60, ),
    'submit' => array('type' => 'submit', 'value' => 'ثبت مشخصات', 'in' => 'class="btn btn-defalut"')), );
