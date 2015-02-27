<?php
return array(
		'login'=>array('allow','?','user/welcome'),
		'logout,welcome,change_pass'=>array('allow','@','user/login'),
		'add'=>array('allow','tenkai'),
	);
?>