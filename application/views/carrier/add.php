<?php
$lookup = new Lookup;
$post = $lookup -> getAll('post');
$post2 = $lookup -> getAll('degree');
$employment_status = $lookup -> getAll('employment_status');
$job_status = $lookup -> getAll('job_status');
$hokm_type = $lookup -> getAll('hokm_type');
$b = new Branch;
$branches = $b -> getByOstan();
$branches['default'] = $employment_status['default'] = $job_status['default'] = $hokm_type['default'] = $post['default'] = $post2['default'] = 'انتخاب';
?>
<form method="post" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="c_path" value="<?php echo isset($_POST['c_path']) ? $_POST['c_path'] : 2; ?>"  id="c_path" />
<h4>وضعیت فعلی</h4>

            <?php
            echo $f -> select('employment_status1', array('options' => $employment_status, 'label' => 'وضعیت استخدام<span class="error">*</span>'));
            ?>

            <?php
            echo $f -> select('job_status1', array('options' => $job_status, 'label' => 'وضعیت اشتغال<span class="error">*</span>'));
            ?>


            <?php
            echo $f -> select('hokm_type1', array('options' => $hokm_type, 'label' => 'نوع حکم<span class="error">*</span>'));
            ?>
        <div class="form-group">
           <label class="col-xs-3 col-md-3 col-sm-3 ">تاریخ شروع<span class="error">*</span></label>
           <?php
        echo $f -> select('d_start1', array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month'));
        echo $f -> select('m_start1', array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year'));
        echo $f -> select('y_start1', array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears'));
           ?>     </div>


 
            <?php
            echo $f -> select('post1', array('options' => $post, 'label' => 'پست سازمانی<span class="error">*</span>'));
            ?>
   
            <?php
            echo $f -> select('degree1', array('options' => $post2, 'label' => 'درجه'));
            ?>
 
            <?php
            echo $f -> makeField('emtiaz_shoghl1', array('type' => 'text', 'label' => 'امتیاز شغل', ));
            ?>

            <?php
            echo $f -> radio('place1', array('value' => array(1 => 'سرپرستی', 2 => 'شعبه'), 
            'label' => 'محل خدمت<span class="error">*</span>', 
            'in'=>array(1=>'id="fadeout1"',2=>'id="fadein1"'),
            'showFieldErrorText' => TRUE));
            ?>

            <?php
            $bDisp = '<div style="margin:0;padding:0"  class="branch_display1 display_none">';
            if (isset($_POST['place1']) && $_POST['place1'] == 2)
                $bDisp = '<div class="branch_display1">';

            echo $bDisp;
            echo $f -> select('branches1', array('options' => $branches, 'label' => 'شعبه<span class="error">*</span>'));
            echo "</div>";
            ?>

<h4>تاریخچه مسیر شغلی</h4>
<?php
for($i = 2; $i <= 10;$i++):
    $flag = TRUE;
    $set = FALSE;
    if(!empty($_POST['employment_status'.$i]) || !empty($_POST['job_status'.$i]) || !empty($_POST['hokm_type'.$i]) || !empty($_POST['post'.$i]) || !empty($_POST['emtiaz_shoghl'.$i]) || !empty($_POST['d_start'.$i]) || !empty($_POST['m_start'.$i]) || !empty($_POST['y_start'.$i]) || !empty($_POST['d_end'.$i]) || !empty($_POST['m_end'.$i]) || !empty($_POST['y_end'.$i]))
    {
        $flag = FALSE;
    }
    if(!empty($_POST['employment_status'.$i]) && !empty($_POST['job_status'.$i]) && !empty($_POST['hokm_type'.$i]) && !empty($_POST['post'.$i]) && !empty($_POST['emtiaz_shoghl'.$i]) &&  !empty($_POST['d_start'.$i]) && !empty($_POST['m_start'.$i]) && !empty($_POST['y_start'.$i]) && !empty($_POST['d_end'.$i]) && !empty($_POST['m_end'.$i]) && !empty($_POST['y_end'.$i]))
    {
        $flag = TRUE;
        $set = TRUE;
    } 
    if($flag === TRUE && $set === FALSE)
        echo '<div style="margin-bottom: 5px;display: none;" id="cpathadd'.$i.'">';
    elseif($flag === FALSE || ($flag === TRUE && $set === TRUE))
        echo '<div style="margin-bottom: 5px;" id="cpathadd'.$i.'">';
    

?>
 

            <?php
            echo $f -> select('employment_status' . $i, array('options' => $employment_status, 'label' => 'وضعیت استخدام<span class="error">*</span>'));
            ?>


            <?php
            echo $f -> select('job_status' . $i, array('options' => $job_status, 'label' => 'وضعیت اشتغال<span class="error">*</span>'));
            ?>
 

            <?php
            echo $f -> select('hokm_type' . $i, array('options' => $hokm_type, 'label' => 'نوع حکم<span class="error">*</span>'));
            ?>
 

           <label>تاریخ شروع<span class="error">*</span></label>
           <?php
        echo $f -> select('d_start' . $i, array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month'));
        echo $f -> select('m_start' . $i, array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year'));
        echo $f -> select('y_start' . $i, array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears'));
           ?>     


           <label>تاریخ پایان<span class="error">*</span></label>
           <?php
        echo $f -> select('d_end' . $i, array('decoration' => FALSE, 'type' => 'select', 'options' => 'days_of_month'));
        echo $f -> select('m_end' . $i, array('decoration' => FALSE, 'type' => 'select', 'options' => 'months_of_year'));
        echo $f -> select('y_end' . $i, array('decoration' => FALSE, 'type' => 'select', 'options' => 'lastTenYears'));
           ?>
  

            <?php
            echo $f -> select('post' . $i, array('options' => $post, 'label' => 'پست سازمانی<span class="error">*</span>'));
            ?>


            <?php
            echo $f -> select('degree' . $i, array('options' => $post2, 'label' => 'درجه'));
            ?>
    
            <?php
            echo $f -> makeField('emtiaz_shoghl' . $i, array('type' => 'text', 'label' => 'امتیاز شغل<span class="error">*</span>', 'in' => 'class="txt" maxlength="30"'));
            ?>
    
            <?php
            echo $f -> radio('place' . $i, array('value' => array(1 => 'سرپرستی', 2 => 'شعبه'), 
            'label' => 'محل خدمت<span class="error">*</span>', 
            'in' => array(1 => 'id="fadeout' . $i . '"', 2 => 'id="fadein' . $i . '"'), 'showFieldErrorText' => TRUE));
            ?>
    
     

            <?php
            $bDisp = '<div style="margin:0;padding:0" class="branch_display' . $i . ' display_none">';
            if (isset($_POST['place' . $i]) && $_POST['place' . $i] == 2)
                $bDisp = '<div style="margin:0;padding:0" class="branch_display' . $i . '">';
            
            echo $bDisp;
            echo $f -> select('branches' . $i, array('options' => $branches, 'label' => 'شعبه<span class="error">*</span>'));
            echo '</div>';
            ?>
</div>
<?php

endfor;
?>
<img src="<?php echo PHP40::get() -> homeUrl; ?>public/images/plus.png" style="cursor:pointer" alt="افزودن مسیر شغلی"  id="add_c_path" />
<input type="submit" name="submit" value="ثبت" class="btn btn-success" />

<?php $scripts = "
<script>
$('#fadein1').change(function(){
    $('.branch_display1').fadeIn();
});
$('#fadein2').change(function(){
$('.branch_display2').fadeIn();
});
$('#fadein3').change(function(){
$('.branch_display3').fadeIn();
});
$('#fadein4').change(function(){
$('.branch_display4').fadeIn();
});
$('#fadein5').change(function(){
$('.branch_display5').fadeIn();
});
$('#fadein6').change(function(){
$('.branch_display6').fadeIn();
});
$('#fadein7').change(function(){
$('.branch_display7').fadeIn();
});
$('#fadein8').change(function(){
$('.branch_display8').fadeIn();
});
$('#fadein9').change(function(){
$('.branch_display9').fadeIn();
});
$('#fadein10').change(function(){
$('.branch_display10').fadeIn();
});
$('#fadeout1').change(function(){
    $('.branch_display1').fadeOut();
});
$('#fadeout2').change(function(){
$('.branch_display2').fadeOut();
});
$('#fadeout3').change(function(){
$('.branch_display3').fadeIn();
});
$('#fadeout4').change(function(){
$('.branch_display4').fadeOut();
});
$('#fadeout5').change(function(){
$('.branch_display5').fadeOut();
});
$('#fadeout6').change(function(){
$('.branch_display6').fadeOut();
});
$('#fadeout7').change(function(){
$('.branch_display7').fadeOut();
});
$('#fadeout8').change(function(){
$('.branch_display8').fadeOut();
});
$('#fadeout9').change(function(){
$('.branch_display9').fadeOut();
});
$('#fadeout10').change(function(){
$('.branch_display10').fadeOut();
});
$('#add_c_path').click(function(){
    var degreeNumber = document.getElementById('c_path');
    var num = degreeNumber.value;
    num = parseInt(num);
    p_id = '#cpathadd'+num;
    $(p_id).fadeIn();
    if(num <= 10)
    document.getElementById('c_path').value = num + 1;
});
</script>";
?>