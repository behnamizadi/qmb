<?php
echo $grid;
echo $form;
?>
<a href="#" id="show_add" class="box">ثبت مقطع جدید</a>
<script>
    $(function(){
        $('#show_add').click(function(){
            $('#add_tbl').fadeToggle();
        });
        var study_degree = $('#study_degree').val();
        if(study_degree)
        {
           $.ajax({
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