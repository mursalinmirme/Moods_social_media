<!-- This code written by Mursalin Mir -->
<?php
session_start();
if(isset($_SESSION['logdin']) || $_SESSION == true){
  header("location: php/home.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="loginPage">
    <div class="LoginGretting">
        <span>Welcome Back</span>
            </div>

    <div class="LoginPagename">
        <h1>Log In</h1>
            </div>
      
    <form action="" method="POST" class="form">
        <div class="messageDiv">
             <span id="message" class="message"></span>
                 </div>

        <input id="email" name="loginEmail" type="email" placeholder="Enter your Email" />
            <input id="password" name="loginPassword" type="password" placeholder="Password" />
                <button type="submit" name="login" id="signIn">SIGN IN</button>
      
    </form>
        
        <div class="loginLink">
            <p>Not registered?<a href="php/signup.php">Create an account</a></p>
                </div>
      
      </div>
    </body>
    <script src="javascript/jquery-3.6.3.min.js"></script>
    <script src="javascript/login.js"></script>
    <script type="text/javascript">

    </script>
  </html>