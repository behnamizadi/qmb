<?php
class branchController {
	public function add() {
		$e = new CForm;
		$e -> showFieldErrorText = FALSE;
		$g = new CJcalendar(FALSE);
		if ($e -> validate()) {$j = $g -> date('H');
			$k = $g -> date('i');
			$l = $g -> date('s');
			$n = $g -> mktime($j, $k, $l, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']);
			$p = new CDatabase;
			$q = time();
			$p -> additional = array('date_start' => $n, 'time_added' => $q, 'ostan' => PHP40::get() -> defines['ostan']);
			$p -> insert();
			CUrl::redirect('branch/props/' . $_POST['code'] . '/' . $q);
		}$r = new CView;
		$r -> degree_start = $g -> date('Y');
		$r -> form = $e -> run();
		$r -> title = 'افزودن شعبه';
		$r -> run();
	}

	public function degree() {
		$t = CUrl::segment(3);
		$p = new CDatabase;
		$u = 'SELECT COUNT(*) FROM tbl_branch WHERE code=\'' . $t . '\' AND time_added=\'' . CUrl::segment(4) . '\'';
		$r = new CView;
		if ($p -> countRows($u)) {$w = new CForm;
			$w -> showFieldErrorText = FALSE;
			if (isset($_POST['submit'])) {$x = count($_POST['degree']);
				for ($y = 0; $y < $x; $y++) {$z = TRUE;
					if (!empty($_POST['degree'][$y]) || !empty($_POST['degree_start'][$y])) {$z = FALSE;
					}
					if (!empty($_POST['degree'][$y]) && !empty($_POST['degree_start'][$y])) {$z = TRUE;
					}
					if ($z === FALSE) {
						if (empty($_POST['degree'][$y])) {$w -> setError("degree[$y]", 'e');
						}
						if (empty($_POST['degree_start'][$y])) {$w -> setError("degree_start[$y]", 'e');
						}
					}
				}
				if ($w -> validate() === TRUE) {$p -> setTbl('tbl_degree');
					for ($y = 0; $y < $x; $y++) {$p -> additional = array('degree' => $_POST['degree'][$y], 'degree_start' => $_POST['degree_start'][$y], 'branch_code' => $t);
						$p -> insert();
					}CUrl::redirect('branch/manage');
				}
			}$r -> title = 'ورود اطلاعات تاریخچه درجه شعبه';
			$r -> f = $w;
			$r -> run('branch/degree');
		} else {$r -> title = 'اشکال در فرایند ثبت';
			$r -> error = 'مشکلی در فرایند ثبت به وجود آمده است.';
			$r -> run();
		}
	}

	public function degrees() {
		$aa = CUrl::segment(3);
		$r = new CView;
		$e = new CForm;
		$e -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if ($e -> validate()) {$_POST['error'] = 0;
				$p = new CDatabase;
				$p -> setTbl('tbl_degree');
				$p -> additional = array('branch_code' => $aa);
				$p -> insert();
			} else
				$_POST['error'] = 1;
		}$r -> body = Degree::degreeHistory($aa, array('view' => FALSE, 'edit' => FALSE, 'delete' => FALSE, 'branch/degreeedit/$value->id/' . $aa => array('icon' => 'public/images/edit.png', 'alt' => 'ویرایش', 'title' => 'ویرایش'), 'branch/degreedelete/$value->id/' . $aa => array('icon' => 'public/images/delete.png', 'alt' => 'حذف', 'title' => 'حذف', 'message' => 'واقعا می‌خوای حذفش کنی؟')));
		$r -> title = 'مدیریت درجات شعبه ' . $aa;
		$r -> form = $e -> run();
		$r -> run('branch/degrees');
	}

	public function degreeedit() {$bb = CUrl::segment(3);
		$aa = CUrl::segment(4);
		if (!$bb)
			CUrl::redirect(404);
		$p = new CDatabase;
		$p -> setTbl('tbl_degree');
		$cc = $p -> getByPk($bb);
		if (!$cc)
			CUrl::redirect(404);
		$e = new CForm;
		$e -> dontClose = TRUE;
		$e -> showFieldErrorText = FALSE;
		if (isset($_POST['submit'])) {
			if ($e -> validate()) {$p -> update(array('id' => $bb));
				CUrl::redirect('branch/degrees/' . $aa);
			}
		}$r = new CView;
		$r -> title = 'ویرایش درجه شعبه ' . $aa;
		$r -> branchCode = $aa;
		$r -> model = $cc;
		$r -> form = $e -> run();
		$r -> run('branch/degreeedit');
	}

