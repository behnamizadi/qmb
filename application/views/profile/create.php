<?php
echo $form;
?>
<?php $scripts="
<script>
$(document).ready(function(){
x='create';
     $('input[type=radio][name=married]').change(function() {
      if (this.value == 1) {
            $('#takafol').val(0);
            $('#takafol').attr('disabled','disabled');
        }
        else if (this.value == 2) {
           $('#takafol').fadeIn();
           $('#takafol').removeAttr('disabled');
        }
        
    });
});
</script>";
