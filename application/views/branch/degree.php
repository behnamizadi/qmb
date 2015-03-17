<?php
$lookup = new Lookup;
$degree = $lookup->getAll('degree');
$degree['default'] = 'انتخاب';
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table class="create" id="page">
<?php if(isset($_POST['submit'])):
$counter = count($_POST['degree']);
for($i = 0;$i < $counter;$i++): 
    ?>
    <tr>
        <td>
            <?php
            echo $f->select('degree['.$i.']',array(
                    'type'=>'select',
                    'options'=>$degree,
                    'label'=>'درجه<span class="error">*</span>'
                )); 
                ?>
        </td>
        <td>
            <label>سال<span class="error">*</span></label>
           <?php
           echo $f->select('degree_start['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'years_1386_1392'
                )); 
           ?>  
        </td>
    </tr>
<?php endfor;  
else: ?>
    <tr>
        <td>
            <?php
            echo $f->select('degree[]',array(
                    'type'=>'select',
                    'options'=>$degree,
                    'label'=>'درجه<span class="error">*</span>'
                )); 
                ?>
        </td>
        <td>
            <label>سال<span class="error">*</span></label>
           <?php
           echo $f->select('degree_start[]',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'years_1386_1392'
                )); 
           ?>  
        </td>
    </tr>
<?php endif; ?>
</table>
<img src="<?php echo PHP40::get()->homeUrl; ?>public/images/plus.png" style="cursor:pointer" alt="افزودن درجه"  class="add_degree" />
<p><label>&nbsp;</label><input type="submit" name="submit" value="ثبت" class="btn btn-primary" /></p>
</form>
<script>
$(function(){
    $('.add_degree').click(function(){
        $('#page').append('<tr><td><?php echo $f->select('degree[]',array('type'=>'select','options'=>$degree,'label'=>'درجه<span class="error">*</span>')); ?></td>'+
        '<td><label>سال<span class="error">*</span></label><?php echo $f->select('degree_start[]',array('decoration'=>FALSE,'type'=>'select','options'=>'years_1386_1392')); ?></td>'+
        '</td></tr>');
    });
});
</script>
