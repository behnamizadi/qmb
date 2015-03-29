<div id="jtable"></div>
<?php
 $scripts="
<script type='text/javascript'>
        $('#jtable').jtable({
            paging: true,
            title: 'لیست کاربران',
            actions: {
                listAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=list&clerk_id=5',
                createAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=create&clerk_id=5',
                updateAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=update&clerk_id=5',
                deleteAction: '".PHP40::get() -> homeUrl."index.php/vacation/proccess_yearly?action=delete&clerk_id=5'
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
  ?>