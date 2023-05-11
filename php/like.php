<?php
  if(isset($_POST['btn'])){
    include "dbconnect.php";
    $postId = $_POST['data'];
    session_start();
    $given_user_id = $_SESSION['user_id'];
    $check_like = "SELECT `given_user_id`, `like_post_id` FROM `like_post` WHERE given_user_id='$given_user_id' AND like_post_id='$postId';";

    $runCheckLike = mysqli_query($conn, $check_like);

    if(mysqli_num_rows($runCheckLike) == 0){

      $increLike = "UPDATE `post_status` SET`likes`=likes+1 WHERE id='$postId' ";

      $runIncreLike = mysqli_query($conn, $increLike);

      if($runIncreLike){
        $insert_like = "INSERT INTO `like_post`(`given_user_id`, `like_post_id`) VALUES ('$given_user_id','$postId')";
        mysqli_query($conn,$insert_like);
      }

    }else{
      $decreLike = "UPDATE `post_status` SET`likes`=likes-1 WHERE id='$postId' ";

      $rundecreLike = mysqli_query($conn, $decreLike);

      if($rundecreLike){
        $delete_like = "DELETE FROM `like_post` WHERE given_user_id='$given_user_id' AND like_post_id='$postId'";
        mysqli_query($conn,$delete_like);
      }
    }


  }


// end php tag
?>





