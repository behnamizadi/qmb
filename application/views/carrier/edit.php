<?php
echo $form;
?>
<script>
    $(function(){
    $('.fadein').change(function(){ 
            $('#branch_display').fadeIn();
        });
    $('.fadeout').change(function(){ 
            $('#branch_display').fadeOut();
        });
    });
</script>