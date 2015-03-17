<?php
if(empty($props)) $props = array(0=>(object)array('name'=>1));
echo $form->beginForm();
foreach($props as $prop){
    switch($prop->name) {
        case 'pos':
            $pos = $form->checkbox('pos', array(
                'value'=>'<span style="font-size:12px">POS</span> شعبه‌ای',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $pos .= $form->makeField('pos_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'atm':
            $atm = $form->checkbox('atm', array(
                'value'=>'<span style="font-size:12px">ATM</span>',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $atm .= $form->makeField('atm_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'asr':
            $asr = $form->checkbox('asr', array(
                'value'=>'باجه عصر',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $asr .= $form->makeField('asr_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'mpls':
            $mpls = $form->checkbox('mpls', array(
                'value'=>'<span style="font-size:12px">MPLS</span>',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $mpls .= $form->makeField('mpls_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'adsl':
            $adsl = $form->checkbox('adsl', array(
                'value'=>'<span style="font-size:12px">ASDL</span>',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $adsl .= $form->makeField('adsl_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'vsat':
            $vsat = $form->checkbox('vsat', array(
                'value'=>'<span style="font-size:12px">VSAT</span>',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $vsat .= $form->makeField('vsat_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'card':
            $card = $form->checkbox('card', array(
                'value'=>'آنی کارت',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $card .= $form->makeField('card_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'nobat':
            $nobat = $form->checkbox('nobat', array(
                'value'=>'دستگاه نوبت‌دهی',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $nobat .= $form->makeField('nobat_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'dozdgir':
            $dozdgir = $form->checkbox('dozdgir', array(
                'value'=>'دزدگیر',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $dozdgir .= $form->makeField('dozdgir_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'camera':
            $camera = $form->checkbox('camera', array(
                'value'=>'دوربین',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $camera .= $form->makeField('camera_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'copy':
            $copy = $form->checkbox('copy', array(
                'value'=>'دستگاه کپی',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $copy .= $form->makeField('copy_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'gas_cooler':
            $gas_cooler = $form->checkbox('gas_cooler', array(
                'value'=>'کولر گازی',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $gas_cooler .= $form->makeField('gas_cooler_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'water_cooler':
            $water_cooler = $form->checkbox('water_cooler', array(
                'value'=>'کولر آبی',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $water_cooler .= $form->makeField('water_cooler_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'up_pool':
            $up_pool = $form->checkbox('up_pool', array(
                'value'=>'پولشمار ایستاده',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $up_pool .= $form->makeField('up_pool_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        case 'miz_pool':
            $miz_pool = $form->checkbox('miz_pool', array(
                'value'=>'پولشمار رومیزی',
                'decoration'=>FALSE,
                'in'=>'checked="checked"'
            ));
            $miz_pool .= $form->makeField('miz_pool_number', array(
                'value'=>$prop->quantity,
                'type'=>'text',
                'in'=>'class="props" maxLength="2"',
                'validation'=>'number,maxValue[99]',
                'decoration'=>FALSE
            ));
            break;
        
    }
}
?>
<table class="create"><tr><td>
<?php
if(isset($pos))
    echo $pos;
else {
    echo $form->checkbox('pos', array(
            'value'=>'<span style="font-size:12px">POS</span> شعبه‌ای',
            'decoration'=>FALSE
        ));
     echo $form->makeField('pos_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($atm))
    echo $atm;
else {
    echo $form->checkbox('atm', array(
            'value'=>'<span style="font-size:12px">ATM</span>',
            'decoration'=>FALSE
        ));
    echo $form->makeField('atm_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($asr))
    echo $asr;
else {
    echo $form->checkbox('asr', array(
            'value'=>'باجه عصر',
            'decoration'=>FALSE
        ));
        echo $form->makeField('asr_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($mpls))
    echo $mpls;
else {
    echo $form->checkbox('mpls', array(
            'value'=>'<span style="font-size:12px">MPLS</span>',
            'decoration'=>FALSE
        ));
        echo $form->makeField('mpls_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($adsl))
    echo $adsl;
else {
    echo $form->checkbox('adsl', array(
            'value'=>'<span style="font-size:12px">ASDL</span>',
            'decoration'=>FALSE
        ));
        echo $form->makeField('adsl_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td></tr><tr><td>
<?php
if(isset($vsat))
    echo $vsat;
else {
    echo $form->checkbox('vsat', array(
            'value'=>'<span style="font-size:12px">VSAT</span>',
            'decoration'=>FALSE
        ));
        echo $form->makeField('vsat_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($card))
    echo $card;
else {
    echo $form->checkbox('card', array(
            'value'=>'آنی کارت',
            'decoration'=>FALSE
        ));
        echo $form->makeField('card_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($nobat))
    echo $nobat;
else {
    echo $form->checkbox('nobat', array(
            'value'=>'دستگاه نوبت‌دهی',
            'decoration'=>FALSE
        ));
        echo $form->makeField('nobat_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($dozdgir))
    echo $dozdgir;
else {
    echo $form->checkbox('dozdgir', array(
            'value'=>'دزدگیر',
            'decoration'=>FALSE
        ));
        echo $form->makeField('dozdgir_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($camera))
    echo $camera;
else {
    echo $form->checkbox('camera', array(
            'value'=>'دوربین',
            'decoration'=>FALSE
        ));
        echo $form->makeField('camera_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td></tr><tr><td>
<?php
if(isset($copy))
    echo $copy;
else {
    echo $form->checkbox('copy', array(
            'value'=>'دستگاه کپی',
            'decoration'=>FALSE
        ));
        echo $form->makeField('copy_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($gas_cooler))
    echo $gas_cooler;
else {
    echo $form->checkbox('gas_cooler', array(
            'value'=>'کولر گازی',
            'decoration'=>FALSE
        ));
        echo $form->makeField('gas_cooler_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($water_cooler))
    echo $water_cooler;
else {
    echo $form->checkbox('water_cooler', array(
            'value'=>'کولر آبی',
            'decoration'=>FALSE
        ));
        echo $form->makeField('water_cooler_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($up_pool))
    echo $up_pool;
else {
    echo $form->checkbox('up_pool', array(
            'value'=>'پولشمار ایستاده',
            'decoration'=>FALSE
        ));
        echo $form->makeField('up_pool_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td><td>
<?php
if(isset($miz_pool))
    echo $miz_pool;
else {
    echo $form->checkbox('miz_pool', array(
            'value'=>'پولشمار رومیزی',
            'decoration'=>FALSE
        ));
        echo $form->makeField('miz_pool_number', array(
            'type'=>'text',
            'in'=>'class="props" readOnly="readOnly" maxLength="2"',
            'validation'=>'number,maxValue[99]',
            'decoration'=>FALSE
        ));
}
?>
</td></tr></table>
<?php
echo $form->makeField('submit', array(
            'type'=>'submit',
            'value'=>'ویرایش',
            'in'=>'class="btn btn-primary"'
        ));
?>
</form>
<script>
    $(function(){
        if($('#pos').is(':checked'))
                $('#pos_number').prop('readonly', false);
        if($('#atm').is(':checked'))
                $('#atm_number').prop('readonly', false);
        if($('#asr').is(':checked'))
                $('#asr_number').prop('readonly', false);
        if($('#mpls').is(':checked'))
                $('#mpls_number').prop('readonly', false);
        if($('#adsl').is(':checked'))
                $('#adsl_number').prop('readonly', false);
        if($('#vsat').is(':checked'))  
                $('#vsat_number').prop('readonly', false);
        if($('#card').is(':checked'))
                $('#card_number').prop('readonly', false);
        if($('#nobat').is(':checked'))
                $('#nobat_number').prop('readonly', false);
        if($('#miz_pool').is(':checked'))
                $('#miz_pool_number').prop('readonly', false);
        if($('#dozdgir').is(':checked'))
                $('#dozdgir_number').prop('readonly', false);
        if($('#camera').is(':checked'))
                $('#camera_number').prop('readonly', false);
        if($('#copy').is(':checked'))
                $('#copy_number').prop('readonly', false);
        if($('#gas_cooler').is(':checked'))
                $('#gas_cooler_number').prop('readonly', false);
        if($('#water_cooler').is(':checked'))
                $('#water_cooler_number').prop('readonly', false);
        if($('#up_pool').is(':checked'))
                $('#up_pool_number').prop('readonly', false);
        $('#pos').click(function(){
            if($('#pos').is(':checked')){
                //$("#pos_number").focus();
                $('#pos_number').prop('readonly', false);
                $('#pos_number').val(1);
            }
            else{
                $('#pos_number').prop('readonly', true);
                $('#pos_number').val('');
            }    
        });
        $('#atm').click(function(){
            if($('#atm').is(':checked')){
                $('#atm_number').prop('readonly', false);
                $('#atm_number').val(1);
            }
            else{
                $('#atm_number').prop('readonly', true);
                $('#atm_number').val('');
            }    
        });
        $('#asr').click(function(){
            if($('#asr').is(':checked')){
                $('#asr_number').prop('readonly', false);
                $('#asr_number').val(1);
            }
            else{
                $('#asr_number').prop('readonly', true);
                $('#asr_number').val('');
            }    
        });
        $('#mpls').click(function(){
            if($('#mpls').is(':checked')){
                $('#mpls_number').prop('readonly', false);
                $('#mpls_number').val(1);
            }
            else{
                $('#mpls_number').prop('readonly', true);
                $('#mpls_number').val('');
            }    
        });
        $('#adsl').click(function(){
            if($('#adsl').is(':checked')){
                $('#adsl_number').prop('readonly', false);
                $('#adsl_number').val(1);
            }
            else{
                $('#adsl_number').prop('readonly', true);
                $('#adsl_number').val('');
            }    
        });
        $('#vsat').click(function(){
            if($('#vsat').is(':checked')){
                $('#vsat_number').prop('readonly', false);
                $('#vsat_number').val(1);
            }
            else{
                $('#vsat_number').prop('readonly', true);
                $('#vsat_number').val('');
            }    
        });
        $('#card').click(function(){
            if($('#card').is(':checked')){
                $('#card_number').prop('readonly', false);
                $('#card_number').val(1);
            }
            else{
                $('#card_number').prop('readonly', true);
                $('#card_number').val('');
            }    
        });
        $('#nobat').click(function(){
            if($('#nobat').is(':checked')){
                $('#nobat_number').prop('readonly', false);
                $('#nobat_number').val(1);
            }
            else{
                $('#nobat_number').prop('readonly', true);
                $('#nobat_number').val('');
            }    
        });
        $('#miz_pool').click(function(){
            if($('#miz_pool').is(':checked')){
                $('#miz_pool_number').prop('readonly', false);
                $('#miz_pool_number').val(1);
            }
            else{
                $('#miz_pool_number').prop('readonly', true);
                $('#miz_pool_number').val('');
            }    
        });
        $('#dozdgir').click(function(){
            if($('#dozdgir').is(':checked')){
                $('#dozdgir_number').prop('readonly', false);
                $('#dozdgir_number').val(1);
            }
            else{
                $('#dozdgir_number').prop('readonly', true);
                $('#dozdgir_number').val('');
            }    
        });
        $('#camera').click(function(){
            if($('#camera').is(':checked')){
                $('#camera_number').prop('readonly', false);
                $('#camera_number').val(1);
            }
            else{
                $('#camera_number').prop('readonly', true);
                $('#camera_number').val('');
            }    
        });
        $('#copy').click(function(){
            if($('#copy').is(':checked')){
                $('#copy_number').prop('readonly', false);
                $('#copy_number').val(1);
            }
            else{
                $('#copy_number').prop('readonly', true);
                $('#copy_number').val('');
            }    
        });
        $('#gas_cooler').click(function(){
            if($('#gas_cooler').is(':checked')){
                $('#gas_cooler_number').prop('readonly', false);
                $('#gas_cooler_number').val(1);
            }
            else{
                $('#gas_cooler_number').prop('readonly', true);
                $('#gas_cooler_number').val('');
            }    
        });
        $('#water_cooler').click(function(){
            if($('#water_cooler').is(':checked')){
                $('#water_cooler_number').prop('readonly', false);
                $('#water_cooler_number').val(1);
            }
            else{
                $('#water_cooler_number').prop('readonly', true);
                $('#water_cooler_number').val('');
            }    
        });
        $('#up_pool').click(function(){
            if($('#up_pool').is(':checked')){
                $('#up_pool_number').prop('readonly', false);
                $('#up_pool_number').val(1);
            }
            else{
                $('#up_pool_number').prop('readonly', true);
                $('#up_pool_number').val('');
            }    
        });
    });
</script>
