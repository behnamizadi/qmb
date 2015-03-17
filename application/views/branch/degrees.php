<?php
echo $body;
echo $form;
?>
<a href="#" id="show_add" class="btn btn-primary">ثبت درجه</a>
<script>
    $(function(){
        $('#show_add').click(function(){
            $('#add_tbl').fadeToggle();
        });
    });
</script>