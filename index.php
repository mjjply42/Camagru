<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru-Sign-Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body onclick="swap();">
  <nav class="navbar navbar-light bg-light">
  <form class="form-inline log" method="POST" autocomplete="off">

    <input type="login" id="login1" class="form-control" name="login" value="Username">
    <input type="" name="pwd" class="form-control" id="pwd1" value="Password">
    <input type="submit" class="btn btn-primary" value="Sign In" onclick="checkUser();" name="submit" id="sub">
    &nbsp;&nbsp;&nbsp;<p class="forgot_pass" style="box-shadow: none;" >Forgot Password</p>
  </form>
</nav>
  <div class="btn btn-info btn-lg" id="home">Home</div>
  <img src="BeFunky-collage3.png">
  <form class="signup-form" method="POST" autocomplete="off">
<h1>Welcome New User!</h1><br><br>
<div class="container">
Username <input type="text" id="login" class="form-control" name="username"><br>
First Name <input type="text" id="first" class="form-control" name="first"><br>
Last Name <input type="text" id="last" class="form-control" name="last"><br>
Email <input type="text" id="email" class="form-control" name="email"><br>
Password <input type="password" id="pwd" class="form-control" name="password"><br><br>
<input type="submit" class="btn btn-block btn-primary" id="submit" onclick="addUser();" value="Join Now" name="submit"><br><br>
</form>
</div>
<div class="message3">
    <p>Fill in all fields</p>
</div>
<div class="message2">
    <p>User Exists with that email or Username</p>
</div>
<script>
  $(".signup-form").submit(function(e) {
    e.preventDefault();
});

$(".log").submit(function(e) {
    e.preventDefault();
});
    var forgot = document.querySelector(".forgot_pass");
    forgot.addEventListener('click', Forgot);
    
    function    Forgot()  { 
      window.location.href = "forgot_pass.php" 
    };

  var home = document.querySelector("#home");
  home.addEventListener('click', Home);
  function    Home()    { window.location.href = "index.php"; }

  function    addUser()
  {
      var username = document.querySelector("#login").value;
      var password = document.querySelector("#pwd").value;
      var first = document.querySelector("#first").value;
      var last = document.querySelector("#last").value;
      var email = document.querySelector("#email").value;
      var user_id = document.querySelector("#login");
      var pass_id = document.querySelector("#pwd");
      var first_id = document.querySelector("#first");
      var last_id = document.querySelector("#last");
      var email_id = document.querySelector("#email");
      var mess2 = document.querySelector(".message2");
      var mess3 = document.querySelector(".message3");
    $.ajax(
      {
          type: "Post",
          url: "check_new_user.php",
          data: {'username': username,
                  'password': password,
                  'first': first,
                  'last': last,
                  'email': email},
          success: function(data) 
          {
            if (data == 2)
              {
                user_id.className += " is-invalid";
                pass_id.className += " is-invalid";
                mess2.style.display = 'block';
                setTimeout( () => { 
                  mess2.style.display = 'none';
                  user_id.className = '';
                  user_id.className = 'form-control';
                  pass_id.className = '';
                  pass_id.className = 'form-control'; }, 3000);
              }
            else if (data == 3)
              {
                user_id.className += " is-invalid";
                pass_id.className += " is-invalid";
                mess3.style.display = 'block';
                setTimeout( () => { 
                  mess3.style.display = 'none';
                  user_id.className = '';
                  user_id.className = 'form-control';
                  pass_id.className = '';
                  pass_id.className = 'form-control'; }, 3000);
              }
            else
              {
                var eVerify = data;
                user_id.className += " is-valid";
                pass_id.className += " is-valid";
                window.location.href = "check_email.php?username="+username+"&email="+email+"&verify="+eVerify+"";
              }
          }
        });
  }
  function  swap()
  {
   var pwd = document.activeElement.id;
   var login = document.activeElement.id;
   var pw_id = document.querySelector("#pwd1").id;
   var login_id = document.querySelector("#login1").id;
   var pw_val = document.querySelector("#pwd1");
   var login1_val = document.querySelector("#login1");
    if (pwd == pw_id)
    {
      if (pw_val.value != "")
      {
        pw_val.value = "";
        pw_val.type = "password";
      }
      else
        pw_val.value = "";
    }
    else
    {
      if (pw_val.value == "" || login != login_id)
      {
        pw_val.value = 'Password';
        pw_val.type = "";
      }
    }
    if (login == login_id)
      login1_val.value = "";
    else
        if (pw_val.value == "Password" && pwd != pw_id)
          login1_val.value = "Username";
  }
  function  checkUser()
    {
      var username = document.querySelector("#login1").value;
      var password = document.querySelector("#pwd1").value;
      var user_id = document.querySelector("#login1");
      var pass_id = document.querySelector("#pwd1");
      var mess2 = document.querySelector(".message2");
      var mess3 = document.querySelector(".message3");
      $.ajax(
      {
          type: "Post",
          url: "check_login.php",
          data: {'login': username,
                  'pwd': password},
          success: function(data) 
          {
              if (data == 1)
              {
                user_id.className += " is-valid";
                pass_id.className += " is-valid";
                window.location.href = "usr_session.php?username=" + username + "";
              }
              else if (data == 2)
              {
                user_id.className += " is-invalid";
                pass_id.className += " is-invalid";
                setTimeout( () => { 
                  user_id.className = '';
                  user_id.className = 'form-control';
                  pass_id.className = '';
                  pass_id.className = 'form-control'; }, 3000);
                  
              }
              else
              {
                user_id.className += " is-invalid";
                pass_id.className += " is-invalid";
                setTimeout( () => { 
                  user_id.className = '';
                  user_id.className = 'form-control';
                  pass_id.className = '';
                  pass_id.className = 'form-control'; }, 3000);
              }
          }
      });
    }
</script>
  </body>
</html>