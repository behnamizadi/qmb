<?php
echo $grid;
echo $form;
?>
<a href="#" id="show_add" class="box">ثبت فرزند جدید</a>
<script>
    $(function(){
        $('#show_add').click(function(){
            $('#add_tbl').fadeToggle();
        });
    });
</script>