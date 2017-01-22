$(document).ready(function(){

  $("#submit").click(function(){

    var username = $("#myusername").val();
    var password = $("#mypassword").val();

    if((username == "") || (password == "")) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a username and a password</div>");
    }
    else {
      $.ajax({
        type: "POST",
        url: "index.php?option=checklogin",
        data: "myusername="+username+"&mypassword="+password,
        success: function(html){
          if(html==' true') {
            window.location="index.php?option=dashboard";
          }
          else {
            $("#message").html(html);
          }
        },
        beforeSend:function()
        {
          $("#message").html("<p class='text-center'><img src='application/styles/img/ajax-loader.gif'></p>")
        }
      });
    }
    return false;
  });
});
