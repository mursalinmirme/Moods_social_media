$(document).ready(function(){
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
  var commentsName = $('#userName').text();
  if (e.which == 13) {
    $('form#login').submit();

    if(commentText == ""){
      alert("Please write something!");
    }else if(commentText != ""){
      $.post("comment.php",{commentId:commentsPostId,commentTxt:commentText,subBtn:"commentSubmit"},function(data){
        $(".postComment").val('');
        $(callid).parent(".commentInput").parent(".commentInputWrap").parent(".commentBox").children(".showComment").prepend("<div class='singleComment'><div class='singleCommentWrap'><div class='commentPic'><img src='../upload/"+ data + "'></div><div class='commentText'><div class='commentName'><p>"+ commentsName +"</p><span>"+commentText+"</span></div><div class='commentMenu'><i class='fas fa-ellipsis-v'></i></div></div></div></div>");
        countComments++;
        selectComments.html(countComments);
      });
    }
      
  }


});


// comment submit from my profile option
// comment submit from my profile option
// comment submit from my profile option

$('.postCommentMyPro').keypress(function (e) {
  var myCommentsPostId = $(this).attr("name");
  var mycommentText = $(this).val();
  var callid = $(this);

  var selectComments = $(this).parent(".commentInput").parent(".commentInputWrap").parent(".commentBox").parent(".postdataWrep").children(".lkandcombox").children(".lvLgandlklgwrp").children(".comntsnumber").children("h3").children(".countComment");

  var countComments = $(selectComments).html();

  if (e.which == 13) {
    $('form#login').submit();

    if(mycommentText == ""){
      alert("Please write something!");
    }else if(mycommentText != ""){
      $.post("comment.php",{commentId:myCommentsPostId,commentTxt:mycommentText,subBtn:"commentSubmit"},function(data){
        $(".postComment").val('');
        $(callid).parent(".commentInput").parent(".commentInputWrap").parent(".commentBox").children(".showComment").prepend("<div class='singleComment'><div class='singleCommentWrap'><div class='commentPic'><img src='../upload/"+ data + "'></div><div class='commentText'><div class='commentName'><p>John Doe</p><span>"+mycommentText+"</span></div><div class='commentMenu'><i class='fas fa-ellipsis-v'></i></div></div></div></div>");
        countComments++;
        selectComments.html(countComments);
      });
    }
      
  }


});//end submit comment for my profile option
});