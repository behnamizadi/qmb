<?php
return array('login' => array(
	'login_form' => array(
		'type' => 'form',
		'action' => 'user/login', 
		), 
	'username' => array(
		'type' => 'text', 
		'validation' => array('required')), 
		'password' => array('type' => 'password', 
			'post' => FALSE, 
			'validation' => array('required')),
			 //* 'captcha' => array('type' => 'captcha', 'textLength' => 6, 'post' => FALSE, 'in' => 'class="txt"', 'validation' => array('required,captcha'), ), '<span class="hint">کد امنیتی به حروف کوچک/ بزرگ حساس نمی‌باشد!</span>',
			 'login' => array(
			 	'type' => 'submit', 
			 	'value' => 'ورود', 
				), 
			'error' => array('type' => 'view_isset')), 
			'change_pass' => array('password' => array('type' => 'password', 'post' => FALSE, 'validation' => array('required'), 'label' => 'رمز عبور فعلی'), 
			'new_password' => array('type' => 'password', 'post' => FALSE, 'validation' => array('required,minLength[6]'), 'label' => 'رمز عبور جدید'), 'verify_pass' => array('type' => 'password', 'post' => FALSE, 'validation' => array('required,match[new_password]'), 'label' => 'تکرار رمز عبور جدید'), 'submit' => array('type' => 'submit', 'value' => 'تغییر رمز عبور', ), ),
            
            'set_pass' => array('user_id' => array('type' => 'text','post' => FALSE, 'validation' => array('required'), 'label' => 'کاربر'), 
            'new_password' => array('type' => 'password', 'post' => FALSE, 'validation' => array('required,minLength[6]'), 'label' => 'رمز عبور جدید'), 'verify_pass' => array('type' => 'password','post' => FALSE, 'validation' => array('required,match[new_password]'), 'label' => 'تکرار رمز عبور جدید'), 'submit' => array('type' => 'submit', 'value' => 'تغییر رمز عبور', ), )
            
            
            
            
            
            );
?>
