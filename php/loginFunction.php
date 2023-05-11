<?php

$loginSuccess = "yes";
if(isset($_POST['loginBtn'])){
    include "dbconnect.php";
    $loginEmail = $_POST['email'];
    $loginPassword = $_POST['password'];
    

    $matchEmail = "SELECT * FROM `users` WHERE email = '$loginEmail'";

    $runMatchEmail = mysqli_query($conn, $matchEmail);

        if(mysqli_num_rows($runMatchEmail) > 0){
            // echo "email matched";
            while($row = mysqli_fetch_assoc($runMatchEmail)){
                // echo $row['password'];
                $myUserId = $row['user_id'];
                if(password_verify($loginPassword, $row['password'])){
                    session_start();
                    $_SESSION['logdin'] = true;
                    $_SESSION['user_id'] = $row['user_id'];
                    $times = time()+15;
                    $statusmakeQuery = "UPDATE `users` SET `status`='$times' WHERE user_id='$myUserId'";
                    mysqli_query($conn, $statusmakeQuery);
                    echo "Login successfully";
                }else{
                    echo "Password does not matched";
                }
            }
        }else{
            echo "Email & Password does not matched";
        }

    }



?>