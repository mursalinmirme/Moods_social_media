$(document).ready(function(){
  $("#sugnUpbtn").click(function(e){
    e.preventDefault();
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var rpassword = $("#password2").val();

    if(name == '' && email == '' && password == '' && rpassword == ''){
        $(".message").text("Input fields are empty!");
        $(".message").addClass("error");
    }
    else if(name == ''){
        $(".message").text("Name field is empty!");
        $(".message").addClass("error");
    }else if(email == ''){
        $(".message").text("Email field is empty!");
        $(".message").addClass("error");
    }
    else if(password == ''){
        $(".message").text("Password field is empty!");
        $(".message").addClass("error");
    }
    else if(rpassword == ''){
        $(".message").text("Re_Password field is empty!");
        $(".message").addClass("error");
    }else if(password != rpassword){
        $(".message").text("Password does not matched!");
        $(".message").addClass("error");
    }
    else{
        //make ajax post 
        $.post("signupFunction.php",{name:name,email:email,password:password,rpassword:rpassword,signUpBtn:'signupBtn'},function(data){
            // $(".message").text(data);
            // $(".message").addClass("success");
            if(data == 'This email has been already an account.'){
                $(".message").text("This email has been already an account.");
                $(".message").addClass("error");

            }else if(data == 'Registration Successfully'){
                $(".message").text('Registration Successfully');
                $(".message").addClass("success");
                setTimeout(function(){
                    window.location.href='../index.php';
                },2000);
            }
        });
        
    }


  })
});