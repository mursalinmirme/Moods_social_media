<?php
session_start();
if(!isset($_SESSION['logdin']) || $_SESSION != true){
  header("location: ../index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome <?php echo $_SESSION['user_id']; ?> to Amar Kabbo</title>
<link rel="stylesheet" href="../css/profile.css">
<script src="https://kit.fontawesome.com/6d208b1cbc.js" crossorigin="anonymous"></script>
</head>
<body>
 <div id="container" class="container">
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
    
       
<!----Code for Profile making start--->  
<div id="userProfile" class="userProfile">
  <div class="proTopBar">
    <!-- <div class="backIcon">
      <i id="proBackBtn" class="fa fa-arrow-left"></i>
       </div> -->
  </div><!---End backIcon tag--->
  <?php
        
        include 'dbconnect.php';

        $catchUserId = $_GET['user_id'];

        //  echo $catchUserId;

        $getName = "SELECT * FROM `users` WHERE user_id = '$catchUserId' ";

        $runGetName = mysqli_query($conn, $getName);
        if($runGetName){
          while($getName = mysqli_fetch_assoc($runGetName)){
            $userName = $getName['name'];
            $profileImg = $getName['profile_pic'];
            $followersNumber = $getName['followers'];
            if($profileImg == "avater.png"){
              $modifyprofileImg = "../photos/avater.png";
            }else{
              $modifyprofileImg = "../upload/$profileImg";
            }
          }
        }
   

        // echo  $userName;

       $thisUserId = $_SESSION['user_id'];


      ?>
  <div class="profileDesc">
    <div class="proDescWrep">
      
      <div class="proImg">
         <img src="<?php echo $modifyprofileImg; ?>">
             </div>
      <div class="proName">

         <h1><?php echo $userName; ?></h1>
             </div>       

      <div class="followBtn" name="<?php echo $thisUserId; ?>">
        <button class="follow_btn" name="<?php echo $catchUserId ?>" type="submit">

        <?php
            //this code write showing followin btn current status
            $matchQuery = "SELECT `follow_id`, `follower_id` FROM `following` WHERE follow_id='$catchUserId' AND follower_id='$thisUserId'";

            $runmatchQuery = mysqli_query($conn, $matchQuery);

            if(mysqli_num_rows($runmatchQuery) == "1"){
                $currentStatus = "Following";
            }else if(mysqli_num_rows($runmatchQuery) == "0"){
              $currentStatus = "Follow";
            }
            //this code write showing followin btn current status

            ?><!--- end --->
            <span class="followerStatus"><?php echo $currentStatus; ?></span>
              
            <i class="fa-solid fa-rss"></i>
        </button>
      </div>       

      <div class="flwLkComWrep">
        
        <div class="followdiv">
          <div class="flwdivwrep">
            <div class="flwTitle">
              <span>Followers</span>
            </div>
           <div class="numFlwer">

             <p class="countFollowers"><?php echo $followersNumber; ?></p> 

           </div>
           
          </div>
        </div>
        <div class="followdiv">
          <div class="flwdivwrep">
            <div class="flwTitle">
              <span>Total_Likes</span>
            </div>
           <div class="numFlwer">
             <p>
              <?php 
                $myPostsLike = "SELECT SUM(likes) AS sum FROM `post_status` WHERE post_id='$catchUserId'";
                  $runmyPostsLike = mysqli_query($conn, $myPostsLike);
                while($catchmyPostsLike = mysqli_fetch_assoc($runmyPostsLike)){
                $resultmyPostsLike = $catchmyPostsLike['sum'];
                if($resultmyPostsLike == null){
                  echo '0';
                }else{
                echo $resultmyPostsLike;
                }
              }
              ?>
              </p> 
           </div>
          </div>
        </div>
         
      </div>
      
    </div><!---End proDescWrep tag--->
    
    
    
    
  </div><!---End profileDesc tag--->
 
 

  <!---Make post data end--->
<div class="myAllPostWrep">
<?php

function time_ago($timestamp)
{
        $time_ago = strtotime($timestamp) - 17970;
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes = round($seconds / 60);           // value 60 is seconds (60 sec in 1 min)
        $hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
        $days = round($seconds / 86400);          //86400 = 24 * 60 * 60;
        $weeks = round($seconds / 604800);          // 7*24*60*60;
        $months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
        $years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
        if ($seconds <= 60) {
            return "just_now";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 " . "minute_ago";
            } else {
                return "$minutes " . "minutes_ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "1 " . "hour_ago";
            } else {
                return "$hours " . "hours_ago";
            }
        } else if ($days <= 30) {
            if ($days == 1) {
                return "1 " . "day_ago";
            } else {
                return "$days " ."days_ago";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "1 " ."month_ago";
            } else {
                return "$months " . "months_ago";
            }
        } else {
            if ($years == 1) {
                return "1 " ."year_ago";
            } else {
                return "$years " ."years_ago";
            }
        }
    }

// echo(time_ago('2023-01-26 00:00:00'));


?>

<?php
// php code for givs like and unlike posts
function like_userpost(){
  include "dbconnect.php";
  if(isset($_POST['liketwo'])){
    $postId = $_POST['hidden_id'];
    $given_user_id = $_GET['user_id'];

    $check_like = "SELECT `given_user_id`, `like_post_id` FROM `like_post` WHERE given_user_id='$given_user_id' AND like_post_id='$postId';";

    $runCheckLike = mysqli_query($conn, $check_like);

    if(mysqli_num_rows($runCheckLike) == 0){

      $increLike = "UPDATE `post_status` SET`likes`=likes+1 WHERE id='$postId' ";

      $runIncreLike = mysqli_query($conn, $increLike);

      if($runIncreLike){
        $insert_like = "INSERT INTO `like_post`(`given_user_id`, `like_post_id`) VALUES ('$given_user_id','$postId')";
        $run_insertLike = mysqli_query($conn,$insert_like);

      }

    }else{
      $decreLike = "UPDATE `post_status` SET`likes`=likes-1 WHERE id='$postId' ";

      $rundecreLike = mysqli_query($conn, $decreLike);

      if($rundecreLike){
        $delete_like = "DELETE FROM `like_post` WHERE given_user_id='$given_user_id' AND like_post_id='$postId'";
        $run_insertLike = mysqli_query($conn,$delete_like);

      }
    }


  }
}//end like_post function
like_userpost();
// include "home.php";
$catch_userid = $_GET['user_id'];
//  $catchUserId = $_SESSION['user_id'];
$myPostsQuery = "SELECT * FROM `post_status` WHERE post_id= '$catch_userid' ORDER BY id DESC";

$runMyPstQry = mysqli_query($conn, $myPostsQuery);

while($catchMyPostsId = mysqli_fetch_assoc($runMyPstQry)){
  $postIdno = $catchMyPostsId['id'];
  $myPostsTexts = $catchMyPostsId['post_text'];
  $myPostsAgo = $catchMyPostsId['post_time'];
  $profileLikes = $catchMyPostsId['likes'];
  $profileComments = $catchMyPostsId['comments'];

?><!--- end --->


<?php
  //this code write for showing liked postes start
  $givnUserId = $_SESSION['user_id'];
  $check_liked = "SELECT `given_user_id`, `like_post_id` FROM `like_post` WHERE given_user_id='$givnUserId' AND like_post_id='$postIdno'";
  
  $runCheckLiked = mysqli_query($conn, $check_liked);
  
  if(mysqli_num_rows($runCheckLiked) == "1"){
      $currentImg = "../photos/like2.png";
  }else if(mysqli_num_rows($runCheckLiked) == "0"){
    $currentImg = "../photos/like1.png";
  }
  //end checked liked function
  //this code write for showing liked postes end

  ?><!--- end --->

<?php  

  $myPostsId = "SELECT * FROM `users` WHERE user_id= '$catch_userid'";
  $runmyPostsId = mysqli_query($conn, $myPostsId);
  while($catchpostsDesc = mysqli_fetch_assoc($runmyPostsId)){
    $userName = $catchpostsDesc['name'];
    $userImg = $catchpostsDesc['profile_pic'];
    if($userImg == "avater.png"){
      $modifyuserImg = "../photos/avater.png";
    }else{
      $modifyuserImg = "../upload/$userImg";
    }
     $mypostsTime = time_ago($myPostsAgo);

  ?><!--- end --->

  <!-----start Post status--->   
  <div id="postdata">
   <div class="postdataWrep">
     <div class="posttop">
       <div class="profilego">
         <a href="#">
           <img src="<?php echo $modifyuserImg;?>" alt=""/>
           </a>
           </div>
   
 <div class="nameanddetails">
   <h1><?php echo $userName; ?></h1>
      <p><?php echo $mypostsTime;?></p>
        </div>
 <div class="postmenu">
   <a href="#">
     <i class="fas fa-ellipsis-h"></i>
      </a>
        </div>
 </div>
 
 <div class="statusbar">
 <h2 class="textStatuss">

  <?php
  
  if(strlen($myPostsTexts) > 400){
    echo substr($myPostsTexts,0,450)."..."."<span class='readMoreBtn' name='$myPostsTexts'>Read_more</span>";
  }else{
    echo $myPostsTexts;
  }
  
  ?>

</h2>
 </div>
 
 <div class="lkandcombox">
    <div class="lvLgandlklgwrp">
 <div class="likenumber">
   <p><span class="likesNum"><?php echo $profileLikes; ?></span> Likes</p>
     </div>
 <div class="comntsnumber">
   <h3 class="countComment"><span class="countComment"><?php echo $profileComments; ?></span> Comments</h3>
     </div>
 </div>
 <div class="likecommentsherebar">
    <div class="likecontainer">
 <div class="likel">
 <button class="likeBtnPro" type="submit" name="liketwo" title="<?php echo $postIdno; ?>">
   <img class="likeimg" src="<?php echo $currentImg; ?>">
   </button>
     </div>

     <div class="commentl">
     <button class="commentBtn">
     <img src="../photos/comment.png">
     </button>
   </div>

 </div>
 </div>
 </div>
 <!--- this html code write for comment box start --->

  <div class="commentBox">
     <div class="commentInputWrap">
        <div class="commentMyPic">
        <?php
          $catchThisId = $_SESSION['user_id'];
          $commentPostPic = "SELECT * FROM `users` WHERE user_id='$catchThisId'";
          $runCommentImg = mysqli_query($conn, $commentPostPic);
          while($catchCommentPic = mysqli_fetch_assoc($runCommentImg)){
            $catchPic = $catchCommentPic['profile_pic'];
          }
        ?>
           <img src="../upload/<?php echo $catchPic; ?>" alt="">
        </div>
        <div class="commentInput">
           <input type="text" class="postComment" name="<?php echo $postIdno; ?>" placeholder="Write a comment...">
        </div>
     </div>

    <div class="showComment">

<?php 

  //this code for showing comments
  $showComments = "SELECT * FROM `comment` WHERE post_id = '$postIdno' ORDER BY comment_id DESC";
  $runShowComments = mysqli_query($conn, $showComments);
  while($fetchComments = mysqli_fetch_assoc($runShowComments)){
  $commentsText = $fetchComments["comment_text"];
  $commentUserId = $fetchComments['comment_userid'];

  //showing comments profile picture
  $commentPic = "SELECT * FROM `users` WHERE user_id = '$commentUserId'";
  $runCommentPic = mysqli_query($conn, $commentPic);
  while($catchProfile = mysqli_fetch_assoc($runCommentPic)){
  $viewProfile = $catchProfile['profile_pic'];

      echo '<div class="singleComment">
          <div class="singleCommentWrap">
              <div class="commentPic">
                  <img src="../upload/'.$viewProfile.'" alt="">
              </div>
              <div class="commentText">
                  <div class="commentName">
                      <p>John Doe</p>
                      <span>'.$commentsText.'</span>
                  </div>
                  <div class="commentMenu">
                      <i class="fas fa-ellipsis-v"></i>
                  </div>
              </div>
          </div>
      </div>';

  }//end comments profile pictures

 } ?><!---end showing comments while loop brackets--->

     </div>
  </div>

<!--- this html code write for comment box end --->
 </div>
 </div>
  <!-----end Post status--->  




<?php } ?> <!-- end secound while loop -->


 <?php } ?><!-- end first while loop -->

  
 
</div><!---End for myAllPostWrep tag--->   
  
</div><!---End myProfilePost tag----> 

</div><!---End userProfile tag--->    
     
<!----Code for Profile making end--->    

<!----Code for submit Post end--->  



</body>
<script src="../javascript/jquery-3.6.3.min.js"></script>
<script src="../javascript/home.js"></script>
<script src="../javascript/profile.js"></script>

<script type="text/javascript">
$(".showlessbtn").click(function(){
  console.log("hi");
})
</script>  


</html>
