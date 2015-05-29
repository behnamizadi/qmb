<div id="jtable"></div>
<?php
$id=$_REQUEST["clerk_id"];
 $scripts="
<script type='text/javascript'>
        $('#jtable').jtable({
            paging: true,
            title: 'مرخصی سالانه',
            actions: {
                listAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=list&clerk_id=$id',
                createAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=create&clerk_id=$id',
                updateAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=update&clerk_id=$id',
                deleteAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=delete&clerk_id=$id'
            },
            fields: {
                clerk_id:{
                    title:'شماره کارمند',
                    key:true,
                    list:false,
                    
                },
                year: {
                    key:true,
                    title: 'سال',
                    create:true,
                  
                },
                all_v: {
                    title: 'کل مرخصی',
                  
                },
                used:{
                    title:'استحقاقی استفاده شده',
                },
                wasted:{
                    title:'سوخت شده',
                },
                saved:{
                    title:'ذخیره استحقاقی',
                }
              
                
            }
        });
        $('#jtable').jtable('load');
</script>
";