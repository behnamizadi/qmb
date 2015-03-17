<nav class="navbar navbar-fixed-top navbar-default">
	<div class="navbar-header pull-right">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav nav-pills">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>کاربر</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/user/change_pass"><span>تغییر رمز عبور</span></a>
					</li>

				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>اطلاعات پایه</span></a>
				<ul class="dropdown-menu" role="menu">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>اطلاعات شغلی »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/post">پست‌های سازمانی</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/employment_status">وضعیت‌های استخدامی</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/job_status">وضعیت‌های اشتغال</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/vacation">انواع مرخصی</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/hokm_type">انواع حکم استخدامی</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/degree">درجات</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/t_cat">رده دوره‌های آموزشی</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/notice_post">سمت‌های دارای اخطار تمدید</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>اطلاعات فردی »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/sarbazi">خدمت اجباری</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/study_degree">مقاطع تحصیلی</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/study_field/filter">رشته‌های تحصیلی</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>شعبه »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/geo">مناطق جغرافیایی</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>مدیریت شعب</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/branch/add">ثبت شعبه</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/branch/manage">مشاهده شعب</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/branch/search">جستجو</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>ویرایش شعبه»</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/branch/edit/info">مشخصات پایه</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/branch/edit/props">امکانات شعبه</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/branch/edit/degree">تاریخچه درجات</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>سرپرستی »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/sar/add">ثبت</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/sar/manage">مدیریت</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>ویرایش »</span></a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="<?php echo $path; ?>index.php/sar/edit/info">مشخصات پایه</a>
									</li>
									<li>
										<a href="<?php echo $path; ?>index.php/sar/edit/degree">ویرایش درجات</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>مدیریت کارمندان</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/clerk/add">ثبت کارمند جدید</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/clerk/manage">لیست کارمندان</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/clerk/index/view">خلاصه وضعیت</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/clerk/index">گزارش جامع اطلاعات کارمند</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>ویرایش »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/profile">مشخصات فردی</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/spouse">افراد تحت تکفل</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/employment">اطلاعات پایه‌ای شغل</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/education">اطلاعات تحصیلی</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>مرخصی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index/add">ثبت مرخصی</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index/addyear">ثبت مرخصی سالانه</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index">گزارش مرخصی کارمند</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index2">گزارش کل مرخصی کارکنان</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/search1">گزارش(جستجو)</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/t_search1">گزارش زمانی</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>تشویقات و تنبیهات</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index/add/1">ثبت تشویق</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index/add/2">ثبت تنبیه</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index">گزارش کارمند</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index2">گزارش کل کارمندان</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>دوره‌های آموزشی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/training/index/add">ثبت دوره</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/training/index">گزارش بر اساس کد پرسنلی</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/training/index2">گزارش بر اساس عنوان دوره</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/training/index2/2">دوره‌های طی نشده توسط کارمند</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/lookup/manage/training">مدیریت دوره‌ها</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>مسیر شغلی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/carrier/index/add">ثبت مسیر شغلی</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/carrier/index">گزارش</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>نمرات ارزشیابی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/evaluation/index/add">ثبت/ ویرایش نمره ارزشیابی</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/evaluation/index">ثبت دسته‌ای نمره ارزشیابی</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/evaluation/index2">گزارش</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>اخطار تمدید</span></a>
				<ul class="dropdown-menu" role="menu">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>باجه عصر »</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/notice_asr/add">ثبت</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/notice_asr/manage">مشاهده لیست</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>کارمند »</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/notice_clerk/index">ثبت</a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/notice_clerk/manage">مشاهده لیست</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/notice_period/edit">تغییر بازه اخطار</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>گزارشات</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/report/shc">گزارش جامع</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/study_degree">گزارش مقاطع تحصیلی</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/married">وضعیت تاهل کارکنان</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/employment/mixed">اطلاعات کلی کارمندان</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/r2">اطلاعات جامع کارمندان</a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/r3"><span>اطلاعات تحصیلی کارمندان</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>درباره «یاغیش»</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/site/intro">معرفی</a>
					</li>
				</ul>
			</li>
			<li class="toplast">
				<a href="<?php echo $path; ?>index.php/user/logout" ><span>خروج</span></a>
			</li>
		</ul>
	</div><!--/.nav-collapse -->
</nav>