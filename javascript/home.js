$(document).ready(function(){

    $(".myPostsSingleMenuBtn").click(function(){
      var showPostMenu = $(this).parent(".postmenu").parent(".posttop").children(".postOption");
      $(showPostMenu).toggle();

    });
    $(".proPagination").click(function(e){
      e.stopPropagation();
    })
    $(".postOption").click(function(e){
      e.stopPropagation();
    })

    $(document).on("click", function(event){
        var $trigger = $(".myPostsSingleMenuBtn");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".postOption").hide();
            // alert("outside clicked")
        }            
    });

    //code for showing menu bar
    $("#myAvater").click(function(){
      $(".menuPage").slideToggle(400);
    });

    //this code for mobile version profile viewing
    $("#profileBtn").click(function(){
      $(".menuPage").hide();
      $(".userProfile").show();
      $(".userProfile").addClass("makebig");
    })

    //remove profie make big classlist 
    $("#proBackBtn").click(function(){
      $(".userProfile").hide();

    })

    // show active users in mobile devices
    $("#activeUsersBtn").click(function(){
      $(".menuPage").hide();
      $(".usersList").show();
      $(".usersList").addClass("fadeInUsersActive");
    })

    //back user profie to main page make big classlist 
    $("#activePageBackBtn").click(function(){
      $(".usersList").hide();

    })



  // Read More status js code
// Read More status js code
$(".readMoreBtn").click(function(){
  var ipk = $(this).attr("name");
  $(this).parent(".statusTexts").html(ipk);
  
});

   
// Read More status for my profile js code
$(".readMoremyPost").click(function(){
  var ipk = $(this).attr("name");
  $(this).parent(".mystatusTexts").html(ipk);
  
});









  });//end jquery function





