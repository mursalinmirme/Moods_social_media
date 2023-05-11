$(document).ready(function(){
    $("#signIn").click(function(e){
     e.preventDefault();
     var email = $("#email").val();
     var password = $("#password").val();
     // var showMsg = $("#message").css("display","block");
     if(email == '' && password == ''){
         $(".message").text("Please, enter your email and password!");
         $(".message").addClass("error");
     }
     else if(email == ''){
         $(".message").text("Please, enter your email!");
         $(".message").addClass("error");
 
     }else if(password == ''){
         $(".message").text("Please, enter your password!");
         $(".message").addClass("error");
 
     }else{
         $.post("php/loginFunction.php", {email:email,password:password,loginBtn:'loginBtn'},function(data){
         
 
             if(data === 'Login successfully'){
                 $(".message").text(data+"...");
                 $(".message").addClass("success");
                 setTimeout(function(){
                     window.location.href='php/home.php';
                 },2000);
 
             }else if(data === 'Password does not matched'){
                 $(".message").text(data);
                 $(".message").addClass("error");
 
             }
             else{
                 $(".message").text("Inncorrect email and Password.");
                 $(".message").addClass("error");
     
             }
         
 
 
         });
     }
     
    });
 });