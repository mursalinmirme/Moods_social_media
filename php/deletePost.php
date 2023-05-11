<?php
if(isset($_POST['deleteBtn'])){
    include "dbconnect.php";
    $deletePostId = $_POST['deletePostid'];
    $deleteQuery = "DELETE FROM `post_status` WHERE id='$deletePostId'";
    $confirmDelete = mysqli_query($conn, $deleteQuery);
    if($confirmDelete){
        echo "Delete successfully";
    }
}

?>