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
<?php
if(isset($_POST['follow_btn'])){

include "dbconnect.php";

$followId = $_POST['followId'];

$followerId = $_POST['followerId'];

$matchQuery = "SELECT `follow_id`, `follower_id` FROM `following` WHERE follow_id='$followId' AND follower_id='$followerId'";

$runMatchQuery = mysqli_query($conn, $matchQuery);

if(mysqli_num_rows($runMatchQuery) == 1){

    $deleteFollowers = "DELETE FROM `following` WHERE `follow_id`='$followId' AND `follower_id`='$followerId'";

    $runDltFollowers = mysqli_query($conn, $deleteFollowers);

    if($runDltFollowers){
        $decFollower = "UPDATE `users` SET `followers`=followers-1 WHERE user_id='$followId'";
        $rundecFollower = mysqli_query($conn, $decFollower);
        if($rundecFollower){
            echo "Follow";
        }//end rundecFollower brackets

    }//end runDltFollowers brackets
    }else if(mysqli_num_rows($runMatchQuery) == 0){
    $insertFollow = "INSERT INTO `following`(`follow_id`, `follower_id`) VALUES ('$followId','$followerId')";
    $runFollowing = mysqli_query($conn, $insertFollow);
    if($runFollowing){
        echo "Following";
        $incFollower = "UPDATE `users` SET `followers`=followers+1 WHERE user_id='$followId'";
        $runIncFollowers = mysqli_query($conn, $incFollower);
    }//end runFollowing brackets
}//if my sqli num rows == 0 condition end brackets



}//end post method scarly bracket


?>