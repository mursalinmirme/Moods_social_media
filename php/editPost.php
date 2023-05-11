<?php
// session_start();
// if(!isset($_SESSION['logdin']) || $_SESSION != true){
//   header("location: ../index.php");
//   exit;
// }else if(isset($_SESSION['logdin']) || $_SESSION != true){
//    header("location: home.php");
//    exit;
// }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Canvas_edit_post</title>
<link rel="stylesheet" href="../css/postblog.css">
<script src="https://kit.fontawesome.com/b4df4240c2.js" crossorigin="anonymous"></script>
</head>
<body>
   <!---Top Bar Start--->
   <div class="topbar">
     <div class="topbarWrep">
     <div class="logo">
       <h1><a href="logout.php">Canvas</a></h1>
     </div>
     <div class="profile">
    <!-- <img id="myAvater" src="../photos/avater.png"> -->
     </div>
     </div>
   </div>
  <!---Top bar End--->

<!-- post message shown -->

<!-- php code for posting a status -->
<?php
$postMsg = "";  
  // echo $userPostingId;
if($_SERVER['REQUEST_METHOD'] == "POST"){
  include 'dbconnect.php';
  $postText = $_POST['postText'];

  //make text to dynamic for line breake
  $textstring = str_replace(array("\r\n", "\r", "\n"), "<br />", $postText);


  $userPostingId = $_GET['blog_id'];
  if(empty($postText)){
    $postMsg = "Please wirte something";
  }else{
  $readyPost = "INSERT INTO `post_status`(`post_id`, `post_text`) VALUES ('$userPostingId','$textstring')";
  $runPost = mysqli_query($conn, $readyPost);
  if($runPost){
    $postMsg = "Post has been created successfully";
    header("location: home.php");
  }
  }

}
 ?><!-- php end -->
<!-- <div class="postMsgDiv" id="postMsgDiv">
  <span id="postMsg"><?php if($postMsg){ echo $postMsg; } ?></span>
</div> -->

<!-- --Code for submit Post start-   -->
<div id="postArea" class="postArea">
  <div class="paTopBar">
    <div class="paBackIcon">
       <!-- <i id="postAreaPgBtn" class="fa fa-arrow-left"></i> -->
    </div>
    <div class="paTopTitle">
      <span>Edit Post</span>
    </div>
  </div>
  
  <div class="paTexArea">
  <?php
              include "dbconnect.php";
              $profileUserId = $_GET['user_id'];
              $mkQuery = "SELECT * FROM `users` WHERE user_id = $profileUserId";
              $runMkQuery = mysqli_query($conn, $mkQuery);
              while($catchUid = mysqli_fetch_assoc($runMkQuery)){
                $userUid = $catchUid['profile_pic'];
                $userUidName = $catchUid['name'];
              }
            ?>
   <div class="paTexAreaProfil">
    <div class="postImage">
        <img src="../upload/<?php echo $userUid; ?>">
      </div>
      <div class="pstTitle">
       <h3><?php echo $userUidName; ?></h3>
      </div>
      
   </div>   
 
  <?php
    $postId = $_GET['post_id'];
    // echo $postId;
    $query = "SELECT * FROM `post_status` WHERE id='$postId'";
    $runQuery = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($runQuery)){
      $catchText = $row['post_text'];
      
    }

  ?>
 <div class="postText">
   <div class="postTextCon">
   <form action="" method="POST">
     <textarea id="postText" name=""><?php echo str_replace("<br />","\n",$catchText); ?></textarea>
     <input id="editBtn" type="submit" name="<?php echo $_GET['post_id']; ?>" value="Save Edit">
   </form>
   </div>
 </div>  
   
   
  </div>
  
</div>
 
<!----Code for submit Post end---> 
<!----Code for submit Post end--->  
</body>
<script src="../javascript/jquery-3.6.3.min.js"></script>
<script src="../javascript/editPost.js"></script>
<script type="text/javascript">
  $("document").ready(function(){
    $("#editBtn").click(function(e){
      e.preventDefault();
      // $.ajax({
      //   url: "edit_post_status.php",
      //   type: "POST",
      //   success: function(data){
      //     alert(data)
      //   }
      // });
      var updataTxt = $("#postText").val();
      var postId = $(this).attr('name');
      $.post("edit_post_status.php",{updataTxt:updataTxt,postId:postId,updateBtn:"updateBtn"},function(data){
        alert(data);
        window.location.href = 'home.php';
      })
      
    })
    
  })
</script>
</html>