	public function degreedelete() {$bb = CUrl::segment(3);
		$aa = CUrl::segment(4);
		$p = new CDatabase;
		$p -> setTbl('tbl_degree');
		$p -> delete(array('id' => $bb));
		CUrl::redirect('branch/degrees/' . $aa);
	}

	public function props() {$aa = CUrl::segment(3);
		$q = CUrl::segment(4);
		$p = new CDatabase;
		$u = 'SELECT COUNT(*) FROM tbl_branch WHERE code=\'' . $aa . '\' AND time_added=\'' . $q . '\'';
		$r = new CView;
		if ($p -> countRows($u)) {$e = new CForm;
			$e -> showFieldErrorText = FALSE;
			$e -> showFieldErrorColor = TRUE;
			if ($e -> validate()) {$p = new CDatabase;
				$p -> setTbl('tbl_props');
				if (isset($_POST['pos'])) {
					if (!empty($_POST['pos_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'pos', 'quantity' => $_POST['pos_number']));
					}
				}
				if (isset($_POST['atm'])) {
					if (!empty($_POST['atm_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'atm', 'quantity' => $_POST['atm_number']));
					}
				}
				if (isset($_POST['asr'])) {
					if (!empty($_POST['asr_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'asr', 'quantity' => $_POST['asr_number']));
					}
				}
				if (isset($_POST['mpls'])) {
					if (!empty($_POST['mpls_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'mpls', 'quantity' => $_POST['mpls_number']));
					}
				}
				if (isset($_POST['adsl'])) {
					if (!empty($_POST['adsl_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'adsl', 'quantity' => $_POST['adsl_number']));
					}
				}
				if (isset($_POST['vsat'])) {
					if (!empty($_POST['vsat_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'vsat', 'quantity' => $_POST['vsat_number']));
					}
				}
				if (isset($_POST['card'])) {
					if (!empty($_POST['card_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'card', 'quantity' => $_POST['card_number']));
					}
				}
				if (isset($_POST['nobat'])) {
					if (!empty($_POST['nobat_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'nobat', 'quantity' => $_POST['nobat_number']));
					}
				}
				if (isset($_POST['dozdgir'])) {
					if (!empty($_POST['dozdgir_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'dozdgir', 'quantity' => $_POST['dozdgir_number']));
					}
				}
				if (isset($_POST['camera'])) {
					if (!empty($_POST['camera_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'camera', 'quantity' => $_POST['camera_number']));
					}
				}
				if (isset($_POST['copy'])) {
					if (!empty($_POST['copy_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'copy', 'quantity' => $_POST['copy_number']));
					}
				}
				if (isset($_POST['gas_cooler'])) {
					if (!empty($_POST['gas_cooler_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'gas_cooler', 'quantity' => $_POST['gas_cooler_number']));
					}
				}
				if (isset($_POST['water_cooler'])) {
					if (!empty($_POST['water_cooler_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'water_cooler', 'quantity' => $_POST['water_cooler_number']));
					}
				}
				if (isset($_POST['up_pool'])) {
					if (!empty($_POST['up_pool_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'up_pool', 'quantity' => $_POST['up_pool_number']));
					}
				}
				if (isset($_POST['miz_pool'])) {
					if (!empty($_POST['miz_pool_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'miz_pool', 'quantity' => $_POST['miz_pool_number']));
					}
				}CUrl::redirect('branch/degree/' . $aa . '/' . $q);
			}$r -> form = $e -> run();
			$r -> title = 'امکانات شعبه';
			$r -> run('branch/props');
		} else {$r -> title = 'اشکال در فرایند ثبت';
			$r -> error = 'مشکلی در فرایند ثبت به وجود آمده است.';
			$r -> run();
		}
	}

	public function propsedit() {$aa = CUrl::segment(3);
		$u = "SELECT id,name,quantity FROM tbl_props WHERE branch_code='$aa'";
		$p = new CDatabase;
		$r = new CView;
		$dd = $p -> queryAll($u);
		$r -> props = $dd;
		$e = new CForm;
		if ($e -> validate()) {$p = new CDatabase;
			$p -> setTbl('tbl_props');
			$ee = $ff = $gg = $hh = $ii = $jj = $kk = $ll = $mm = $nn = $oo = $pp = $qq = $rr = $ss = TRUE;
			if (is_array($dd)) {
				foreach ($dd as $tt) {
					switch($tt->name) {case  'pos' :
							if (isset($_POST['pos'])) {
								if (!empty($_POST['pos_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[pos_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$ee = FALSE;
							break;
						case  'atm' :
							if (isset($_POST['atm'])) {
								if (!empty($_POST['atm_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[atm_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}
							break;
						case  'asr' :
							if (isset($_POST['asr'])) {
								if (!empty($_POST['asr_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[asr_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$hh = FALSE;
							break;
						case  'mpls' :
							if (isset($_POST['mpls'])) {
								if (!empty($_POST['mpls_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[mpls_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$gg = FALSE;
							break;
						case  'adsl' :
							if (isset($_POST['adsl'])) {
								if (!empty($_POST['adsl_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[adsl_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$ii = FALSE;
							break;
						case  'vsat' :
							if (isset($_POST['vsat'])) {
								if (!empty($_POST['vsat_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[vsat_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$jj = FALSE;
							break;
						case  'card' :
							if (isset($_POST['card'])) {
								if (!empty($_POST['card_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[card_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$kk = FALSE;
							break;
						case  'nobat' :
							if (isset($_POST['nobat'])) {
								if (!empty($_POST['nobat_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[nobat_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$ll = FALSE;
							break;
						case  'dozdgir' :
							if (isset($_POST['dozdgir'])) {
								if (!empty($_POST['dozdgir_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[dozdgir_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$mm = FALSE;
							break;
						case  'camera' :
							if (isset($_POST['camera'])) {
								if (!empty($_POST['camera_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[camera_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$nn = FALSE;
							break;
						case  'copy' :
							if (isset($_POST['copy'])) {
								if (!empty($_POST['copy_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[copy_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$oo = FALSE;
							break;
						case  'gas_cooler' :
							if (isset($_POST['gas_cooler'])) {
								if (!empty($_POST['gas_cooler_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[gas_cooler_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$pp = FALSE;
							break;
						case  'water_cooler' :
							if (isset($_POST['water_cooler'])) {
								if (!empty($_POST['water_cooler_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[water_cooler_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$qq = FALSE;
							break;
						case  'up_pool' :
							if (isset($_POST['up_pool'])) {
								if (!empty($_POST['up_pool_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[up_pool_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$rr = FALSE;
							break;
						case  'miz_pool' :
							if (isset($_POST['miz_pool'])) {
								if (!empty($_POST['miz_pool_number'])) {$u = "UPDATE tbl_props SET quantity=$_POST[miz_pool_number] WHERE id='$tt->id'";
									$p -> execute($u);
								} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
									$p -> execute($u);
								}
							} else {$u = "DELETE FROM tbl_props  WHERE id='$tt->id'";
								$p -> execute($u);
							}$ss = FALSE;
							break;
					}
				}
			}
			if (isset($_POST['pos']) && $ee) {
				if (!empty($_POST['pos_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'pos', 'quantity' => $_POST['pos_number']));
				}
			}
			if (isset($_POST['atm']) && $ff) {
				if (!empty($_POST['atm_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'atm', 'quantity' => $_POST['atm_number']));
				}
			}
			if (isset($_POST['asr']) && $hh) {
				if (!empty($_POST['asr_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'asr', 'quantity' => $_POST['asr_number']));
				}
			}
			if (isset($_POST['mpls']) && $gg) {
				if (!empty($_POST['mpls_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'mpls', 'quantity' => $_POST['mpls_number']));
				}
			}
			if (isset($_POST['adsl']) && $ii) {
				if (!empty($_POST['adsl_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'adsl', 'quantity' => $_POST['adsl_number']));
				}
			}
			if (isset($_POST['vsat']) && $jj) {
				if (!empty($_POST['vsat_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'vsat', 'quantity' => $_POST['vsat_number']));
				}
			}
			if (isset($_POST['card']) && $kk) {
				if (!empty($_POST['card_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'card', 'quantity' => $_POST['card_number']));
				}
			}
			if (isset($_POST['nobat']) && $ll) {
				if (!empty($_POST['nobat_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'nobat', 'quantity' => $_POST['nobat_number']));
				}
			}
			if (isset($_POST['dozdgir']) && $mm) {
				if (!empty($_POST['dozdgir_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'dozdgir', 'quantity' => $_POST['dozdgir_number']));
				}
			}
			if (isset($_POST['camera']) && $nn) {
				if (!empty($_POST['camera_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'camera', 'quantity' => $_POST['camera_number']));
				}
			}
			if (isset($_POST['copy']) && $oo) {
				if (!empty($_POST['copy_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'copy', 'quantity' => $_POST['copy_number']));
				}
			}
			if (isset($_POST['gas_cooler']) && $pp) {
				if (!empty($_POST['gas_cooler_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'gas_cooler', 'quantity' => $_POST['gas_cooler_number']));
				}
			}
			if (isset($_POST['water_cooler']) && $qq) {
				if (!empty($_POST['water_cooler_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'water_cooler', 'quantity' => $_POST['water_cooler_number']));
				}
			}
			if (isset($_POST['up_pool']) && $rr) {
				if (!empty($_POST['up_pool_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'up_pool', 'quantity' => $_POST['up_pool_number']));
				}
			}
			if (isset($_POST['miz_pool']) && $ss) {
				if (!empty($_POST['miz_pool_number'])) {$p -> insert(array('branch_code' => $aa, 'name' => 'miz_pool', 'quantity' => $_POST['miz_pool_number']));
				}
			}CUrl::redirect('branch/manage');
		}
		$r -> form = $e;
		$r -> title = 'ویرایش امکانات شعبه';
		$r -> run('branch/propsedit');
	}

	public function manage() {$uu = new CGrid;
		$uu -> counter = TRUE;
		$uu -> counterWidth = '25px';
		$uu -> headers = array('code', 'name', 'city' => array('format' => 'model[Cities,getById($value)]'), 'tel', 'fax', 'boss', 'mob');
		$uu -> operations = array('edit' => FALSE);
		$uu -> sort = 'code';
		$r = new CView;
		$vv = new Ostan;
		$ww = 'لیست شعب ' . $vv -> getName();
		if (CUrl::segment(3) == 'print') {$uu -> operations = FALSE;
			$uu -> noSort = TRUE;
			$uu -> paginate = FALSE;
			$r -> layout = 'print2';
			$r -> ptitle = '<h1>' . $ww . '</h1>';
			$xx = new User;
			$r -> producer = $xx -> producer();
		} else {$r -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'branch/manage/print', 'class="box" target="_blank"') . '</p></center>';
		}$r -> body = $uu -> run();
		$r -> title = $ww;
		$r -> run('branch/manage');
	}

	public function search() {$e = new CForm;
		if (isset($_POST['submit'])) {$yy = new Branch;
			if (!$yy -> getNameById($_POST['code'])) {$e -> setError('code', 'شعبه ای با این کد وجود ندارد.');
			}
			if ($e -> validate() == TRUE) {CUrl::redirect('branch/view/' . $_POST['code']);
			}
		}$r = new CView;
		$r -> title = 'جستجوی شعبه';
		$r -> form = $e -> run();
		$r -> run();
	}

	public function view() {$zz = CUrl::segment(3);
		$aaa = FALSE;
		if (CUrl::segment(4) === 'print')
			$aaa = TRUE;
		$bbb = new CDetail;
		$bbb -> return = 'name';
		$bbb -> headers = array('code', 'name', 'city' => array('format' => 'model[Cities,getById($value)]'), 'tel', 'fax', 'boss', 'mob', 'date_start' => array('format' => 'model[Cal,getDate($value)]', 'label' => '<b>تاریخ شروع</b>'), 'zip', 'geo' => array('format' => 'model[Lookup,getById($value,geo)]'), 'address');
		$bbb -> numberOfColumns = 5;
		$r = new CView;
		$r -> body = $bbb -> run();
		$uu = new CGrid;
		$ww = 'اطلاعات شعبه ' . $bbb -> getReturnResult() . '(' . $zz . ')';
		if ($aaa) {$uu -> operations = FALSE;
			$uu -> noSort = TRUE;
			$r -> layout = 'print2';
			$r -> ptitle = '<h1>' . $ww . '</h1>';
			$xx = new User;
			$r -> producer = $xx -> producer();
		} else {$r -> pb = '<center><p>' . CUrl::createLink('نسخه چاپی', 'branch/view/' . $zz . '/print', 'class="box" target="_blank"') . '</p></center>';
		}$uu -> paginate = FALSE;
		$uu -> table = 'tbl_props';
		$uu -> headers = array('name' => array('label' => 'عنوان', 'format' => 'model[Branch::getPropName($value)]'), 'quantity' => array('label' => 'تعداد'));
		$uu -> operations = FALSE;
		$uu -> condition = array('branch_code' => $zz);
		$r -> props = $uu -> run();
		$r -> title = $ww;
		if (!$aaa)
			$r -> link = '<p><a href="' . PHP40::get() -> homeUrl . 'index.php/branch/manage" class="box">بازگشت</a></p>';
		$r -> degrees = Degree::degreeHistory($zz, FALSE, $aaa);
		$r -> run('branch/view');
	}

	public function edit() {$ccc = CUrl::segment(3);
		$e = new CForm;
		if (isset($_POST['submit'])) {$eee = new Branch;
			if (!($t = $eee -> getNameById($_POST['code']))) {$e -> setError('code', 'شعبه‌ای با این کد وجود ندارد.');
			}
			if ($e -> validate() == TRUE) {
				switch($ccc) {case  'info' :
						CUrl::redirect('branch/info/' . $_POST['code']);
						break;
					case  'props' :
						CUrl::redirect('branch/propsedit/' . $_POST['code']);
						break;
					case  'degree' :
						CUrl::redirect('branch/degrees/' . $_POST['code']);
						break;
					default :
						CUrl::redirect('branch/info/' . $_POST['code']);
				}
			}
		}$r = new CView;
		switch($ccc) {case  'info' :
				$r -> title = 'ویرایش مشخصات پایه شعبه';
				break;
			case  'props' :
				$r -> title = 'ویرایش امکانات شعبه';
				break;
			case  'degree' :
				$r -> title = 'ویرایش تاریخچه درجات شعبه';
				break;
			default :
				$r -> title = 'ویرایش اطلاعات شعبه';
		}$r -> form = $e -> run();
		$r -> run();
	}

	public function info() {$t = CUrl::segment(3);
		$p = new CDatabase;
		if (($cc = $p -> getByPk($t)) == FALSE) {$r -> error = 'شعبه‌ای با این کد وجود ندارد.';
			$r -> run();
		}$e = new CForm;
		$e -> showFieldErrorText = FALSE;
		if ($e -> validate()) {$g = new CJcalendar;
			$n = $g -> mktime(0, 0, 0, (int)$_POST['m_start'], (int)$_POST['d_start'], (int)$_POST['y_start']);
			$p = new CDatabase;
			$p -> additional = array('date_start' => $n);
			$p -> update(array('code' => $t));
			CUrl::redirect('branch/manage');
		}$r = new CView;
		$g = new CJcalendar(FALSE);
		$r -> model = $cc;
		$r -> m = $g -> date('m', $cc -> date_start);
		$r -> d = $g -> date('d', $cc -> date_start);
		$r -> y = $g -> date('Y', $cc -> date_start);
		$r -> form = $e -> run();
		$r -> title = 'ویرایش اطلاعات پایه شعبه';
		$r -> run();
	}

	public function delete() {
		$t = CUrl::segment(3);
		$p = new CDatabase;
		$p -> delete(array('code' => $t));
		$p -> setTbl('tbl_props');
		$p -> delete(array('branch_code' => $t));
		$p -> setTbl('tbl_degree');
		$p -> delete(array('branch_code' => $t));
		CUrl::redirect('branch/manage');
	}

}
