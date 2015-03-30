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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>اطلاعات شغلی »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/post"><span>پست‌های سازمانی</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/employment_status"><span>وضعیت‌های استخدامی</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/job_status"><span>وضعیت‌های اشتغال</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/vacation"><span>انواع مرخصی</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/hokm_type"><span>انواع حکم استخدامی</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/degree"><span>درجات</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/t_cat"><span>رده دوره‌های آموزشی</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/notice_post"><span>سمت‌های دارای اخطار تمدید</span></a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>اطلاعات فردی »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/sarbazi"><span>خدمت اجباری</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/study_degree"><span>مقاطع تحصیلی</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/study_field/filter"><span>رشته‌های تحصیلی</span></a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>شعبه »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/lookup/manage/geo"><span>مناطق جغرافیایی</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>مدیریت شعب</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/branch/add"><span>ثبت شعبه</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/branch/manage"><span>مشاهده شعب</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/branch/search"><span>جستجو</span></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>ویرایش شعبه»</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/branch/edit/info"><span>مشخصات پایه</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/branch/edit/props"><span>امکانات شعبه</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/branch/edit/degree"><span>تاریخچه درجات</span></a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>سرپرستی »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/sar/add"><span>ثبت</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/sar/manage"><span>مدیریت</span></a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>ویرایش »</span></a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="<?php echo $path; ?>index.php/sar/edit/info"><span>مشخصات پایه</span></a>
									</li>
									<li>
										<a href="<?php echo $path; ?>index.php/sar/edit/degree"><span>ویرایش درجات</span></a>
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
						<a href="<?php echo $path; ?>index.php/clerk/add"><span>ثبت کارمند جدید</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/clerk/manage"><span>لیست کارمندان</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/clerk/index/view"><span>خلاصه وضعیت</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/clerk/index"><span>گزارش جامع اطلاعات کارمند</span></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>ویرایش »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/profile"><span>مشخصات فردی</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/spouse"><span>افراد تحت تکفل</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/employment"><span>اطلاعات پایه‌ای شغل</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/clerk/edit/education"><span>اطلاعات تحصیلی</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>مرخصی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index/add"><span>ثبت مرخصی</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index/addyear"><span>ثبت مرخصی سالانه</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index"><span>گزارش مرخصی کارمند</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/index2"><span>گزارش کل مرخصی کارمندان</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/search1"><span>گزارش(جستجو)</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/vacation/t_search1"><span>گزارش زمانی</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>تشویقات و تنبیهات</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index/add/1"><span>ثبت تشویق</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index/add/2"><span>ثبت تنبیه</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index"><span>گزارش کارمند</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/p_p/index2"><span>گزارش کل کارمندان</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>دوره‌های آموزشی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/training/index/add"><span>ثبت دوره</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/training/index"><span>گزارش بر اساس کد پرسنلی</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/training/index2"><span>گزارش بر اساس عنوان دوره</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/training/index2/2"><span>دوره‌های طی نشده توسط کارمند</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/lookup/manage/training"><span>مدیریت دوره‌ها</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>مسیر شغلی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/carrier/index/add"><span>ثبت مسیر شغلی</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/carrier/index"><span>گزارش</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>نمرات ارزشیابی</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/evaluation/index/add"><span>ثبت/ ویرایش نمره ارزشیابی</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/evaluation/index"><span>ثبت دسته‌ای نمره ارزشیابی</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/evaluation/index2"><span>گزارش</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>اخطار تمدید</span></a>
				<ul class="dropdown-menu" role="menu">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>باجه عصر »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/notice_asr/add"><span>ثبت</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/notice_asr/manage"><span>مشاهده لیست</span></a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>کارمند »</span></a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo $path; ?>index.php/notice_clerk/index"><span>ثبت</span></a>
							</li>
							<li>
								<a href="<?php echo $path; ?>index.php/notice_clerk/manage"><span>مشاهده لیست</span></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/notice_period/edit"><span>تغییر بازه اخطار</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span><span>گزارشات</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/report/shc"><span>گزارش جامع</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/study_degree"><span>گزارش مقاطع تحصیلی</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/married"><span>وضعیت تاهل کارمندان</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/employment/mixed"><span>اطلاعات کلی کارمندان</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/r2"><span>اطلاعات جامع کارمندان</span></a>
					</li>
					<li>
						<a href="<?php echo $path; ?>index.php/report/r3"><span>اطلاعات تحصیلی کارمندان</span></a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>درباره «یاغیش»</span></a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="<?php echo $path; ?>index.php/site/intro"><span>معرفی</span></a>
					</li>
				</ul>
			</li>
			<li class="toplast">
				<a href="<?php echo $path; ?>index.php/user/logout" ><span>خروج</span></a>
			</li>
		</ul>
	</div><!--/.nav-collapse -->
</nav>