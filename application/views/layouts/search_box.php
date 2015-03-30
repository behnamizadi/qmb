<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <button data-dismiss="modal" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">جستجوی کارمند</h4>
      </div>
      <div class="modal-body">
           <form class="form-horizontal" method="post" action="#" id="search_form">
      <div class="form-group">
           <label class="col-md-3"  for="name">نام</label>
           <input  type="text" name="name" id="name" class="txt" />
      </div>
      <div class="form-group"> 
           <label class="col-md-3" for="lastname">نام خانوادگی</label>
           <input type="text" name="lastname" id="lastname" class="txt" />
      </div>
      <div class="form-group">
          <div class="col-md-3" for="lastname">
        <input class="btn btn-success" type="submit" name="search_clerk" id="search_clerk" value="جستجو" />
        </div>
       </div>
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