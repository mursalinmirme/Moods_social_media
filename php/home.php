<!-- This code written by Mursalin Mir -->
<?php
session_start();
if(!isset($_SESSION['logdin']) || $_SESSION != true){
  header("location: ../index.php");
  exit;
}
?>
    <?php
        
        include 'dbconnect.php';

        $catchUserId = $_SESSION['user_id'];

        //  echo $catchUserId;

        $getName = "SELECT * FROM `users` WHERE user_id = '$catchUserId' ";

        $runGetName = mysqli_query($conn, $getName);
        if($runGetName){
          while($getName = mysqli_fetch_assoc($runGetName)){
            $userName = $getName['name'];
            $userImage = $getName['profile_pic'];
            $userFollowers = $getName['followers'];
            if($userImage == "avater.png"){
              $modifyUserImg = "../photos/avater.png";
            }else{
              $modifyUserImg = "../upload/$userImage";
            }
          }
        }
   

        // echo  $userName;

      ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome <?php echo $_SESSION['user_id']; ?> to Amar Kabbo</title>
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../css/loading.css">
<script src="https://kit.fontawesome.com/6d208b1cbc.js" crossorigin="anonymous"></script>
</head>
<body>
 <div id="container" class="container">
   <!---Top Bar Start--->
   <div class="topbar">
     <div class="topbarWrep">
     <div class="logo">
       <h1><a href="">Moods</a></h1>
     </div>
     <div class="profile">
    <i id="myAvater" class="fa-solid fa-bars"></i>
     </div>
     </div>
   </div>
  <!---Top bar End--->
  
  
  <div class="contentArea">
    
 <!-----start Post status--->   

<!-- php code for ago post time count -->

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

include "dbconnect.php";

$catchAllPost = "SELECT * FROM `post_status` ORDER BY id DESC";

$queryCatchPost = mysqli_query($conn, $catchAllPost);

