<?php
if (isset($ptitle))
    echo $ptitle;
 ?>
<?php
$lookup = new Lookup;
$geos = $lookup -> getAll('geo');
?>
<table class="table table-striped table-bordered">
	<tr>
		<th>&nbsp;</th>
		<th>تعداد شعبه</th>
		<th>تعداد پرسنل</th>
		<th>درجه مستقل</th>
		<th>درجه ممتاز</th>
		<th>درجه ۱</th>
		<th>درجه ۲</th>
		<th>درجه ۳</th>
		<th>درجه ۴</th>
		<th>درجه ۵</th>
	</tr>
	
		<?php
		$bDegrees = array();
		$bJam = array(1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0);
		foreach($degreeCount as $dc)
		{
			$bDegrees[$dc['geo']][$dc['degree']] = $dc['COUNT(*)'];
		}
		//echo '<pre>'; print($bDegrees[6][2]); exit();
		$i = 0;
		$bCount = $cCount = 0;
		foreach ($branchCount as $geo => $branch):
		?>
		<tr>
			<td><?php echo $geos[$geo]; ?></td>
			<td><?php echo $branch;
                $bCount += $branch;
 ?></td>
			<td>
				<?php
                if (isset($clerkCount[$geo])) {
                    $cCount += $clerkCount[$geo];
                    echo $clerkCount[$geo];
                } else
                    echo '۰';
				?>
			</td>
			<td>
				<?php
                if (isset($bDegrees[$geo][7])) {
                    echo $bDegrees[$geo][7];
                    $bJam[7] += $bDegrees[$geo][7];
                }
				?>
			</td>
			<td>
				<?php
                if (isset($bDegrees[$geo][6])) {
                    echo $bDegrees[$geo][6];
                    $bJam[6] += $bDegrees[$geo][6];
                }
				?>
			</td>
			<td>
				<?php
                if (isset($bDegrees[$geo][1])) {
                    echo $bDegrees[$geo][1];
                    $bJam[1] += $bDegrees[$geo][1];
                }
				?>
			</td>
			<td>
				<?php
                if (isset($bDegrees[$geo][2])) {
                    echo $bDegrees[$geo][2];
                    $bJam[2] += $bDegrees[$geo][2];
                }
				?>
			</td>
			<td>
				<?php
                if (isset($bDegrees[$geo][3])) {
                    echo $bDegrees[$geo][3];
                    $bJam[3] += $bDegrees[$geo][3];
                }
				?>
			</td>
			<td>
				<?php
                if (isset($bDegrees[$geo][4])) {
                    echo $bDegrees[$geo][4];
                    $bJam[4] += $bDegrees[$geo][4];
                }
				?>
			</td>
			<td>
				<?php
                if (isset($bDegrees[$geo][5])) {
                    echo $bDegrees[$geo][5];
                    $bJam[5] += $bDegrees[$geo][5];
                }
				?>
			</td>
		</tr>
		<?php
        $i++;
        endforeach;
		?>
		<tr class="<?php echo $i % 2 == 0 ? 'even' : 'odd';
            $i++;
 ?>">
			<td>سرپرستی</td>
			<td>۰</td>
			<td><?php echo $sarCount;
                $cCount += $sarCount;
 ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><?php echo $sarDeg; ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>جمع</td>
			<td><?php echo $bCount; ?></td>
			<td><?php echo $cCount; ?></td>
			<td><?php echo $bJam[7]; ?></td>
			<td><?php echo $bJam[6]; ?></td>
			<td><?php echo $bJam[1]; ?></td>
			<td><?php echo $bJam[2]; ?></td>
			<td><?php echo $bJam[3]; ?></td>
			<td><?php echo $bJam[4]; ?></td>
			<td><?php echo $bJam[5]; ?></td>
		</tr>
</table>
<br />
<?php
$lookup = new Lookup;
$eStatuses = $lookup -> getAll('employment_status');
?>
<table class="table table-striped table-bordered">
    <tbody>
	<tr>
		<th>&nbsp;</th>
		<th>تعداد</th>
		<th>مجرد</th>
		<th>متاهل</th>
		<th>زن</th>
		<th>مرد</th>
	</tr>
	<?php
		$tCount = $mCount = $sCount = $man = $woman = 0;
		$cMarried = array();
		foreach($married as $m)
		{
			$cMarried[$m['employment_status']][$m['married']] = $m['COUNT(tbl_profile.clerk_id)'];
			if($m['married'] == 1)
				$sCount += $m['COUNT(tbl_profile.clerk_id)'];
			if($m['married'] == 2)
				$mCount += $m['COUNT(tbl_profile.clerk_id)'];
		}
		$cEmp = array();
		foreach($eses as $es)
		{
			$cEmp[$es['employment_status']] = $es['COUNT(*)'];
			$tCount += $es['COUNT(*)'];
		}
		$sex = array();
		foreach($sexes as $s)
		{
			$sex[$s['employment_status']][$s['sex']] = $s['COUNT(tbl_profile.clerk_id)'];
			if($s['sex'] == 1)
				$man += $s['COUNT(tbl_profile.clerk_id)'];
			if($s['sex'] == 2)
				$woman += $s['COUNT(tbl_profile.clerk_id)'];
		}
		$i = 0;
		foreach($eStatuses as $code => $eStatus):
		?>
			<tr >
				<td><?php echo $eStatus; ?></td>
				<td><?php echo isset($cEmp[$code]) ? $cEmp[$code] : '۰'; ?></td>
				<td><?php echo isset($cMarried[$code][1]) ? $cMarried[$code][1] : '۰'; ?></td>
				<td><?php echo isset($cMarried[$code][2]) ? $cMarried[$code][2] : '۰'; ?></td>
				<td><?php echo isset($sex[$code][2]) ? $sex[$code][2] : '۰'; ?></td>
				<td><?php echo isset($sex[$code][1]) ? $sex[$code][1] : '۰'; ?></td>
			</tr>
		<?php
        $i++;
        endforeach;
		?>
		<tr>
			<td>جمع</td>
			<td><?php echo $tCount; ?></td>
			<td><?php echo $sCount; ?></td>
			<td><?php echo $mCount; ?></td>
			<td><?php echo $woman; ?></td>
			<td><?php echo $man; ?></td>
		</tr>
		</tbody>
</table>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ردیف</th>
			<th>پست</th>
			<th style="width: 15%;">تعداد</th>
		</tr>
			<?php
            $index = 1;
            foreach ($posts as $post) {
                $tmp = 1;
                if (isset($post) && $post['set'] == 0) {
                    echo '<tr><td>' . $index . '</td><td>' . $post['name'] . '</td><td>' . $post['count'] . '</tr>';
                    $posts[28]['set'] = 1;
                    $index += 1;
                }

            }
			?>
	</table>
<?php
        if (isset($pb))
            echo $pb;
 ?>
<?php
    if (isset($producer))
        echo $producer;
 ?>
