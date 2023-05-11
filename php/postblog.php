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
<title>Welcome to MoodShare</title>
<link rel="stylesheet" href="../css/postblog.css">
<script src="https://kit.fontawesome.com/b4df4240c2.js" crossorigin="anonymous"></script>
</head>
<body>
   <!---Top Bar Start--->
   <div class="topbar">
     <div class="topbarWrep">
     <div class="logo">
       <h1><a href="logout.php">Moods</a></h1>
     </div>
     <div class="profile">
    <!-- <img id="myAvater" src="../photos/avater.png"> -->
     </div>
     </div>
   </div>
  <!---Top bar End--->

<!-- post message shown -->

<div style="display:none;" class="postMsgDiv" id="postMsgDiv">
  <span id="postMsg">Post has been upload successfully</span>
</div>

<!-- --Code for submit Post start-   -->
<div id="postArea" class="postArea">
  <div class="paTopBar">
    <div class="paBackIcon">
       <!-- <i id="postAreaPgBtn" class="fa fa-arrow-left"></i> -->
    </div>
    <div class="paTopTitle">
      <span>Let's Make a Post</span>
    </div>
  </div>
  
  <div class="paTexArea">
  <?php
    include "dbconnect.php";
    $profileUserId = $_GET['blog_id'];
    $mkQuery = "SELECT * FROM `users` WHERE user_id = $profileUserId";
    $runMkQuery = mysqli_query($conn, $mkQuery);
    while($catchUid = mysqli_fetch_assoc($runMkQuery)){
      $userUid = $catchUid['profile_pic'];
      $userUidName = $catchUid['name'];
      if($userUid == "avater.png"){
        $modifyUserImg = "../photos/avater.png";
      }else{
        $modifyUserImg = "../upload/$userUid";
      }
    }
  ?>
   <div class="paTexAreaProfil">
    <div class="postImage">
        <img src="<?php echo $modifyUserImg; ?>">
      </div>
      <div class="pstTitle">
       <h3><?php echo $userUidName; ?></h3>
      </div>
      
   </div>   
 
  
 <div class="postText">
   <div class="postTextCon">
   <form action="" method="POST">
     <textarea id="postText" name="postText" placeholder="Shere something for others..."></textarea>
     <input id="postBtn" type="submit" name="<?php echo $profileUserId; ?>" value="POST">
   </form>
   </div>
 </div>  
   
   
  </div>
  
</div>
<!----Code for submit Post end---> 
<!----Code for submit Post end--->  
</body>
<script src="../javascript/jquery-3.6.3.min.js"></script>
<script src="../javascript/postBlog.js"></script>
</html>



