<?php

if(isset($_FILES['my_picture'])){
    session_start();
       $catchProfileId = $_SESSION['user_id'];
         include "dbconnect.php";
           $image_name = $_FILES['my_picture']['name'];
              $image_full_path = $_FILES['my_picture']['full_path'];
                 $image_type = $_FILES['my_picture']['type'];
                    $image_tmp_name = $_FILES['my_picture']['tmp_name'];
                       $image_error = $_FILES['my_picture']['error'];
                           $image_size = $_FILES['my_picture']['size'];

    $exFile = pathinfo($image_name, PATHINFO_EXTENSION);
       $uploadFile = "../upload/".$image_name;
          // echo $catchProfileId;
              if($image_error === 0){
                // print_r("write  image selected");

                    if($exFile == 'jpg' || $exFile == 'jpeg' || $exFile == 'png'){
                       // echo "Condition Matched";
                            move_uploaded_file($image_tmp_name,$uploadFile);
                               $updateProfile = "UPDATE `users` SET `profile_pic`='$image_name' WHERE user_id = '$catchProfileId' ";

                                 if(mysqli_query($conn, $updateProfile)){
                                       echo "Profile Picture updated successfylly";
                                          }; 

                    }        
                    else{
                         // echo "file extension did not matched";
                            }
              }
                else{
                     // echo "Some things wrong";
                         }


}

?>