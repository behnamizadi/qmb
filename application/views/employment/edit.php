<img src="<?php echo PHP40::get()->homeUrl; ?>pics/<?php echo $fileName; ?>" width="100" alt="عکس پرسنلی" align="left" />
<?php
echo $form->run();
?>
</td>
<td id="file" style="display:none">
    <label>آپلود عکس جدید</label>
    <?php 
    echo $form->makeField('picture', array(
            'type'=>'file',
            'decoration'=>FALSE,
            'in'=>'size="4"',
            'showFieldErrorText'=>TRUE,
            'decoration'=>FALSE
        ));
    ?>
</td>
</tr></table>
<input type="submit" name="submit" class="box" value="ویرایش" />
 <a href="#" class="box" id="change">تغییر عکس پرسنلی</a>
<script> 
$(function(){
    $("#change").click(function(){
            $("#file").fadeIn();
    }); 
});
</script>
       
