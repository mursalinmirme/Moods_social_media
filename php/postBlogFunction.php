<?php
if(isset($_POST['postBtn'])){
  include 'dbconnect.php';
  $postText = $_POST['postText'];
  $userPostingId = $_POST['userPostingId'];
  $textstring = str_replace(array("\r\n", "\r", "\n"), "<br />", $postText);
  $readyPost = "INSERT INTO `post_status`(`post_id`, `post_text`) VALUES ('$userPostingId','".addslashes($textstring)."')";
  $runPost = mysqli_query($conn, $readyPost);
  if($runPost){
    echo "Post has been created successfully";
  }
  
}
 ?>