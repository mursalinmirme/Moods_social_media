<?php
include "dbconnect.php";
session_start();
$userId = $_SESSION['user_id'];
$times = time()+15;
$makeQuery = "UPDATE `users` SET `status`='$times' WHERE user_id='$userId'";

$runMakeQuery = mysqli_query($conn, $makeQuery);

if($runMakeQuery){
    echo "times update successfully";
}

?>