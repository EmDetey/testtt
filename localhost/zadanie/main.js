$(document).ready(function(){
    let swithcerForm = false;
    $('#callForm').on('click',function(){
        if(swithcerForm == false)
        {
            $(".addTovars").css("display","flex");
            swithcerForm = true;
        }
        else
        {
            $(".addTovars").css("display","none");
            swithcerForm = false;
        }
    });

   $(".addTovars").on("submit",function(e){
        
        $.ajax({
            url: "addTovar.php",
            method:"post",
            data: $(this).serialize(),
            success: function(data){
                console.log(data)
            }
        })


        return false;
   });
});