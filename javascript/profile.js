$(document).ready(function(){
    $(".likeBtnPro").click(function(){
      var postId = $(this).attr("title");
      var countNum = $(this).parent(".likel").parent(".likecontainer").parent(".likecommentsherebar").parent(".lkandcombox").children(".lvLgandlklgwrp").children(".likenumber").children("p").children(".likesNum");

      // this code is made for counting like and change like btn image
      var likeNum = $(countNum).html();

      var likeImg = $(this).children(".likeimg").attr("src");
      // alert(likeImg);
      if(likeImg == "../photos/like1.png"){
        
       var likedImg = $(this).children(".likeimg").attr("src","../photos/like2.png");
       $(likedImg).animate({width:"0px",opacity:"0"},100, function(){
        $(likedImg).animate({width:"35px",opacity:"1"});
       });

        likeNum++;
        $(countNum).html(likeNum++);
      }else if(likeImg == "../photos/like2.png"){
        var unlikedImg = $(this).children(".likeimg").attr("src","../photos/like1.png");
        $(unlikedImg).animate({width:"0px",opacity:"0"},100, function(){
        $(unlikedImg).animate({width:"35px",opacity:"1"});
       });
        likeNum--;
        $(countNum).html(likeNum--);
      }

      $.post("like.php",{data:postId,btn:'likeSubmit'});

    });

// comment box javascript code start
// comment box javascript code start
// comment box javascript code start

$(".commentBtn").click(function(){
    var call = $(this).attr("name");
    // alert(call);

      var postCommentBox = $(this).parent(".commentl").parent(".likecontainer").parent(".likecommentsherebar").parent(".lkandcombox").parent(".postdataWrep").children(".commentBox");

      var showBorder = $(this).parent(".commentl").parent(".likecontainer");

      $(showBorder).css("border-bottom", "0.5px solid #d4d1d1");

     $(postCommentBox).show();




  });
// comment box javascript code end
// comment box javascript code end
// comment box javascript code end


$(".countComment").click(function (){
  var ck = $(this).attr("name");

  var showBorderToggle = $(this).parent(".comntsnumber").parent(".lvLgandlklgwrp").parent(".lkandcombox").children(".likecommentsherebar").children(".likecontainer");

  $(showBorderToggle).css("border-bottom", "0.5px solid #d4d1d1");

  var comentsShow = $(this).parent(".comntsnumber").parent(".lvLgandlklgwrp").parent(".lkandcombox").parent(".postdataWrep").children(".commentBox");

  $(comentsShow).toggle();

});




// comment submit
// comment submit
// comment submit

$('.postComment').keypress(function (e) {
  var commentsPostId = $(this).attr("name");
  var commentText = $(this).val();
  var callid = $(this);

  var selectComments = $(this).parent(".commentInput").parent(".commentInputWrap").parent(".commentBox").parent(".postdataWrep").children(".lkandcombox").children(".lvLgandlklgwrp").children(".comntsnumber").children("h3").children(".countComment");

  var countComments = $(selectComments).html();

  if (e.which == 13) {
    $('form#login').submit();

    if(commentText == ""){
      alert("Please write something!");
    }else if(commentText != ""){
      $.post("comment.php",{commentId:commentsPostId,commentTxt:commentText,subBtn:"commentSubmit"},function(data){
        $(".postComment").val('');
        $(callid).parent(".commentInput").parent(".commentInputWrap").parent(".commentBox").children(".showComment").prepend("<div class='singleComment'><div class='singleCommentWrap'><div class='commentPic'><img src='../upload/"+ data + "'></div><div class='commentText'><div class='commentName'><p>John Doe</p><span>"+commentText+"</span></div><div class='commentMenu'><i class='fas fa-ellipsis-v'></i></div></div></div></div>");
        countComments++;
        selectComments.html(countComments);
      });
    }
      
  }


});


// this js code for making following system

$(".follow_btn").click(function(){
  var followingStatus = $(this).children(".followerStatus");
  var followId = $(this).attr("name");
  var followerId = $(this).parent(".followBtn").attr("name");

  var countFollowrs = $(this).parent(".followBtn").parent(".proDescWrep").children(".flwLkComWrep").children(".followdiv").children(".flwdivwrep").children(".numFlwer").children(".countFollowers");

  var countFlwsVlu = $(countFollowrs).html();

  var catchFollowersStatus = $(this).children(".followerStatus").html();

  if(catchFollowersStatus == 'Follow'){
    countFlwsVlu++;
    $(countFollowrs).html(countFlwsVlu++);
  }else if(catchFollowersStatus == 'Following'){
    countFlwsVlu--;
    $(countFollowrs).html(countFlwsVlu--);
  }


  $.post("follow.php",{followId:followId,followerId:followerId,follow_btn:"followBtn"},function(data){
    $(followingStatus).text(data);
  });
});

// Read More status js code
$(".readMoreBtn").click(function(){
  var ipk = $(this).attr("name");
  $(this).parent(".textStatuss").html(ipk+"..."+"<span class='showlessbtn'>Show_less</span>");
  
});




  });//end document.ready function















