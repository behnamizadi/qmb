<?php
echo $form;
?>
<script> 
$(function(){
    $('.add_study').click(function(){
        var studyNumber = document.getElementById("study_number");
        var num = studyNumber.value;
        num = parseInt(num);
        p_id = '#s'+num;
        $(p_id).fadeIn();
        if(num < 7)
            document.getElementById("study_number").value = num + 1;
    }); 
});
</script>