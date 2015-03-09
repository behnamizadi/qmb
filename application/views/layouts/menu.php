<div id="menu">
    <ul id="css3menu1" class="topmenu" style="margin-right:5px">
    	 <li class="topfirst"><a href="#" style="height:17px;line-height:17px;"><span>کاربر</span></a>
            <ul>
                <li><a href="<?php echo $path; ?>index.php/user/change_pass">تغییر رمز عبور</a></li>
                
            </ul>
        </li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>اطلاعات پایه</span></a>
            <ul>
                <li><a href="#"><span>اطلاعات شغلی »</span></a>
                    <ul>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/post">پست‌های سازمانی</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/employment_status">وضعیت‌های استخدامی</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/job_status">وضعیت‌های اشتغال</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/vacation">انواع مرخصی</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/hokm_type">انواع حکم استخدامی</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/degree">درجات</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/t_cat">رده دوره‌های آموزشی</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/notice_post">سمت‌های دارای اخطار تمدید</a></li>
                    </ul>
                </li>
                <li><a href="#"><span>اطلاعات فردی »</span></a>
                    <ul>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/sarbazi">خدمت اجباری</a></li>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/study_degree">مقاطع تحصیلی</a></li>
                        <li><a href="<?php echo $path; ?>index.php/study_field/filter">رشته‌های تحصیلی</a></li>
                    </ul>
                </li>
                <li><a href="#"><span>شعبه »</span></a>
                    <ul>
                        <li><a href="<?php echo $path; ?>index.php/lookup/manage/geo">مناطق جغرافیایی</a></li>
                    </ul>
                </li>
            </ul>
        </li>
	<li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>مدیریت شعب</span></a>
        <ul>
            <li><a href="<?php echo $path; ?>index.php/branch/add">ثبت شعبه</a></li>
            <li><a href="<?php echo $path; ?>index.php/branch/manage">مشاهده شعب</a></li>
            <li><a href="<?php echo $path; ?>index.php/branch/search">جستجو</a></li>
            <li><a href="#"><span>ویرایش شعبه»</span></a>
                <ul>
                   <li><a href="<?php echo $path; ?>index.php/branch/edit/info">مشخصات پایه</a></li>
                   <li><a href="<?php echo $path; ?>index.php/branch/edit/props">امکانات شعبه</a></li>
                   <li><a href="<?php echo $path; ?>index.php/branch/edit/degree">تاریخچه درجات</a></li>
                </ul>
            </li>
            <li><a href="#"><span>سرپرستی »</span></a>
                <ul>
                   <li><a href="<?php echo $path; ?>index.php/sar/add">ثبت</a></li>
                   <li><a href="<?php echo $path; ?>index.php/sar/manage">مدیریت</a></li>
                   <li><a href="#"><span>ویرایش »</span></a>
		                <ul>
		                   <li><a href="<?php echo $path; ?>index.php/sar/edit/info">مشخصات پایه</a></li>
		                   <li><a href="<?php echo $path; ?>index.php/sar/edit/degree">ویرایش درجات</a></li>
		                </ul>
		            </li>
                </ul>
            </li>
        </ul></li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>مدیریت کارمندان</span></a>
        <ul>
            <li><a href="<?php echo $path; ?>index.php/clerk/add">ثبت کارمند جدید</a></li>
            <li><a href="<?php echo $path; ?>index.php/clerk/manage">لیست کارمندان</a></li>
            <li><a href="<?php echo $path; ?>index.php/clerk/index/view">خلاصه وضعیت</a></li>
            <li><a href="<?php echo $path; ?>index.php/clerk/index">گزارش جامع اطلاعات کارمند</a></li>
            <li><a href="#"><span>ویرایش »</span></a>
                <ul>
                   <li><a href="<?php echo $path; ?>index.php/clerk/edit/profile">مشخصات فردی</a></li>
                   <li><a href="<?php echo $path; ?>index.php/clerk/edit/spouse">افراد تحت تکفل</a></li>
                   <li><a href="<?php echo $path; ?>index.php/clerk/edit/employment">اطلاعات پایه‌ای شغل</a></li>
                   <li><a href="<?php echo $path; ?>index.php/clerk/edit/education">اطلاعات تحصیلی</a></li>
                </ul>
            </li>
        </ul></li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>مرخصی</span></a>
            <ul>
                <li><a href="<?php echo $path; ?>index.php/vacation/index/add">ثبت مرخصی</a></li>
                <li><a href="<?php echo $path; ?>index.php/vacation/index/addyear">ثبت مرخصی سالانه</a></li>
                <li><a href="<?php echo $path; ?>index.php/vacation/index">گزارش مرخصی کارمند</a></li>
                <li><a href="<?php echo $path; ?>index.php/vacation/index2">گزارش کل مرخصی کارکنان</a></li>
                <li><a href="<?php echo $path; ?>index.php/vacation/search1">گزارش(جستجو)</a></li>
                <li><a href="<?php echo $path; ?>index.php/vacation/t_search1">گزارش زمانی</a></li>
            </ul>
        </li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>تشویقات و تنبیهات</span></a>
            <ul>
                <li><a href="<?php echo $path; ?>index.php/p_p/index/add/1">ثبت تشویق</a></li>
                <li><a href="<?php echo $path; ?>index.php/p_p/index/add/2">ثبت تنبیه</a></li>
                <li><a href="<?php echo $path; ?>index.php/p_p/index">گزارش کارمند</a></li>
                <li><a href="<?php echo $path; ?>index.php/p_p/index2">گزارش کل کارمندان</a></li>
            </ul>
        </li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>دوره‌های آموزشی</span></a>
        <ul>
        	<li><a href="<?php echo $path; ?>index.php/training/index/add">ثبت دوره</a></li>
            <li><a href="<?php echo $path; ?>index.php/training/index">گزارش بر اساس شماره کارمندی</a></li>
            <li><a href="<?php echo $path; ?>index.php/training/index2">گزارش بر اساس عنوان دوره</a></li>
            <li><a href="<?php echo $path; ?>index.php/training/index2/2">دوره‌های طی نشده توسط کارمند</a></li>
            <!-- <li><a href="<?php echo $path; ?>index.php/training/search">گزارش دوره‌های کارمندان</a></li> -->
            <li><a href="<?php echo $path; ?>index.php/lookup/manage/training">مدیریت دوره‌ها</a></li>
        </ul></li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>مسیر شغلی</span></a>
        <ul>
            <li><a href="<?php echo $path; ?>index.php/carrier/index/add">ثبت مسیر شغلی</a></li>
            <li><a href="<?php echo $path; ?>index.php/carrier/index">گزارش</a></li>
        </ul></li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>نمرات ارزشیابی</span></a>
        <ul>
            <li><a href="<?php echo $path; ?>index.php/evaluation/index/add">ثبت/ ویرایش نمره ارزشیابی</a></li>
            <li><a href="<?php echo $path; ?>index.php/evaluation/index">ثبت دسته‌ای نمره ارزشیابی</a></li>
            <li><a href="<?php echo $path; ?>index.php/evaluation/index2">گزارش</a></li>
        </ul></li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>اخطار تمدید</span></a>
        <ul>
            <li><a href="#">باجه عصر »</a>
            	<ul>
                   <li><a href="<?php echo $path; ?>index.php/notice_asr/add">ثبت</a></li>
                   <li><a href="<?php echo $path; ?>index.php/notice_asr/manage">مشاهده لیست</a></li>
                </ul>
            </li>
            <li><a href="#">کارمند »</a>
            	<ul>
                   <li><a href="<?php echo $path; ?>index.php/notice_clerk/index">ثبت</a></li>
                   <li><a href="<?php echo $path; ?>index.php/notice_clerk/manage">مشاهده لیست</a></li>
                </ul>
            </li>
	    <li><a href="<?php echo $path; ?>index.php/notice_period/edit">تغییر بازه اخطار</a></li>
        </ul></li>
        <li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>گزارشات</span></a>
        <ul>
        	<li><a href="<?php echo $path; ?>index.php/report/shc">گزارش جامع</a></li>
            <li><a href="<?php echo $path; ?>index.php/report/study_degree">گزارش مقاطع تحصیلی</a></li>
		<li><a href="<?php echo $path; ?>index.php/report/married">وضعیت تاهل کارکنان</a></li>
            <!-- <li><a href="<?php echo $path; ?>index.php/employment/bimeh">شماره بیمه کارمندان</a></li>
            <li><a href="<?php echo $path; ?>index.php/employment/date_employed">تاریخ استخدام کارمندان</a></li>
		<li><a href="<?php echo $path; ?>index.php/employment/hesab">شماره حساب کارمندان</a></li>
		<li><a href="<?php echo $path; ?>index.php/employment/bon">شماره بن‌کارت کارمندان</a></li> -->
		<li><a href="<?php echo $path; ?>index.php/employment/mixed">اطلاعات کلی کارمندان</a></li>
		<li><a href="<?php echo $path; ?>index.php/report/r2">اطلاعات جامع کارمندان</a></li>
		<li><a href="<?php echo $path; ?>index.php/report/r3">اطلاعات تحصیلی کارمندان</a></li>
        </ul></li>
	<li class="topmenu"><a href="#" style="height:17px;line-height:17px;"><span>درباره «یاغیش»</span></a>
	<ul>
		<li><a href="<?php echo $path; ?>index.php/site/intro">معرفی</a></li>
	</ul></li>
        <li class="toplast"><a href="<?php echo $path; ?>index.php/user/logout" style="height:17px;line-height:17px;">خروج</a></li>
    </ul>
</div>
