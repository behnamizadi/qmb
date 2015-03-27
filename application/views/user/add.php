<div id="PersonTableContainer"></div>
<?php
 $scripts="
<script type='text/javascript'>
        $('#PersonTableContainer').jtable({
            title: 'لیست کاربران',
            actions: {
                listAction: '".PHP40::get() -> homeUrl."index.php/user/add_user',
                createAction: '/GettingStarted/CreatePerson',
                updateAction: '/GettingStarted/UpdatePerson',
                deleteAction: '/GettingStarted/DeletePerson'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: 'نام کاربر',
                  
                },
                username: {
                    title: 'سن',
                  
                }
            }
        });
        $('#PersonTableContainer').jtable('load');
</script>
";
  ?>