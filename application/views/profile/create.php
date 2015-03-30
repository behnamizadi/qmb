<?php
echo $form;
?>
<?php $scripts="
<script>
$(function(){
    $('#mojarad').change(function(){
        $('#takafol').fadeIn();
    });
    $('#motahel').change(function(){
        $('#takafol').fadeOut();
    });
});
</script>";
?>