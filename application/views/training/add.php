<?php
$lookup = new Lookup;
$t_cat = $lookup->getAll('t_cat');
$trainings = $lookup->getAll('training'); 
$t_cat['default'] = $trainings['default'] = 'انتخاب';
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div id="page">
<?php if(isset($_POST['submit'])): 

$counter = count($_POST['title']);
for($i = 0;$i < $counter;$i++): 
?>
<table class="create">
    <tr>
        <td>
            <?php
            echo $f->select('title['.$i.']', array('type'=>'select',
                'options'=>$trainings,
                'label'=>'عنوان دوره<span class="error">*</span>',
                'in'=>'class="select"',
                ));
            ?>
        </td>
        <td>
            <?php
            echo $f->makeField('code['.$i.']', array('type'=>'select',
                    'options'=>$trainings,
                'label'=>'کد دوره<span class="error">*</span>'
                ));
            ?>
        </td>
        <td>
           <label>تاریخ شروع<span class="error">*</span></label>
           <?php
           echo $f->select('d_start['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>
                    'days_of_month'
                )); 
           echo $f->select('m_start['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'months_of_year'
                )); 
           echo $f->select('y_start['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'years_1370_1392'
                )); 
           ?>     
        </td>
        <td>
           <label>تاریخ پایان<span class="error">*</span></label>
           <?php
           echo $f->select('d_end['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>
                    'days_of_month'
                )); 
           echo $f->select('m_end['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'months_of_year'
                )); 
           echo $f->select('y_end['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'years_1370_1392'
                )); 
           ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo $f->makeField('period['.$i.']', array('type'=>'text',
                'in'=>'class="txt" maxlength="10"',
                'label'=>'مدت دوره<span class="error">*</span>',
                'out'=>' ساعت'
                ));
            ?>
        </td>
        <td>
            <?php
            echo $f->makeField('grade['.$i.']', array('type'=>'text',
                'in'=>'class="txt" maxlength="10"',
                'label'=>'نمره اخذ شده<span class="error">*</span>'
                ));
            ?>
        </td>
        <td>
            <?php
            echo $f->makeField('point['.$i.']', array('type'=>'text',
                'in'=>'class="txt" maxlength="10"',
                'label'=>'امتیاز دوره<span class="error">*</span>'
                ));
            ?>
        </td>
       <td>
           <?php
           echo $f->select('t_cat['.$i.']',array(
                    'type'=>'select',
                    'options'=>$t_cat,
                    'label'=>'رده دوره<span class="error">*</span>'
                )); 
           ?>
       </td>
    </tr>
    <tr>
    	<td>
            <?php
            echo $f->makeField('place['.$i.']', array('type'=>'text',
                'in'=>'class="txt"',
                'label'=>'محل برگزاری دوره<span class="error">*</span>'
                ));
            ?>
        </td>
        <td>
           <label>تاریخ برگزاری آزمون<span class="error">*</span></label>
           <?php
           echo $f->select('d_exam['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>
                    'days_of_month'
                )); 
           echo $f->select('m_exam['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'months_of_year'
                )); 
           echo $f->select('y_exam['.$i.']',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'years_1370_1392'
                )); 
           ?>
        </td>
        <td colspan="2">
            <?php
            echo $f->textarea('description['.$i.']', array(
                'rows'=>6,
                'cols'=>60,
                'label'=>'توضیحات'
                ));
            ?>
        </td>
         <td>
            <?php
            echo $f->radio('is_passed['.$i.']', array(
                'value'=>array('1'=>'قبول',
                '2'=>'رد'),
                'label'=>'وضعیت قبولی<span class="error">*</span>',
                'showFieldErrorText'=>TRUE
                ));
            ?>
        </td>
    </tr>
