$(document).ready(function(){
    $("#postBtn").click(function(e){
        e.preventDefault();
        var userPostingId = $(this).attr("name");
        var postText = $("#postText").val();
    
        if(postText == ''){
            $("#postMsgDiv").css("display","block");
            $("#postMsg").text('Please, write something!');
        }else{
            $.post("postBlogFunction.php",{postText:postText,userPostingId:userPostingId,postBtn:'postBtn'},function(data){
            $("#postMsg").text(data);
            $("#postMsgDiv").css("display","block");
            $("#postText").val('');
            if(data === 'Post has been created successfully'){
                setTimeout(function(){
                    window.location.href = 'home.php';
                },1200);

            }
            });
        }
    });
});







