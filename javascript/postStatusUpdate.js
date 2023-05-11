$(document).ready(function(){

    function updateStatus(){
    $.ajax({
        url: "updateUserStatus.php",
        type: "POST",
        success: function(data){
            // alert(data)
        }
    })
}
function getStatus(){
    $.ajax({
        url: "getUserStatus.php",
        type: "POST",
        success: function(data){
            // alert(data)
            $(".activeUsersWrap").html(data);
        }
    })
}
setInterval(function(){
    updateStatus();
},6000);
setInterval(function(){
  getStatus();
},8000);


  });//end jquery function