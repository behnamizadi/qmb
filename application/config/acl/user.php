<?php
return array(
		'login'=>array('allow','?','user/welcome'),
		'logout,welcome,change_pass'=>array('allow','@','user/login'),
		'set_pass'=>array('allow','admin,tenkai'),	
	);
?>