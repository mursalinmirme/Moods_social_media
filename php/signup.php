<?php
session_start();
if(isset($_SESSION['logdin']) || $_SESSION == true){
  header("location: home.php");
  exit;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
 <link rel="stylesheet" href="../css/signup.css"> 
</head>
<body>

<div class="regpage">
  
     <div class="pagename">
        <span>Welcome</span>
          </div>
      
  <form action="" method="POST" class="form">

    <div class="regMsgDiv">
                <span class="message"></span>
                    </div>
    
    <input type="text" name="name" id="name" placeholder="Name" />
        <input id="email" name="email" type="email" placeholder="Enter your Email" />
          <input id="password" name="password" type="password" placeholder="Password" />
            <input id="password2" name="rpassword" type="password" placeholder="Re-password" />
      
    <button id="sugnUpbtn" name="submit">SIGN UP</button>
      
  </form>
        
    <div class="loginLink">
      <p>Have already an account?<a href="../index.php">Login here</a></p>
        </div>
      
</div>
     
  </body>
  <script src="../javascript/jquery-3.6.3.min.js"></script>
  <script src="../javascript/signup.js"></script>
</html>