<?php echo $form; ?>
<?php $scripts="
<script>
    $(document).ready(function(){
        $('#study_degree').change(function(){
            var study_degree = $('#study_degree').val();
            $.ajax({
                url: '".PHP40::get()->homeUrl."index.php/study_field/getByDegreeAjax/',
                type: 'POST',
                data:'study_degree='+study_degree,
                success:function(result){
                    $('#study_field option').remove();
                    $('#study_field').append(result);
                }
            });
        });
        
    });
</script>"
?>