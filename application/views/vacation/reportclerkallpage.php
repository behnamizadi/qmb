<div id="jtable"></div>
<?php
echo $grid;
echo $detail;
if(isset($c_id)):
?>
<?php echo CUrl::createLink('افزودن مرخصی', 'vacation/add/'.$c_id, 'target="_blank""', $in = TRUE); ?>
<?php echo CUrl::createLink('نسخه چاپی', 'vacation/summprint/'.$c_id.'/'.$y, 'target="_blank"', $in = TRUE); ?>
<?php endif; 
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