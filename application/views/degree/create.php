<script> 
$(function(){
    $('.adddegree').click(function(){
        var degreeNumber = document.getElementById("degree_num");
        var num = degreeNumber.value;
        num = parseInt(num);
        p_id = '#degree'+num;
        $(p_id).fadeIn();
        if(num < 20)
            document.getElementById("degree_num").value = num + 1;
    }); 
});
</script>
<?php 
$f = new CForm;
$f->dontClose = FALSE;
$f->showFieldErrorText = FALSE;
echo $f->run();
?>
<input type="hidden" name="degree_num" value="<? echo isset($_POST['degree_num']) ? $_POST['degree_num'] : 2; ?>"  id="degree_num" />
<?php
for($i = 2; $i <= 20;$i++):
    $flag = TRUE;
    $set = FALSE;
    if(!empty($_POST['degree'.$i]) || !empty($_POST['d_start'.$i]) || !empty($_POST['m_start'.$i]) || !empty($_POST['y_start'.$i]) || !empty($_POST['d_end'.$i]) || !empty($_POST['m_end'.$i]) || !empty($_POST['y_end'.$i]))
    {
        $flag = FALSE;
    }
    if(!empty($_POST['degree'.$i]) && !empty($_POST['d_start'.$i]) && !empty($_POST['m_start'.$i]) && !empty($_POST['y_start'.$i]) && !empty($_POST['d_end'.$i]) && !empty($_POST['m_end'.$i]) && !empty($_POST['y_end'.$i]))
    {
        $flag = TRUE;
        $set = TRUE;
    } 
    if($flag === TRUE && $set === FALSE)
        echo '<tr id="degree'.$i.'" class="hidden_tr">';
    elseif($flag === FALSE || ($flag === TRUE && $set === TRUE))
        echo '<tr id="degree'.$i.'">';
    ?>
        <td>
           <?php 
           echo $f->select('degree'.$i,array(
                    'type'=>'select',
                    'options'=>'numbers_1_6',
                    'label'=>'درجه'
                )); 
           ?>  
           </td><td><label>تاریخ شروع</label>   
           <?php
           echo $f->select('d_start'.$i,array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>
                    'days_of_month'
                )); 
           echo $f->select('m_start'.$i,array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'months_of_year'
                )); 
           echo $f->select('y_start'.$i,array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>Utility::years(10,-1)
                )); 
           ?>
           </td><td><label>تاریخ پایان</label>
           <?php
           echo $f->select('d_end'.$i,array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>
                    'days_of_month'
                )); 
           echo $f->select('m_end'.$i,array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'months_of_year'
                )); 
           echo $f->select('y_end'.$i,array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>Utility::years(10,-1)
                )); 
           ?>
        </td>
    </tr>
<?php
endfor;
?>
</table>
<img src="<?php echo PHP40::get()->homeUrl; ?>public/images/plus.png" alt="افزودن درجه"  class="adddegree" />
<p><label>&nbsp;</label><input type="submit" name="submit" value="ثبت" /></p>
</form>