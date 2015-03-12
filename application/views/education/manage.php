<?php
echo $grid;
echo $form;
?>
<a href="#" id="show_add" class="box">ثبت مقطع جدید</a>
<?php $scripts="
<script>
    $(document).ready(function(){
        $('#show_add').click(function(){
            $('#add_tbl').fadeToggle();
        });
    });
</script>";  ?>

