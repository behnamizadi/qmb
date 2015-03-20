
<?php
echo $grid;
echo $form;
?>
<a href="#" id="show_add" class="box">ثبت مقطع جدید</a>
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
  top: '50%', // Top position relative to parent
  left: '50%' // Left position relative to parent
};
var target = document.getElementById('add_tbl');
var spinner = new Spinner(opts);
    


        $('#show_add').click(function(){
            $('#add_tbl').fadeToggle();
        });
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

