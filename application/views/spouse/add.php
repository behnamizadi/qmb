<?php
echo $f->run();
if($number_of_children):
echo '<h3>اطلاعات فرزندان</h3>';
for($i = 1; $i <= $number_of_children;$i++):
   ?>
   
 <?php echo $f->makeField('ch_name'.$i, array('type'=>'text','label'=>'نام <span class="error">*</span>')); ?>
 <?php echo $f->makeField('ch_code'.$i, array('type'=>'text','label'=>'کد ملی <span class="error">*</span>')); ?>
 <lable>تاریخ تولد<span class="error">*</span></lable><?php echo $f->select('d_born'.$i, array(
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
            'options'=>Utility::years(30,0),
            'showFieldError'=>FALSE
       ));
       ?>

       <?php echo $f->makeField('city_born'.$i, array('type'=>'text','label'=>'محل تولد <span class="error">*</span>')); ?> 
<?php
endfor;
endif;
?>
</table>
<label>&nbsp;</label>
<input type="submit" name="submit" value="مرحله بعد" class="btn btn-success" />
</form>
<?php $scripts="
<script type='text/javascript'>
    $(document).ready(function(){
        var opts = {
  lines: 13, // The number of lines to draw
  length: 20, // The length of each line
  width: 10, // The line thickness
  radius: 20, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#000', // #rgb or #rrggbb or array of colors
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 999, // The z-index (defaults to 2000000000)
  top: '300px', // Top position relative to parent
  left: '50%' // Left position relative to parent
};
var target = document.getElementById('navbar');
var spinner = new Spinner(opts);
      $('#study_degree').change(function(){
        spinner.spin(target);
        var study_degree = $('#study_degree').val();
        $.ajax({
            url: '".PHP40::get()->homeUrl."index.php/study_field/getByDegreeAjax/',
            type: 'POST',
            data:'study_degree='+study_degree,
            success:function(result){
                spinner.stop();
                $('#study_field option').remove();
                $('#study_field').append(result);
            }
        });
        });
    });
          
</script>";  ?>