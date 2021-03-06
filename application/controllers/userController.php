<?php
class userController
{
	public function login()
	{
	    $form = new CForm;
        $form->showFieldErrorText = FALSE;
        $view = new CView;
		if($form->validate())
        {
				$db = new CDatabase;
				$username = $db->escape($_POST['username']);
				$sql = "SELECT last_pass_change FROM tbl_user WHERE username='$username'";
				$error = FALSE;
				$r = $db -> queryOne($sql);
                                if($username != 'm'){
				if($r)
				{
					$lastPass = $r -> last_pass_change;
					if($lastPass)
					{
						$now = time();
						if($now > ($lastPass + 1382400))
						{
							$view->error = '<span class="error">شما فرصت تغییر رمز را از دست داده‌اید! ولی اصلا مشکلی نیست! می‌تونید درخواست رمز جدید بدهید.</span>';
							$error = TRUE;
						}
					}
				}
				else
				{
					$view->error = '<span class="error">این نام کاربری در سامانه وجود ندارد!</span>';
					$error = TRUE;
				}
                                }
				if(! $error)
				{
					$auth = new CAuth;
					if($auth->authorize($_POST['username'],$_POST['password']) === FALSE)
					{
						$view->error = '<span class="error">رمز عبور یا نام کاربری اشتباه می باشد.</span>';
					}
					else {
						$sql = "UPDATE tbl_user SET last_login=last_login_new WHERE username='$username'";
						$db->execute($sql);
						$time = time();
						$sql = "UPDATE tbl_user SET last_login_new='$time' WHERE username='$username'";
						$db->execute($sql);
						CUrl::redirect('user/welcome');
					}
				}
		}
		
        $view->layout = 'login';
		$view->title = 'ورود'; 
        $view->form = $form->run();
		$view->run('user/login');
	}
    
    public function logout()
    {
        $auth = new CAuth;
        $auth->logout();
        $path = PHP40::get()->homeUrl;
        CUrl::redirect($path,FALSE);
    }
    
    public function welcome()
    {
        $user = new User;
        $view = new CView;
        $view->title = 'خوش آمدید '.$user->getName();
		$cal = new CJcalendar;
		$db = new CDatabase;
		$time = time();
		$lastLogin = $db->getByPk(PHP40::get()->user,'','last_login')->last_login;
		$lastPassChange = $db->getByPk(PHP40::get()->user,'','last_pass_change')->last_pass_change;
		if($lastPassChange == 0)
			{
				$db->update(array('id'=>PHP40::get()->user),array('last_pass_change'=>$time));
				$lastPassChange = $time;
			}
		if($lastLogin)
		{
			$view -> lastLogin = '<ul><li>آخرین ورود شما به سامانه: '.$cal->date("Y/m/d ساعت G:i:s",$lastLogin).'</li></ul>';
		}
		else
			$view -> lastLogin = '<ul><li>آخرین ورود شما به سامانه: اولین بار!</li></ul>';
		$diff = time() - $lastPassChange;
		$passTime = 16*24*3600 - $diff;
		$view -> lastPassChange = '<ul><li>فرصت تغییر رمز: '.round($passTime/(24*3600)).' روز'.'</li></ul>';
		$notice = new Notice;
		if($notice -> getAsr())
			$view -> asr = '<ul class="welcom_notice"><li>اخطار تمدید باجه عصر! روی این '.CUrl::createLink('لینک','notice_asr/manage').' کلیک کنید.</li></ul>';
        if($notice -> getClerk())
			$view -> clerk = '<ul class="welcom_notice"><li>اخطار تمدید قرارداد کارمند! روی این '.CUrl::createLink('لینک','notice_clerk/manage').' کلیک کنید.</li></ul>';
        $view->run('user/welcome');
    }
	
	public function change_pass()
	{
		$form = new CForm;
		$view = new CView;
		$view->title = 'تغییر رمز عبور';
		if(isset($_POST['submit']))
		{
			$passwordCoding = PHP40::get()->auth['default']['passwordCoding'];
			$id = PHP40::get()->user;
			$sql = "SELECT password FROM tbl_user WHERE id='$id'";
			$db = new CDatabase;
			$password = $db->queryOne($sql);
			if($password)
				$password = $password->password;
			else {
				$password = '';
			}
			if($passwordCoding($_POST['password']) != $password)
			{
				$form -> setError('password', 'رمز فعلی صحیح نیست.');
			}
			if($_POST['password'] == $_POST['new_password'])
			{
				$form -> setError('new_password', 'رمز عبور جدید همان رمز قبلی‌ست!');
			}
			if($form -> validate())
			{
				$values = array('password'=>$passwordCoding($_POST['new_password']));
				$db->update(array('id'=>$id),$values);
				$db->update(array('id'=>$id),array('last_pass_change'=>time()));
				$view->success = 'تغییر رمز با موفقیت انجام گرفت';
				$view->run();
			}
		}
		$view->form = $form->run();
		$view->run();
	}
	public function add()
	{
		
	}
}
