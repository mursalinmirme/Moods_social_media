<?php
if(isset($_POST['updateBtn'])){
    include "dbconnect.php";
    $post_id = $_POST['postId'];
    $update_text = $_POST['updataTxt'];
    $update_text = str_replace(array("\r\n", "\r", "\n"), "<br />", $update_text);
    $makeQuery = "UPDATE `post_status` SET `post_text`='$update_text' WHERE id='$post_id'";
    $runMakeQuery = mysqli_query($conn, $makeQuery);
    if($runMakeQuery){
        echo "Update Successfully.";
       
    }
}

?>