</table>    
<?php endfor;  
else: ?>
<table class="create">
    <tr>
        <td>
            <?php
            echo $f->select('title[]', array(
                'options'=>$trainings,
                'label'=>'عنوان دوره<span class="error">*</span>',
                 'in'=>'class="select"',
                ));
            ?>
        </td>
        <td>
            <?php
            echo $f->makeField('code[]', array('type'=>'text',
                'in'=>'class="txt" maxlength="10"',
                'label'=>'کد دوره<span class="error">*</span>'
                ));
            ?>
        </td>
        <td>
           <label>تاریخ شروع<span class="error">*</span></label>
           <?php
           echo $f->select('d_start[]',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>
                    'days_of_month'
                )); 
           echo $f->select('m_start[]',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'months_of_year'
                )); 
           echo $f->select('y_start[]',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'years_1370_1392'
                )); 
           ?>     
        </td>
        <td>
           <label>تاریخ پایان<span class="error">*</span></label>
           <?php
           echo $f->select('d_end[]',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>
                    'days_of_month'
                )); 
           echo $f->select('m_end[]',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'months_of_year'
                )); 
           echo $f->select('y_end[]',array(
                    'decoration'=>FALSE,
                    'type'=>'select',
                    'options'=>'years_1370_1392'
                )); 
           ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            echo $f->makeField('period[]', array('type'=>'text',
                'in'=>'class="txt" maxlength="10"',
                'label'=>'مدت دوره<span class="error">*</span>',
                'out'=>' ساعت'
                ));
            ?>
        </td>
        <td>
            <?php
            echo $f->makeField('grade[]', array('type'=>'text',
                'in'=>'class="txt" maxlength="10"',
                'label'=>'نمره اخذ شده<span class="error">*</span>'
                ));
            ?>
        </td>
        <td>
            <?php
            echo $f->makeField('point[]', array('type'=>'text',
                'in'=>'class="txt" maxlength="10"',
                'label'=>'امتیاز دوره<span class="error">*</span>'
                ));
            ?>
        </td>
        <td>
           <?php
           echo $f->select('t_cat[]',array(
                    'type'=>'select',
                    'options'=>$t_cat,
                    'label'=>'رده دوره<span class="error">*</span>'
                )); 
           ?>
       </td>
    </tr>
    <tr>
        <td colspan="2">
            <?php
            echo $f->textarea('description[]', array(
                'rows'=>6,
                'cols'=>60,
                'label'=>'توضیحات'
                ));
            ?>
        </td>
        <td>
            <?php
            echo $f->radio('is_passed[]', array(
                'value'=>array('1'=>'قبول',
                '2'=>'رد'),
                'showFieldErrorText'=>TRUE,
                'label'=>'وضعیت قبولی<span class="error">*</span>',
                ));
            ?>
        </td>
    </tr>
</table>
<?php endif; ?>
</div>
<img src="<?php echo PHP40::get()->homeUrl; ?>public/images/plus.png" style="cursor:pointer" alt="افزودن اطلاعات تحصیلی"  class="add_study" />
<script>
$(function(){
    $('.add_study').click(function(){
        $('#page').append('<table class="create"><tr><td><?php echo $f->select('title[]', array('type'=>'select','in'=>'class="select"','options'=>$trainings,'label'=>'عنوان دوره<span class="error">*</span>'));?></td><td><?php echo $f->makeField('code[]', array('type'=>'text','in'=>'class="txt" maxlength="10"','label'=>'کد دوره<span class="error">*</span>'));?></td>'+
        '<td><label>تاریخ شروع<span class="error">*</span></label><?php echo $f->select('d_start[]',array('decoration'=>FALSE,'type'=>'select','options'=>'days_of_month')); echo $f->select('m_start[]',array('decoration'=>FALSE,'type'=>'select','options'=>'months_of_year')); echo $f->select('y_start[]',array('decoration'=>FALSE,'type'=>'select','options'=>'years_1370_1392')); ?></td>'+
        '<td><label>تاریخ پایان<span class="error">*</span></label><?php echo $f->select('d_end[]',array('decoration'=>FALSE,'type'=>'select','options'=>'days_of_month')); echo $f->select('m_end[]',array('decoration'=>FALSE,'type'=>'select','options'=>'months_of_year'));echo $f->select('y_end[]',array('decoration'=>FALSE,'type'=>'select','options'=>'years_1370_1392')); ?></td></tr><tr><td><?php echo $f->makeField('period[]', array('type'=>'text','in'=>'class="txt" maxlength="10"','label'=>'مدت دوره<span class="error">*</span>','out'=>' ساعت'));?></td><td><?php echo $f->makeField('grade[]', array('type'=>'text','in'=>'class="txt" maxlength="10"','label'=>'نمره اخذ شده<span class="error">*</span>'));?></td><td><?php echo $f->makeField('point[]', array('type'=>'text','in'=>'class="txt" maxlength="10"','label'=>'امتیاز دوره<span class="error">*</span>'));?></td>'+
        '<td><?php echo $f->select('t_cat[]',array('type'=>'select','options'=>$t_cat,'label'=>'رده دوره<span class="error">*</span>')); ?></td></tr><tr><td colspan="2"><?php echo $f->textarea('description[]', array('rows'=>6,'cols'=>60,'label'=>'توضیحات'));?></td><td><?php  echo $f->radio('is_passed[]', array('value'=>array('1'=>'قبول','2'=>'رد'),'showFieldErrorText'=>TRUE,'label'=>'وضعیت قبولی<span class="error">*</span>',)); ?></td></tr></table>'); 
    });
});
</script>
<p><label>&nbsp;</label><input type="submit" name="submit" value="ثبت" class="box" /></p>
</form>