while($allPost = mysqli_fetch_assoc($queryCatchPost)){
  $singlePostid = $allPost['id'];
  $userid = $allPost['post_id'];
  $userposttext = $allPost['post_text'];
  $userpostTime = $allPost['post_time'];
  $likes = $allPost['likes'];
  $comments = $allPost['comments'];
  
// echo $userpostTime;

?><!--- end of php code --->


<?php
//this code write for showing liked postes start
  $givnUserId = $_SESSION['user_id'];
  $check_liked = "SELECT `given_user_id`, `like_post_id` FROM `like_post` WHERE given_user_id='$givnUserId' AND like_post_id='$singlePostid';";
  
  $runCheckLiked = mysqli_query($conn, $check_liked);
  
  if(mysqli_num_rows($runCheckLiked) == "1"){
      $currentImg = "../photos/like2.png";
  }else if(mysqli_num_rows($runCheckLiked) == "0"){
    $currentImg = "../photos/like1.png";
  }
  //end checked liked function
  //this code write for showing liked postes end

?><!--- end of php code --->

<?php
// this php code for fetching bolog with show id
$catchAllPost = "SELECT * FROM `users` WHERE user_id='$userid'";
$queryMatchId = mysqli_query($conn, $catchAllPost);
while($blogRow = mysqli_fetch_assoc($queryMatchId)){
  $blogIdOwner = $blogRow['name'];
  $userProfile = $blogRow['profile_pic'];
  $userProfileId = $blogRow['user_id'];
  if($userProfile == "avater.png"){
    $modifyProfileUserImage = "../photos/avater.png";
  }else{
    $modifyProfileUserImage = "../upload/$userProfile";
  }
// call time ago function
$postTime = time_ago($userpostTime);
// echo $postTime;

?><!---end of php code--->


  <div id="postdata">
  <div class="postdataWrep">
    <div class="posttop">
      <div class="profilego">
        <a href="profile.php?user_id=<?php echo $userProfileId;?>">
          <img src="<?php echo $modifyProfileUserImage;?>">
          </a>
          </div>
  
<div class="nameanddetails">
  <h1><a href="profile.php?user_id=<?php echo $userProfileId; ?>"><?php echo $blogIdOwner; ?></a></h1>
     <p><?php echo $postTime;?></p>
       </div>
<div class="postmenu">
  <a href="#">
    <i class="fas fa-ellipsis-h"></i>
     </a>
       </div>
</div>

<div class="statusbar">
<h2 class="statusTexts">
  <?php 
  if(strlen($userposttext) > 400){
    echo substr($userposttext,0,450)."..."."<span class='readMoreBtn' name='$userposttext'>Read_more</span>";
  }else{
    echo $userposttext;
  }
  ?>
</h2>
</div>

    <div class="lkandcombox">
      <div class="lvLgandlklgwrp">

          <div class="likenumber">
            <p><span class="likesNum"><?php echo $likes; ?></span> Likes</p>
          </div>

          <div class="comntsnumber">
            <h3 class="countComment" name="<?php echo $singlePostid; ?>"><span class="countComment"><?php echo $comments; ?></span> Comments</h3>
          </div>

      </div>

      <div class="likecommentsherebar">

          <div class="likecontainer">

            <div class="likel">
                <button type="submit" id="likeBtn" class="likeBtn" name="<?php echo $singlePostid;?>">
                <img class="likeimg" src="<?php echo $currentImg;?>">
                </button>
            </div>

            <div class="commentl">
              <button class="commentBtn" name="<?php echo $singlePostid;?>">
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
          $commentPostImg = "SELECT * FROM `users` WHERE user_id='$givnUserId'";
          $runCommentImg = mysqli_query($conn, $commentPostImg);
          while($catchCommentPic = mysqli_fetch_assoc($runCommentImg)){
            $catchPic = $catchCommentPic['profile_pic'];
            if($catchPic == "avater.png"){
              $modifycatchPic = "../photos/avater.png";
            }else{
              $modifycatchPic = "../upload/$catchPic";
            }
          }
        ?>
           <img src="<?php echo  $modifycatchPic; ?>" alt="">
        </div>
        <div class="commentInput">
           <input type="text" class="postComment" name="<?php echo $singlePostid; ?>" placeholder="Write a comment...">
        </div>
     </div>
    <div class="showComment">

<?php
//this code for showing comments
$showComments = "SELECT * FROM `comment` WHERE post_id = '$singlePostid' ORDER BY comment_id DESC";
$runShowComments = mysqli_query($conn, $showComments);
while($fetchComments = mysqli_fetch_assoc($runShowComments)){
  $commentsText = $fetchComments['comment_text'];
  $commentUserId = $fetchComments['comment_userid'];
  
  ?>
    <?php
        //showing comments profile picture
        $commentPic = "SELECT * FROM `users` WHERE user_id = '$commentUserId'";
        $runCommentPic = mysqli_query($conn, $commentPic);
        while($catchProfile = mysqli_fetch_assoc($runCommentPic)){
        $commentName = $catchProfile['name'];
        $viewProfile = $catchProfile['profile_pic'];
        if($viewProfile == "avater.png"){
          $modifyviewProfile = "../photos/avater.png";
        }else{
          $modifyviewProfile = "../upload/$viewProfile";
        }
        ?>


      <div class="singleComment">
          <div class="singleCommentWrap">
              <div class="commentPic">
                  <img src="<?php echo $modifyviewProfile; ?>" alt="">
              </div>
              <div class="commentText">
                  <div class="commentName">
                      <p><?php echo $commentName; ?></p>
                      <span><?php echo $commentsText;?></span>
                  </div>
                  <div class="commentMenu">
                      <i class="fas fa-ellipsis-v"></i>
                  </div>
              </div>
          </div>
      </div>
      <?php } ?>
<?php } ?><!---end showing comments while loop brackets--->

     </div>
  </div>

<!--- this html code write for comment box end --->


</div>
</div> 
<?php } ?><!---end blogRow while loops--->
<?php } ?><!---end while loop for showing blog--->
   
<!-----end Post status--->   

</div><!---End contentarea tag ---->  
</div><!---End Container tag --->  
    
