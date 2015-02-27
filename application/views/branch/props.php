<?php
echo $form;
?>
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