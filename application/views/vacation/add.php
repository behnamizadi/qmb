<?php
echo $form;
?>
<script>
    $(function(){
        $("#type").change(function(){
           var type_value = $("#type").val();
           if(type_value == 6) 
                $("#p_label").text(' ساعت');
           else
                $("#p_label").text(' روز');
        });
    });
</script>