<!-- this code for active users list start -->
<!-- this code for active users list start -->
<div style="" class="usersList">
<div class="backIcon">
      <i id="activePageBackBtn" class="fa fa-arrow-left"></i>
       </div>
  <div class="usListTopbar">
    <h3>The Moods community</h3>
  </div>


  <div class="activeUsers">
     <div class="activeUsersWrap">

      <?php
        $allUsers = "SELECT * FROM `users`";
        $runAllUsers = mysqli_query($conn, $allUsers);
          ?>
         <?php 
          while($getData = mysqli_fetch_assoc($runAllUsers)){ 
            $listUsername = $getData['name'];
            $listUserImage = $getData['profile_pic'];
            $listUserId = $getData['user_id'];
            $listUserStatus = $getData['status'];
            if($listUserImage == "avater.png"){
              $modifylistUserImage = "../photos/avater.png";
            }else{
              $modifylistUserImage = "../upload/$listUserImage";
            }
            //code for showing user status
            if($listUserStatus > time()){
              $userStatus = 'userActive';
            }else{
              $userStatus = 'userInActive';
            }

            ?>
            
            <div class="singleUsersList">
              <div class="singleUsersListWrap">

              <img src="<?php echo $modifylistUserImage;?>" alt="">

              <p><a href="profile.php?user_id=<?php echo $listUserId;?>"><?php echo $listUsername; ?></a></p>    
              <span class="<?php echo $userStatus; ?>"></span>   
            </div>
            </div>
        <?php  } ?>


       </div>
  </div>

</div>    
<!-- this code for active users list end-->
<!-- this code for active users list end-->

<!----Code for Profile making start--->  
<div style="" id="userProfile" class="userProfile">
  <div class="proTopBar">
    <div class="backIcon">
      <i id="proBackBtn" class="fa fa-arrow-left"></i>
       </div>
  </div><!---End backIcon tag--->
  
  <div class="profileDesc">
    <div class="proDescWrep">
    
      <div class="proImg">
         <img src="<?php echo $modifyUserImg;?>">
          <label class="upload" id="upload">
            <a href="uploadPic.php?profile_userid=<?php echo $catchUserId; ?>">
            <i class="fa-solid fa-camera"></i>
            </a></label>
             </div>
      <div class="proName">

         <h1 id="userName"><?php echo $userName; ?></h1>
             </div>       
      <div class="flwLkComWrep">
        
        <div class="followdiv">
          <div class="flwdivwrep">
            <div class="flwTitle">
              <span>Followers</span>
            </div>
           <div class="numFlwer">
             <p class="countMyFollowrs"><?php echo $userFollowers; ?></p> 
           </div>
           
          </div>
        </div>
        <div class="followdiv">
          <div class="flwdivwrep">
            <div class="flwTitle">
              <span>Likes</span>
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
 
 
<div class="myProfilePost">
  <!---Make post data start--->
  <div class="makePostArea">
    
    <div class="mkPostTop">
      <div class="mkPostTitle">
        <h1>Posts</h1>
         </div>
    </div>
    
    <div class="mkPost">
      <div class="postImage">
        <img src="<?php echo $modifyUserImg;?>">
      </div>
      <div class="pstTitle">
        <span>Let's Make a Post...</span>
      </div>
    </div>
    
   <div class="makePostBtn">
     <button id="makePostBtn"><a href="postblog.php?blog_id=<?php echo $catchUserId; ?>">Make a post</a></button>
   </div> 
    
  </div>
  <!---Make post data end--->
<div class="myAllPostWrep">
  
<!-----start Post status--->   

<?php
$myProfileId = $_SESSION['user_id'];

$myPostsQuery = "SELECT * FROM `post_status` WHERE post_id= '$myProfileId' ORDER BY id DESC";

$runMyPostsQuery = mysqli_query($conn, $myPostsQuery);

