<?php
include "dbconnect.php";
// session_start();
// $userId = $_SESSION['user_id'];
$times = time();
$qmakeQuery = "SELECT * FROM `users`";

$qrunMakeQuery = mysqli_query($conn, $qmakeQuery);
$html = '';
while($qrow = mysqli_fetch_assoc($qrunMakeQuery)){
    $qlistUsername = $qrow['name'];
    $qlistUserImage = $qrow['profile_pic'];
    $qlistUserId = $qrow['user_id'];
    $qlistUserStatus = $qrow['status'];
    if($qlistUserImage == "avater.png"){
        $qimageStatus = "../photos/avater.png";
    }else{
        $qimageStatus = "../upload/$qlistUserImage";
    }
    $quersStatus = '';
    if($qrow['status'] > $times){
        $quersStatus = 'userActive';
       }else{
        $quersStatus = 'userInActive';
       }

    $html = '<div class="singleUsersList"><div class="singleUsersListWrap"><img src="'.$qimageStatus.'" alt=""><p><a href="profile.php?user_id='.$qlistUserId.'">'.$qlistUsername.'</a></p><span class="'.$quersStatus.'"></span></div></div>';
    echo $html;
}

?>