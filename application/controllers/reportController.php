<?php
class reportController {
	public function study_degree() {$a = "SELECT MAX(study_degree),tbl_education.clerk_id,tbl_carrier.job_status FROM tbl_education,tbl_carrier 
		WHERE tbl_education.clerk_id=tbl_carrier.clerk_id AND  tbl_carrier.job_status='1' AND hokm_type<>8 AND tbl_carrier.now_c='1' GROUP BY tbl_education.clerk_id";
		$b = new CDatabase;
		$c = $b -> queryAll($a, TRUE);
		$d = new CView;
		$e = new Ostan;
		$d -> title = 'گزارش مقاطع تحصیلی کارکنان بانک قرض‌الحسنه مهر ایران- ' . $e -> getName();
		if (!is_array($c)) {$d -> error = 'موردی یافت نشد.';
			$d -> run();
		}$f = array(
			'زیردیپلم' => 0,
			'دیپلم' => 0,
			'کاردانی' => 0,
			'کارشناسی' => 0,
			'کارشناسی ارشد' => 0,
			'دکترا' => 0,
			'فوق دکترا' => 0
		);
		if (is_array($c)) {
			foreach ($c as $g) {
				switch($g['MAX(study_degree)']) {case 1 :
						$f['زیردیپلم']++;
						break;
					case 2 :
						$f['دیپلم']++;
						break;
					case 3 :
						$f['کاردانی']++;
						break;
					case 4 :
						$f['کارشناسی']++;
						break;
					case 5 :
						$f['کارشناسی ارشد']++;
						break;
					case 6 :
						$f['دکترا']++;
						break;
					case 7 :
						$f['فوق دکترا']++;
						break;
				}
			}
		}$h = '<script type="text/javascript"> 
		var chart; 
		var chartData = [';
		foreach ($f as $i => $j) {$h .= '{
						year:"' . $i . '",
						income:' . $j . '
						},';
		}$h = rtrim($h, ',');
		$h .= '];';
		$h .= '
           	AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "year";
                // this single line makes the chart a bar chart, 
                // try to set it to false - your bars will turn to columns                
                //chart.rotate = true;
                // the following two lines makes chart 3D
                chart.depth3D = 20;
                chart.angle = 30;

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.fillAlpha = 1;
                categoryAxis.gridAlpha = 0;
                categoryAxis.fillColor = "#FAFAFA";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisColor = "#DADADA";
                valueAxis.title = "";
                valueAxis.gridAlpha = 0.1;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.title = "Income";
                graph.valueField = "income";
                graph.type = "column";
                graph.balloonText = "مقطع [[category]]:[[value]] نفر";
		graph.labelText = "[[value]] نفر";
                graph.lineAlpha = 0;
                graph.fillColors = "#bf1c25";
                graph.fillAlphas = 1;
                chart.addGraph(graph);

                // WRITE
                chart.write("chartdiv");
            });
        </script>';
		if (CUrl::segment(3) === 'print') {$d -> layout = 'chart_print';
			$l = new User;
			$d -> producer = $l -> producer();
		} else {$d -> layout = 'chart';
			$d -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'report/study_degree/print', 'class="box" target="_blank"') . '</p></center>';
		}$d -> script = $h;
		$d -> run();
	}

	public function married() {$a = "SELECT COUNT(tbl_profile.married),tbl_profile.married FROM tbl_profile WHERE tbl_profile.clerk_id IN (
SELECT tbl_carrier.clerk_id FROM tbl_carrier WHERE  tbl_carrier.job_status='1' AND hokm_type <> 8 AND tbl_carrier.now_c='1') GROUP BY tbl_profile.married";
		$b = new CDatabase;
		$c = $b -> queryAll($a, TRUE);
		$d = new CView;
		$e = new Ostan;
		$d -> title = 'وضعیت تاهل کارکنان بانک قرض‌الحسنه مهر ایران- ' . $e -> getName();
		if (!is_array($c)) {$d -> error = 'موردی یافت نشد.';
			$d -> run();
		}$f = array(
			'مجرد'=>0,
			'متاهل'=>0,
			'تعداد فزرندان'=>0
		);
		foreach ($c as $g) {
			switch($g['married']) {case 1 :
					$f['مجرد'] = $g['COUNT(tbl_profile.married)'];
					break;
				case 2 :
					$f['متاهل'] = $g['COUNT(tbl_profile.married)'];
					break;
			}
		}$b -> setTbl('tbl_child');
		$f['تعداد فزرندان'] = $b -> getCountRows();
		$h = '<script type="text/javascript"> 
		var chart; 
		var chartData = [';
		foreach ($f as $i => $j) {$h .= '{
						year:"' . $i . '",
						income:' . $j . '
						},';
		}$h = rtrim($h, ',');
		$h .= '];';
		$h .= '
           	AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "year";
                // this single line makes the chart a bar chart, 
                // try to set it to false - your bars will turn to columns                
                //chart.rotate = true;
                // the following two lines makes chart 3D
                chart.depth3D = 20;
                chart.angle = 30;

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.axisColor = "#DADADA";
                categoryAxis.fillAlpha = 1;
                categoryAxis.gridAlpha = 0;
                categoryAxis.fillColor = "#FAFAFA";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisColor = "#DADADA";
                valueAxis.title = "";
                valueAxis.gridAlpha = 0.1;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.title = "Income";
                graph.valueField = "income";
                graph.type = "column";
                graph.balloonText = "[[category]]:[[value]] نفر";
		graph.labelText = "[[value]] نفر";
                graph.lineAlpha = 0;
                graph.fillColors = "#bf1c25";
                graph.fillAlphas = 1;
                chart.addGraph(graph);

                // WRITE
                chart.write("chartdiv");
            });
        </script>';
		if (CUrl::segment(3) === 'print') {$d -> layout = 'chart_print';
			$l = new User;
			$d -> producer = $l -> producer();
		} else {$d -> layout = 'chart';
			$d -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'report/married/print', 'class="box" target="_blank"') . '</p></center>';
		}$d -> script = $h;
		$d -> run();
	}

	public function shc() {$d = new CView;
		$m = FALSE;
		if (CUrl::segment(3) === 'print')
			$m = TRUE;
		$a = "SELECT COUNT(tbl_branch.code),geo FROM tbl_branch GROUP BY geo";
		$b = new CDatabase;
		$n = $b -> queryAll($a, TRUE);
		$p = array();
		if (is_array($n)) {
			foreach ($n as $q) {$p[$q['geo']] = $q['COUNT(tbl_branch.code)'];
			}
		}
		if (empty($p)) {$d -> error = 'موردی یافت نشد!';
			$d -> run();
		}$a = "SELECT COUNT(tbl_carrier.clerk_id),geo FROM tbl_branch,tbl_carrier 
		WHERE tbl_branch.code=tbl_carrier.branch_id AND tbl_carrier.now_c='1' AND tbl_carrier.job_status='1' AND hokm_type <> 8 GROUP BY tbl_branch.geo";
		$r = $b -> queryAll($a, TRUE);
		$s = array();
		if (is_array($r)) {
			foreach ($r as $t) {$s[$t['geo']] = $t['COUNT(tbl_carrier.clerk_id)'];
			}
		}$a = "SELECT COUNT(*) FROM tbl_carrier 
		WHERE tbl_carrier.now_c='1' AND branch_id='0' AND tbl_carrier.job_status='1' AND hokm_type <> 8";
		$d -> sarCount = $b -> countRows($a);
		$u = new CJcalendar(FALSE);
		$a = "SELECT COUNT(*),degree,geo FROM tbl_degree,tbl_branch WHERE 
		tbl_branch.code=tbl_degree.branch_code AND degree_start='1393' GROUP BY geo,degree";
		$d -> degreeCount = $b -> queryAll($a, TRUE);
		$e = new Ostan;
		$v = 'گزارش جامع آمار پرسنل کارکنان بانک قرض‌الحسنه مهر ایران- ' . $e -> getName();
		$d -> title = $v;
		$d -> branchCount = $p;
		$d -> clerkCount = $s;
		$a = "SELECT COUNT(*),employment_status FROM tbl_carrier WHERE job_status='1' AND now_c='1' AND  hokm_type <> 8 GROUP BY employment_status";
		$d -> eses = $b -> queryAll($a, TRUE);
		$a = "SELECT COUNT(tbl_profile.clerk_id),tbl_profile.married,tbl_carrier.employment_status FROM tbl_carrier,tbl_profile WHERE 
		tbl_carrier.clerk_id = tbl_profile.clerk_id AND tbl_carrier.job_status='1' AND tbl_carrier.now_c='1' AND  tbl_carrier.hokm_type <> 8 GROUP BY tbl_profile.married,tbl_carrier.employment_status";
		$d -> married = $b -> queryAll($a, TRUE);
		$a = "SELECT COUNT(tbl_profile.clerk_id),tbl_profile.sex,tbl_carrier.employment_status FROM tbl_carrier,tbl_profile WHERE 
		tbl_carrier.clerk_id = tbl_profile.clerk_id AND tbl_carrier.job_status='1' AND tbl_carrier.now_c='1' AND  tbl_carrier.hokm_type <> 8 GROUP BY tbl_profile.sex,tbl_carrier.employment_status";
		$d -> sexes = $b -> queryAll($a, TRUE);
		$a = "SELECT COUNT(tbl_carrier.id),tbl_carrier.post,tbl_lookup.name FROM tbl_carrier,tbl_lookup 
		WHERE tbl_lookup.code=tbl_carrier.post AND tbl_lookup.type='post' AND tbl_carrier.job_status='1' AND tbl_carrier.now_c='1' AND  tbl_carrier.hokm_type <> 8 GROUP BY tbl_carrier.post ORDER BY COUNT(tbl_carrier.id) DESC";
		$w = array();
		$x = $b -> queryAll($a, TRUE);
		foreach ($x as $c) {$w[$c['post']] = array('name' => $c['name'], 'count' => $c['COUNT(tbl_carrier.id)'], 'set' => 0);
		}$a = "SELECT degree FROM tbl_sar_degree WHERE degree_start='1393'";
		$y = $b -> queryOne($a);
		if ($y) {$z = new Lookup;
			$d -> sarDeg = $z -> getById($y -> degree, 'sar_degree');
		}$d -> posts = $w;
		if ($m) {$d -> layout = 'print2';
			$d -> ptitle = '<h1>' . $v . '</h1>';
			$l = new User;
			$d -> producer = $l -> producer();
		} else {$d -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'report/shc/print', 'class="box" target="_blank"') . '</p></center>';
		}$d -> run('report/shc');
	}

	public function r2() {$aa = new CGrid;
		$m = FALSE;
		if (CUrl::segment(3) === 'print')
			$m = TRUE;
		$a = "SELECT MAX(tbl_carrier.start),tbl_clerk.id,tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname,tbl_profile.mobile,tbl_profile.sex,tbl_carrier.employment_status,tbl_carrier.job_status,tbl_carrier.post,tbl_carrier.clerk_id,tbl_carrier.branch_id,tbl_employment.date_employed,tbl_profile.married  
		FROM tbl_clerk,tbl_profile,tbl_carrier,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND  tbl_clerk.id=tbl_carrier.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id AND tbl_carrier.now_c='1' AND tbl_carrier.hokm_type<>8 AND tbl_carrier.job_status =1 GROUP BY tbl_carrier.clerk_id ORDER BY tbl_carrier.job_status,tbl_clerk.clerk_number";
		$b = new CDatabase;
		$f = $b -> queryAll($a);
		foreach ($f as $bb => $g) {$f[$bb] -> branch_id2 = $f[$bb] -> branch_id;
		}$aa -> values = $f;
		$aa -> operations = FALSE;
		$aa -> counter = TRUE;
		$aa -> table = 'tbl_clerk';
		$aa -> headers = array('clerk_number' => array('label' => 'کد کارمندی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'date_employed' => array('format' => 'model[CJcalendar,date(Y/m/j,$value)]', 'label' => 'تاریخ استخدام'), 'branch_id' => array('format' => 'model[Carrier::comletePlace($value)]', 'label' => 'محل خدمت'), 'branch_id2' => array('format' => 'type[0:7800]', 'label' => 'کد محل خدمت'), 'post' => array('format' => 'model[Lookup,getById($value,post)]', 'label' => 'پست سازمانی'), 'married' => array('format' => 'type[1:مجرد,2:متاهل]', 'label' => 'وضعیت تاهل'), 'sex' => array('format' => 'type[1:مرد,2:زن]', 'label' => 'جنسیت'));
		$d = new CView;
		$v = 'اطلاعات جامع کارمندان';
		if ($m) {$aa -> operations = FALSE;
			$aa -> noSort = TRUE;
			$aa -> paginate = FALSE;
			$d -> layout = 'print2';
			$d -> ptitle = "<h1>$v</h1>";
			$l = new User;
			$d -> producer = $l -> producer();
		} else {$d -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'report/r2/print', 'class="box" target="_blank"') . '</p></center>';
		}$d -> grid = $aa -> run();
		$d -> title = $v;
		$d -> run();
	}

	public function r3() {$m = FALSE;
		if (CUrl::segment(3) === 'print')
			$m = TRUE;
		$a = "SELECT edu.study_degree,edu.study_field,edu.date_get,edu.place,tbl_clerk.id,tbl_clerk.clerk_number,tbl_profile.name,tbl_profile.lastname  
		FROM tbl_education edu,tbl_clerk,tbl_profile,tbl_carrier,tbl_employment WHERE tbl_clerk.id=tbl_profile.clerk_id AND  tbl_clerk.id=tbl_carrier.clerk_id AND tbl_clerk.id=tbl_employment.clerk_id AND tbl_clerk.id=edu.clerk_id AND tbl_carrier.now_c='1' AND tbl_carrier.hokm_type<>8 AND tbl_carrier.job_status =1 AND edu.study_degree=(SELECT MAX(tbl_education.study_degree) 
FROM tbl_education  WHERE tbl_education.clerk_id=edu.clerk_id) GROUP BY tbl_clerk.id ORDER BY tbl_clerk.clerk_number";
		$b = new CDatabase;
		$aa = new CGrid;
		$aa -> values = $b -> queryAll($a);
		$aa -> operations = FALSE;
		$aa -> counter = TRUE;
		$aa -> table = 'tbl_clerk';
		$aa -> headers = array('clerk_number' => array('label' => 'کد کارمندی'), 'name' => array('label' => 'نام'), 'lastname' => array('label' => 'نام خانوادگی'), 'study_degree' => array('format' => 'model[Lookup,getById($value,study_degree)]', 'label' => 'مدرک تحصیلی'), 'study_field' => array('format' => 'model[StudyField,getById($value)]', 'label' => 'رشته تحصیلی'), 'place' => array('label' => 'محل تحصیل'), 'date_get' => array('format' => 'model[Cal,getDate($value,Y)]', 'label' => 'تاریخ اخذ مدرک'), );
		$d = new CView;
		$v = 'اطلاعات تحصیلی کارمندان';
		if ($m) {$aa -> operations = FALSE;
			$aa -> noSort = TRUE;
			$aa -> paginate = FALSE;
			$d -> layout = 'print2';
			$d -> ptitle = "<h1>$v</h1>";
			$l = new User;
			$d -> producer = $l -> producer();
		} else {$d -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'report/r3/print', 'class="box" target="_blank"') . '</p></center>';
		}$d -> grid = $aa -> run();
		$d -> title = $v;
		$d -> run();
	}

}
