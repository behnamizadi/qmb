<?php if(isset($ptitle)) echo $ptitle; ?>
<?php
$lookup = new Lookup;
$geos = $lookup -> getAll('geo');
?>
<table class="clist">
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
		<tr class="<?php echo $i%2 == 0 ? 'even' : 'odd'; ?>">
			<td><?php echo $geos[$geo]; ?></td>
			<td><?php echo $branch; $bCount += $branch; ?></td>
			<td>
				<?php
				if(isset($clerkCount[$geo])) 
				{
					$cCount += $clerkCount[$geo];
					echo $clerkCount[$geo];
				}
				else
					echo '۰'; 
				?>
			</td>
			<td>
				<?php 
				if(isset($bDegrees[$geo][7]))
				{
					echo $bDegrees[$geo][7];
					$bJam[7] += $bDegrees[$geo][7];
				}
				?>
			</td>
			<td>
				<?php 
				if(isset($bDegrees[$geo][6]))
				{
					echo $bDegrees[$geo][6];
					$bJam[6] += $bDegrees[$geo][6];
				}
				?>
			</td>
			<td>
				<?php 
				if(isset($bDegrees[$geo][1]))
				{
					echo $bDegrees[$geo][1];
					$bJam[1] += $bDegrees[$geo][1];
				}
				?>
			</td>
			<td>
				<?php 
				if(isset($bDegrees[$geo][2]))
				{
					echo $bDegrees[$geo][2];
					$bJam[2] += $bDegrees[$geo][2];
				}
				?>
			</td>
			<td>
				<?php 
				if(isset($bDegrees[$geo][3]))
				{
					echo $bDegrees[$geo][3];
					$bJam[3] += $bDegrees[$geo][3];
				}
				?>
			</td>
			<td>
				<?php 
				if(isset($bDegrees[$geo][4]))
				{
					echo $bDegrees[$geo][4];
					$bJam[4] += $bDegrees[$geo][4];
				}
				?>
			</td>
			<td>
				<?php 
				if(isset($bDegrees[$geo][5]))
				{
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
		<tr class="<?php echo $i%2 == 0 ? 'even' : 'odd'; $i++; ?>">
			<td>سرپرستی</td>
			<td>۰</td>
			<td><?php echo $sarCount; $cCount += $sarCount; ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><?php echo $sarDeg; ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr class="<?php echo $i%2 == 0 ? 'even' : 'odd';  ?>">
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
<table class="clist">
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
			<tr class="<?php echo $i%2 == 0 ? 'even' : 'odd'; ?>">
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
		<tr class="<?php echo $i%2 == 0 ? 'even' : 'odd'; ?>">
			<td>جمع</td>
			<td><?php echo $tCount; ?></td>
			<td><?php echo $sCount; ?></td>
			<td><?php echo $mCount; ?></td>
			<td><?php echo $woman; ?></td>
			<td><?php echo $man; ?></td>
		</tr>
</table>
<?php 
$postCount = count($posts);
$tblNumber = 3;
$tblWidth = floor(100/$tblNumber) - 1;
$marginLeft = (100 - ($tblWidth * $tblNumber)) / ($tblNumber - 1);
$maxTR = ceil($postCount/$tblNumber);
$index = 1;
for($i = 0; $i < $tblNumber; $i++):
?>
	<table class="clist" style="width:<?php echo $tblWidth; ?>%;<?php if(($tblNumber-$i) == 1) echo 'float:left;'; else{ echo 'float:right;'; echo 'margin-left:'; echo $marginLeft; echo '%;'; } ?>margin-top:20px;">
		<tr>
			<th style="width: 10%;">ردیف</th>
			<th style="width: 75%;">پست</th>
			<th style="width: 15%;">تعداد</th>
		</tr>
		<?php 
		//for($j = 0; $j < $maxTR; $j++):
			//$index = $i * $maxTR + $j + 1;
		?>
			<!-- <tr class="<?php echo $j%2 == 0 ? 'even' : 'odd'; ?>">
				<td><?php $tmp = $index + 1; echo $tmp; ?></td>
				<td><?php if(isset($posts[$index])) echo $posts[$index]['name']; else echo '&nbsp;'; ?> </td>
				<td><?php if(isset($posts[$index])) echo $posts[$index]['COUNT(tbl_carrier.id)']; else echo '&nbsp;'; ?></td>
			</tr> -->
			<?php 
			for($x = 1; $x <= $postCount; $x++)
			{
				$tmp = 1;
				if(isset($posts[28]) && $posts[28]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[28]['name'].'</td><td>'.$posts[28]['count'].'</tr>';
					$posts[28]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[30]) && $posts[30]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[30]['name'].'</td><td>'.$posts[30]['count'].'</tr>';
					$posts[30]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[21]) && $posts[21]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[21]['name'].'</td><td>'.$posts[21]['count'].'</tr>';
					$posts[21]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[12]) && $posts[12]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[12]['name'].'</td><td>'.$posts[12]['count'].'</tr>';
					$posts[12]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[13]) && $posts[13]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[13]['name'].'</td><td>'.$posts[13]['count'].'</tr>';
					$posts[13]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[14]) && $posts[14]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[14]['name'].'</td><td>'.$posts[14]['count'].'</tr>';
					$posts[14]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[20]) && $posts[20]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[20]['name'].'</td><td>'.$posts[20]['count'].'</tr>';
					$posts[20]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[29]) && $posts[29]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[29]['name'].'</td><td>'.$posts[29]['count'].'</tr>';
					$posts[29]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[15]) && $posts[15]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[15]['name'].'</td><td>'.$posts[15]['count'].'</tr>';
					$posts[15]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[2]) && $posts[2]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[2]['name'].'</td><td>'.$posts[2]['count'].'</tr>';
					$posts[2]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[27]) && $posts[27]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[27]['name'].'</td><td>'.$posts[27]['count'].'</tr>';
					$posts[27]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[22]) && $posts[22]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[22]['name'].'</td><td>'.$posts[22]['count'].'</tr>';
					$posts[22]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[18]) && $posts[18]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[18]['name'].'</td><td>'.$posts[18]['count'].'</tr>';
					$posts[18]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[19]) && $posts[19]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[19]['name'].'</td><td>'.$posts[19]['count'].'</tr>';
					$posts[19]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[25]) && $posts[25]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[25]['name'].'</td><td>'.$posts[25]['count'].'</tr>';
					$posts[25]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[3]) && $posts[3]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[3]['name'].'</td><td>'.$posts[3]['count'].'</tr>';
					$posts[3]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[23]) && $posts[23]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[23]['name'].'</td><td>'.$posts[23]['count'].'</tr>';
					$posts[23]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[26]) && $posts[26]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[26]['name'].'</td><td>'.$posts[26]['count'].'</tr>';
					$posts[26]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[16]) && $posts[16]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[16]['name'].'</td><td>'.$posts[16]['count'].'</tr>';
					$posts[16]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[24]) && $posts[24]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[24]['name'].'</td><td>'.$posts[24]['count'].'</tr>';
					$posts[24]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[31]) && $posts[31]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[31]['name'].'</td><td>'.$posts[31]['count'].'</tr>';
					$posts[31]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[1]) && $posts[1]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[1]['name'].'</td><td>'.$posts[1]['count'].'</tr>';
					$posts[1]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
				if(isset($posts[17]) && $posts[17]['set'] == 0)
				{
					$class = $tmp%2 == 0 ? 'even' : 'odd'; 
					echo '<tr class="'.$class.'"><td>'.$index.'</td><td>'.$posts[17]['name'].'</td><td>'.$posts[17]['count'].'</tr>';
					$posts[17]['set'] = 1;
					$index++;
					$tmp++;
					if($tmp > $maxTR)
						break;
				}
			}
			?>
		<?php
		//endfor;
		?>
	</table>
<?php endfor; ?>
<?php if(isset($pb)) echo $pb; ?>
<?php if(isset($producer)) echo $producer; ?>
