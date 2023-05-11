
<?php


session_start();

// if the user is logged in, unset the session variables and destroy the session
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'success', 'message' => 'User logged out successfully'));
    exit;
 }




?>