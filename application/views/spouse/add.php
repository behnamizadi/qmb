<?php
echo $f->run();
//$v = new CValidator;
/*if($v->getAllErrors() !== FALSE)
{
    
    echo '<div class="red"><ul>';
    for($i = 1; $i <= $number_of_children;$i++):
        if(($message = $v->getError('ch_name'.$i)) !== TRUE)
        {
            echo '<li>'.$message.'</li>';
        }
        if(($message = $v->getError('ch_code'.$i)) !== TRUE)
        {
            echo '<li>'.$message.'</li>';
        }
        if(($message = $v->getError('y_born'.$i)) !== TRUE)
        {
            echo '<li>'.$message.'</li>';
        }
    endfor;
    echo '</ul></div>';
}*/
if($number_of_children):
echo '<h3>اطلاعات فرزندان</h3>';
echo '<table class="create">';
for($i = 1; $i <= $number_of_children;$i++):
   ?>
   <tr>
  <td><?php echo $f->makeField('ch_name'.$i, array('type'=>'text','in'=>'class="txt" maxlength="80"','label'=>'نام <span class="error">*</span>')); ?></td>
  <td><?php echo $f->makeField('ch_code'.$i, array('type'=>'text','in'=>'class="txt" maxlength="10"','label'=>'کد ملی <span class="error">*</span>')); ?></td>
  <td> تاریخ تولد<span class="error">*</span>&nbsp;<?php echo $f->select('d_born'.$i, array(
            'decoration'=>FALSE,
            'options'=>'days_of_month',
            'showFieldError'=>FALSE
       )); 
       echo $f->select('m_born'.$i, array(
            'decoration'=>FALSE,
            'options'=>'months_of_year',
            'showFieldError'=>FALSE
       ));
       echo $f->select('y_born'.$i, array(
            'decoration'=>FALSE,
            'options'=>'years_1340_1392',
            'showFieldError'=>FALSE
       ));
       ?>
   </td>
   <td>
       <?php echo $f->makeField('city_born'.$i, array('type'=>'text','in'=>'class="txt" maxlength="30"','label'=>'محل تولد <span class="error">*</span>')); ?>
   </td>
   </tr>    
<?php
endfor;
endif;
?>
</table>
<p><label>&nbsp;</label>
<input type="submit" name="submit" value="مرحله بعد" class="box" />
</p>
</form>
<script>
    $(function(){
        var study_degree = $('#study_degree').val();
        if(study_degree)
        {
           $.ajax({
               cache: false,
                url: '<?php echo PHP40::get()->homeUrl; ?>index.php/study_field/getByDegreeAjax/',
                type: 'POST',
                data:'study_degree='+study_degree,
                success:function(result){
                    $('#study_field option').remove();
                    $('#study_field').append(result);
                }
            });
        }
        $('#study_degree').change(function(){
            var study_degree = $('#study_degree').val();
            $.ajax({
                cache: false,
                url: '<?php echo PHP40::get()->homeUrl; ?>index.php/study_field/getByDegreeAjax/',
                type: 'POST',
                data:'study_degree='+study_degree,
                success:function(result){  
                    $('#study_field option').remove();
                    $('#study_field').append(result);
                }
            });
        });
        
    });
</script>