while($myAllPhosts = mysqli_fetch_assoc($runMyPostsQuery)){
  $mysinglePostid = $myAllPhosts['id'];
  $myUserId = $myAllPhosts['post_id'];
  $myUserPostsText = $myAllPhosts['post_text'];
  $myPostsTimeAgo = $myAllPhosts['post_time'];
  $myPhostsLikes = $myAllPhosts['likes'];
  $myPhostsComments = $myAllPhosts['comments'];
  //post time count
  $mypostsTime = time_ago($myPostsTimeAgo);
  
  $checkdMy_liked = "SELECT `given_user_id`, `like_post_id` FROM `like_post` WHERE given_user_id='$myProfileId' AND like_post_id='$mysinglePostid'";
  
  $runMyCheckLiked = mysqli_query($conn, $checkdMy_liked);
  
  if(mysqli_num_rows($runMyCheckLiked) == "1"){
      $myPostscurrentImg = "../photos/like2.png";
  }else if(mysqli_num_rows($runMyCheckLiked) == "0"){
    $myPostscurrentImg = "../photos/like1.png";
  }

  ?>
<?php
//showing my posts name profile and id
$catchMyAllPosts = "SELECT * FROM `users` WHERE user_id='$myUserId'";
$runCatchMyAllPosts = mysqli_query($conn, $catchMyAllPosts);
while($myBlogRow = mysqli_fetch_assoc($runCatchMyAllPosts)){
  $myBlogIdOwner = $myBlogRow['name'];
  $myUserProfile = $myBlogRow['profile_pic'];
  $myUserProfileId = $myBlogRow['user_id'];
  if($myUserProfile == "avater.png"){
    $modifymyUserProfile = "../photos/avater.png";
  }else{
    $modifymyUserProfile = "../upload/$myUserProfile";
  }
?>


<!-- php code for ago post time count -->

<div id="postdata">
  <div class="postdataWrep">
    <div class="posttop">
      <div class="profilego">
        <a href="profile.php?user_id=<?php echo $myUserId; ?>">
          <img src="<?php echo $modifymyUserProfile; ?>">
          </a>
          </div>
  
<div class="nameanddetails">
  <h1><a href="profile.php?user_id=<?php echo $myUserId; ?>"><?php echo $myBlogIdOwner; ?></a></h1>
     <p><?php echo $mypostsTime; ?></p>
       </div>
<div class="postmenu">
  <span class="myPostsSingleMenuBtn" id="myPostsSingleMenuBtn">
    <i class="fas fa-ellipsis-h"></i>
      </span>
       </div>
       
  <div class="postOption">
    <ul>
      <li><a href="editPost.php?user_id=<?php echo $myUserId; ?>&post_id=<?php echo $mysinglePostid; ?>">Edit Post</a></li>
      <li class="proPagination"><a class="delete_post" name="<?php echo $mysinglePostid; ?>" href="#">Delete Post</a></li>
    </ul>
  </div>     
</div>

<div class="statusbar">
<h2 class="mystatusTexts"><?php 
  if(strlen($myUserPostsText) > 400){
    echo substr($myUserPostsText,0,400)."..."."<span class='readMoremyPost' name='$myUserPostsText'>Read_more</span>";
  }else{
    echo $myUserPostsText;
  }
  ?></h2>
</div>

    <div class="lkandcombox">
      <div class="lvLgandlklgwrp">

          <div class="likenumber">
            <p><span class="likesNum"><?php echo $myPhostsLikes; ?></span> Likes</p>
          </div>

          <div class="comntsnumber">
            <h3 class="countComment" name="'.$mysinglePostid.'"><span class="countComment"><?php echo $myPhostsComments; ?></span> Comments</h3>
          </div>

      </div>

      <div class="likecommentsherebar">

          <div class="likecontainer">

            <div class="likel likelMyProfile">
                <button type="submit" id="likeBtn" class="likeBtn" name="<?php echo $mysinglePostid; ?>">
                <img class="likeimg" src="<?php echo $myPostscurrentImg; ?>">
                </button>
            </div>

            <div class="commentl commentlMyProfile">
              <button class="commentBtn" name="">
              <img src="../photos/comment.png">
              </button>
            </div>

          </div>

      </div>

    </div>

<!--- this html code write for comment box start --->

  <div class="commentBox">
     <div class="commentInputWrap">
        <div class="commentMyPic commentPicMyPro">
           <img src="<?php echo $modifymyUserProfile; ?>" alt="">
        </div>
        <div class="commentInput commentInputMyPro">
           <input type="text" class="postCommentMyPro" name="<?php echo $mysinglePostid; ?>" placeholder="Write a comment...">
        </div>
     </div>
    <div class="showComment">
  <?php
  //this code for showing comments
  $showMyComments = "SELECT * FROM `comment` WHERE post_id = '$mysinglePostid' ORDER BY comment_id DESC";
  $runShowMyComments = mysqli_query($conn, $showMyComments);
  while($fetchMyComments = mysqli_fetch_assoc($runShowMyComments)){
  $myCommentsText = $fetchMyComments['comment_text'];
  $myCommentUserId = $fetchMyComments['comment_userid'];

  ?>

  <?php 
    //showing comments profile picture
    $myCommentPic = "SELECT * FROM `users` WHERE user_id = '$myCommentUserId'";
    $runMyCommentPic = mysqli_query($conn, $myCommentPic);
    while($catchmypProfile = mysqli_fetch_assoc($runMyCommentPic)){
    $viewMypProfile = $catchmypProfile['profile_pic'];
    $viewMypostsCommentName = $catchmypProfile['name'];
    if($viewMypProfile == "avater.png"){
      $modifyviewMypProfile = "../photos/avater.png";
    }else{
      $modifyviewMypProfile = "../upload/$viewMypProfile";
    }
    ?>

      <div class="singleComment">
          <div class="singleCommentWrap">
              <div class="commentPic">
                  <img src="<?php echo $modifyviewMypProfile; ?>" alt="">
              </div>
              <div class="commentText">
                  <div class="commentName">
                      <p><?php echo $viewMypostsCommentName; ?></p>
                      <span><?php echo $myCommentsText; ?></span>
                  </div>
                  <div class="commentMenu">
                      <i class="fas fa-ellipsis-v"></i>
                  </div>
              </div>
          </div>
      </div>

<?php } //close showing comment person profile picture ?>
<?php } //close showing comment text loop ?>

     </div>
  </div>
<!--- this html code write for comment box end --->


</div>
</div>

<?php } //end total showing profile name and id loop ?>
<?php } //end total comments fetch loop ?>
   
