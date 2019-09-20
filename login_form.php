<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Form Using Ajax In PHP</title>
  <link rel="stylesheet" href="logstyle.css">
</head>
<body>
 <div class="login-page">
  <div class="form">
     <div id="message"></div>

    <form class="login-form" id="loginform" action="" method="POST">
      <input type="text" placeholder="username" name="user_name" id="user_name"/>
      <span id="uname"></span>
      <input type="password" placeholder="password" name="password" id="password"/>
      <span id="upass" name="upass"></span>
      <input type="submit" class="btn" name="submit" id="submt" value="login">
    </form>
    <td><a href="registration.html">SignUp Here</a></td>
  </div>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
  $("#loginform").on("submit",function(e){

   
    $('#uname').html('');
    $('#upass').html('');
    $('#message').html('');
        
        var user_name=$("#user_name").val();
        var password=$("#password").val();
        if($("#user_name").val()==""){
               $("#uname").html("Please enter username.");
               $("#uname").css("color", "red");
               $("#user_name").css("border", "1px solid grey");
               $("#user_name").focus();
             }
        
        else if($("#password").val()==""){
              $("#upass").html("Please enter password.");
               $("#upass").css("color", "red");
               $("#password").css("border", "1px solid grey");
              $("#password").focus();
        }
        else
      {
           $.ajax({
            type:"POST",
            url:"login.php",
            data:{"user_name":user_name,"password":password},
            success:function(result){
              //alert(result);
             if(result==0){
               //alert("invalid");
                $("#message").html("Invalid Email-id/Password");
                 $("#message").css("color", "red");
                }
                else if(result == 1){
                $("#message").html("Successfully Login");
                $("#message").css("color", "green");
                window.location.href = "index.php";
           }
           else if(result ==2)
           {
            $("#message").html("RIP");
                $("#message").css("color", "red");
           }
          }

    });

}

e.preventDefault();


  });
</script>