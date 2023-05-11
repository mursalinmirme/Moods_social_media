<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome to Amar Kabbo</title>
<link rel="stylesheet" href="../css/uploadPic.css">
<script src="https://kit.fontawesome.com/6d208b1cbc.js" crossorigin="anonymous"></script>
</head>
<body>

<div id="submitProfile" class="submitProfile">
    <div class="submitProfileDiv">
        <div class="forProfile">

<?php
  include "dbconnect.php";
    $profileUserId = $_GET['profile_userid'];
      $mkQuery = "SELECT * FROM `users` WHERE user_id = $profileUserId";
        $runMkQuery = mysqli_query($conn, $mkQuery);
          while($catchUid = mysqli_fetch_assoc($runMkQuery)){
            $userUid = $catchUid['profile_pic'];
            if($userUid == "avater.png"){
              $modifyProfileUserImage = "../photos/avater.png";
            }else{
              $modifyProfileUserImage = "../upload/$userUid";
            }
              }
?>

<img id="viewProfilePic" style="width:300px;height:300px;" src="<?php echo $modifyProfileUserImage; ?>" alt="">
    <form class="profileUpladForm" action="" method="POST" enctype="multipart/form-data">
       <input style="display:none;" type="file" name="profilePic" class="profilePic" id="profilePic">
          <label class="uploadPic" id="uploadpic" for="profilePic"><i class="fa-solid fa-camera"></i></label>
            </div>
               <input style="display:none;" type="submit" id="imgSubmit" name="" value="Upload Picture">
                   <span style="margin-top:144px;font-size:20px;color:black;" id="selectImageMsg">Select an image</span>
                     </div>

    </form>

</div>

</body>
<script src="../javascript/jquery-3.6.3.min.js"></script>
<script src="../javascript/profileUpload.js"></script>
</html> 






















