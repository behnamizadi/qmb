<?php
class searchController {
	public function clerk_number() {$a = new CDatabase;
		$b = "SELECT clerk_number FROM tbl_clerk INNER JOIN tbl_profile WHERE tbl_clerk.id=tbl_profile.clerk_id";
		if (!empty($_POST['name'])) {$c = $a -> escape($_POST['name']);
			$b .= " AND name LIKE '%$c%'";
		}
		if (!empty($_POST['lastname'])) {$d = $a -> escape($_POST['lastname']);
			$b .= " AND lastname LIKE '%$d%'";
		}$e = $a -> queryAll($b);
		if (!$e)
			echo "NO";
		elseif (count($e) > 1)
			echo "MORE";
		else {$e = $e[0];
			echo $e -> clerk_number;
		}
	}

	public function index() {$f = new CForm;
		$g = new CView;
		$g -> form = $f -> run();
		$g -> title = 'جستجو';
		$g -> layout = 'jquery';
		$g -> run('search/index');
	}

}
