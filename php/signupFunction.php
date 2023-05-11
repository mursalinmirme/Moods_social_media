<?php

// echo "post linkd successfully";


if(isset($_POST['signUpBtn'])){
  include 'dbconnect.php';
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rePassword = $_POST['rpassword'];

  //first query input email is has any account before
  $checkEmails = "SELECT * FROM `users` WHERE email = '$email'";
     $runCheckEmails =  mysqli_query($conn, $checkEmails);
        $checkEmailsRows = mysqli_num_rows($runCheckEmails);
          if($checkEmailsRows > 0){
            // if matched databased email with input email......
               echo "This email has been already an account.";
          }
  else{
    $passwordHash = password_hash($rePassword,PASSWORD_DEFAULT);
      $user_id = rand();
         $query = "INSERT INTO `users`(`name`, `user_id`, `email`, `password`) VALUES ('$name','$user_id','$email','$passwordHash')";
            $runQuery = mysqli_query($conn, $query);
              if($runQuery){
                 echo "Registration Successfully";
              }
      }

  }//end if isset condition


  



?>