<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <button data-dismiss="modal" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">جستجوی کارمند</h4>
      </div>
      <div class="modal-body">
           <form method="post" action="#" id="search_form">
       <p>
           <label for="name">نام</label>
           <input type="text" name="name" id="name" class="txt" />
       </p>
       <p>
           <label for="lastname">نام خانوادگی</label>
           <input type="text" name="lastname" id="lastname" class="txt" />
       </p>
       <p>
                     <input type="submit" name="search_clerk" id="search_clerk" value="جستجو" class="box" />
       </p>
    </form>
      </div>
      <div class="modal-footer">

      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<?php $scripts="<script type='text/javascript'>
$(document).ready(function(){
    $('#search').click(function(){
        $('.modal').modal('toggle'); 
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
                            $('.modal').modal('hide');
                        }
                    }
                });
            }
        }); 
    });
    $('.close').click(function(){ $('.modal').modal('hide'); });
});
</script>"; ?>