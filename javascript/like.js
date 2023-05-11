$(document).ready(function(){
    $('.likeBtn').click(function(){
        var postId = $(this).attr("name");
    
        // this code is made for counting like and change like btn image
  
        var countNum = $(this).parent(".likel").parent(".likecontainer").parent(".likecommentsherebar").parent(".lkandcombox").children(".lvLgandlklgwrp").children(".likenumber").children("p").children(".likesNum");
  
        var likeNum = $(countNum).html();
        var likeImg = $(this).children(".likeimg").attr("src");
        // alert(likeImg);
        if(likeImg == "../photos/like1.png"){
          var likePic = $(this).children(".likeimg").attr("src","../photos/like2.png");
          $(likePic).animate({width:"0px",opacity:"0"},100, function(){
          $(likePic).animate({width:"35px",opacity:"1"});
         });
          likeNum++;
          $(countNum).html(likeNum++);
        }else if(likeImg == "../photos/like2.png"){
          var unlikePic = $(this).children(".likeimg").attr("src","../photos/like1.png");
          $(unlikePic).animate({width:"0px",opacity:"0"},100, function(){
          $(unlikePic).animate({width:"35px",opacity:"1"});
         });
          likeNum--;
          $(countNum).html(likeNum--);
        }
  
        $.post("like.php",{data:postId,btn:'likeSubmit'});
        });//end all blocks like function
  
  
  
        // my  posts likes functionallity
        $('.likeBtnMy').click(function(){
        var postIdMy = $(this).attr("name");
        
        // this code is made for counting like and change like btn image
  
        var countNumMy = $(this).parent(".likel").parent(".likecontainer").parent(".likecommentsherebar").parent(".lkandcombox").children(".lvLgandlklgwrp").children(".likenumber").children("p").children(".myPostsLikeNum");
  
        var mylikeNum = $(countNumMy).html();
        var mylikeImg = $(this).children(".myLikeimg").attr("src");
        // alert(likeImg);
        if(mylikeImg == "../photos/like1.png"){
  
          var mylikedImg = $(this).children(".myLikeimg").attr("src","../photos/like2.png");
         $(mylikedImg).animate({width:"0px",opacity:"0"},100, function(){
          $(mylikedImg).animate({width:"35px",opacity:"1"});
         });
  
          mylikeNum++;
          $(countNumMy).html(mylikeNum++);
        }else if(mylikeImg == "../photos/like2.png"){
          var myunlikedImg = $(this).children(".myLikeimg").attr("src","../photos/like1.png");
         $(myunlikedImg).animate({width:"0px",opacity:"0"},100, function(){
          $(myunlikedImg).animate({width:"35px",opacity:"1"});
         });
          mylikeNum--;
          $(countNumMy).html(mylikeNum--);
        }
  
        $.post("like.php",{data:postIdMy,btn:'likeSubmit'});
        });//end all blocks like function
});