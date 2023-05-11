$(document).ready(function(){

    $(".delete_post").click(function(){
        var deletePostId = $(this).attr('name');
        // alert(deletePostId);
        var con = confirm("do you want to delete the post?");
        // alert(con.valueOf());
        if(con.valueOf() === true){
            $.post("deletePost.php",{deletePostid:deletePostId,deleteBtn:"deleteSubmite"},function(data){
                alert(data);
                $(".postOption").hide();
                location.reload(true);
            })
    
        }
    })

})//document ready function close