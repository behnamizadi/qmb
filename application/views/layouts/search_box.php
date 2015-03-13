<div id="search_box">
    <a href="#" class="close"><img src="<?php echo PHP40::get()->homeUrl; ?>public/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
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
           <label>&nbsp;</label>
           <input type="submit" name="search_clerk" id="search_clerk" value="جستجو" class="box" />
       </p>
    </form>
</div>
<style>
#search_box{
    display: none;
    background-color: #EFEFEF;
    border: 1px solid #D0D0D0;
    border-radius: 10px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    margin: 0 auto 20px;
    padding: 19px 29px 29px;
    position: fixed;
    top: 35%;
    left: 40%;
    }
    img.btn_close {
    Position the close button
    float: right;
    margin: -28px -28px 0 0;
}

</style>
<?php $scripts="
<script>
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