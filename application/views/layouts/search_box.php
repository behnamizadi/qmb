<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="search_box">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
    <form method="post" action="#" id="search_form">
        <span class="glyphicon glyphicon-remove"></span>
       <p>
           <label for="name">نام</label>
           <input type="text" name="name" id="name" class="txt" />
       </p>
       <p>
           <label for="lastname">نام خانوادگی</label>
           <input type="text" name="lastname" id="lastname" class="txt" />
       </p>
       <p>
           <label>&nbsp;</label>
           <input type="submit" name="search_clerk" id="search_clerk" value="جستجو" class="box" />
       </p>
    </form>
</div>
<?php $scripts="<script type='text/javascript'>
$(document).ready(function(){
    $('#search').click(function(){ 
        $('#search_box').fadeIn();
        $('#name').focus();
        $('form#search_form').submit(function(e){  
            e.preventDefault();
            var name = $('#name').val();
            var lastname = $('#lastname').val();
            if(name || lastname)
            { 
                $.ajax({
                    cache: false,
                    url: '". PHP40::get()->homeUrl ."index.php/search/clerk_number/',
                    type: 'POST',
                    data:{name:name,lastname:lastname},
                    success:function(result){
                        if(result == 'NO')
                        {
                            alert('هیچ نتیجه‌ای پیدا نشد.');
                        }
                        else if(result == 'MORE')
                        {
                            alert('بیش از یک نتیجه پیدا شد.');
                        }
                        else{
                            $('#clerk_number').val(result);
                            $('#search_box').fadeOut(1);
                        }
                    }
                });
            }
        }); 
    });
    $('.close').click(function(){ $('#search_box').fadeOut(); });
});
</script>"; ?>