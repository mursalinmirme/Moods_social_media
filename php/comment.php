<?php
if(isset($_POST["subBtn"])){
   include "dbconnect.php";
   $commentPostId = $_POST["commentId"];
   $commentText = $_POST["commentTxt"];
   session_start();
   $userId = $_SESSION["user_id"];

   $commentQuery = "INSERT INTO `comment`(`post_id`, `comment_userid`, `comment_text`) VALUES ('$commentPostId','$userId','$commentText')";

   $runCommentQuery = mysqli_query($conn, $commentQuery);

   // showing comments profile picture
   $commentPic = "SELECT * FROM `users` WHERE user_id = '$userId'";
   $runCommentPic = mysqli_query($conn, $commentPic);
   while($catchProfile = mysqli_fetch_assoc($runCommentPic)){
   $viewProfile = $catchProfile['profile_pic'];
   if($viewProfile == "avater.png"){
      $modifyviewProfile = "../photos/avater.png";
    }else{
      $modifyviewProfile = "../upload/$viewProfile";
    }
      echo $modifyviewProfile;
   }

   if($runCommentQuery){
      $increComments = "UPDATE `post_status` SET`comments`=comments+1 WHERE id='$commentPostId' ";
      $runIncreLike = mysqli_query($conn, $increComments);
   }

}





?>