<!-----end Post status--->





</div><!---End for myAllPostWrep tag--->   
  
</div><!---End myProfilePost tag----> 

</div><!---End userProfile tag--->    
     
<!----Code for Profile making end--->    



<!-- Menu page start -->
<div class="menuPage">
  <ul class="myProfileList">
    <li id="profileBtn"><img src="../photos/avater.png" alt=""><span>Mursain Mir</span></li>
  </ul>
  <ul class="menuServices">
    <li id="activeUsersBtn"><img src="../photos/verified-user.png" alt=""><span>Active users</span></li>
    <li><img src="../photos/programmer.png" alt=""><span>Top follower List</span></li>
    <li><img src="../photos/famous.png" alt=""><span>Top liked person</span></li>
  </ul>
  <ul class="logOutBtnarea">
    <li id="logOutBtn">Log Out</li>
  </ul>
</div>


<!-- Menu page end -->



<!-- loding page start -->
<!-- loding page start -->
<!-- loding page start -->

<div class="loading" id="loading">
    <h2>Loading...</h2>
</div>

<!-- loding page end -->
<!-- loding page end -->
<!-- loding page end -->



</body>
<!-- include jquery files -->
<script src="../javascript/jquery-3.6.3.min.js"></script>
<script src="../javascript/loading.js"></script>
<script src="../javascript/like.js"></script>
<script src="../javascript/comment.js"></script>
<script src="../javascript/postStatusUpdate.js"></script>
<script src="../javascript/deletePost.js"></script>
<script src="../javascript/home.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

  //js code for log out page 
  $("#logOutBtn").click(function(e){
    e.preventDefault();
        $.ajax({
         url: 'logout.php',
         type: 'POST',
         data: { logout: true },
         dataType: 'json',
         success: function(response){
            // handle the response
            if(response.status === 'success'){
               // update the UI with success message
              $(location).attr('href','../index.php');
            } else {
               // update the UI with error message
              alert(response.message);
            }
         },
         error: function(){
            // handle AJAX error
            alert(response.message);
         }
      });

  })

  });//end jquery function

</script>

</html>
