<?php



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Camagru - Fogotten Password</title>
  </head>
  <body onclick="swap();">
  <nav class="navbar navbar-light bg-light">
  <form class="form-inline log" method="POST" autocomplete="off">

    <input type="login" id="login1" class="form-control" name="login" value="Username">
    <input type="" name="pwd" class="form-control" id="pwd1" value="Password">
    <input type="submit" class="btn btn-primary" value="Sign In" onclick="checkUser();" name="submit" id="sub">
  </form>
</nav>
<div class="btn btn-info btn-lg" id="home" onclick="Home();">Home</div>
  <img src="BeFunky-collage3.png">
    <div class="container">
      <h1>Send New Password</h1>
      <form method="POST" autocomplete="off" id="forgot">
        <div class="row">
          <div class="col">
            Username<input type="text" class="form-control" id="login" name="login"><br>
          </div>
          <div class="col">
            Email<input type="text" class="form-control" id="email" name="email"><br><br>
          </div>
        </div>
            <input type="submit"class="btn btn-primary" onclick="sendNew();"value="Submit" name="submit"><br><br>
      </form>
    </div>
  </div>
  <div class="message3">
    <p>Fill in all fields</p>
  </div>
  <div class="message2">
    <p>Username or Email is incorrect</p>
  </div>
  <div class="alert alert-success" role="alert">
      Password Succesfully Changed!
  </div>
  </body>
  <script>
    $("#forgot").submit(function(e) {
      e.preventDefault();
    });
    function    Home()    { window.location.href = "index.php"};
    

    function  sendNew()
    {
      var username = document.querySelector("#login").value;
      var email = document.querySelector("#email").value;
      var user_id = document.querySelector("#login");
      var email_id = document.querySelector("#email");
      var mess2 = document.querySelector(".message2");
      var mess3 = document.querySelector(".message3");
      var success = document.querySelector(".alert-success");
      $.ajax(
      {
          type: "Post",
          url: "check_forgot_pass.php",
          data: {'login': username,
                  'email': email},
          success: function(data) 
          {
              if (data == 2)
              {
                user_id.className += " is-invalid";
                email_id.className += " is-invalid";
                mess2.style.display = 'block';
                setTimeout( () => { 
                  mess2.style.display = 'none';
                  user_id.className = '';
                  user_id.className = 'form-control';
                  email_id.className = '';
                  email_id.className = 'form-control'; }, 3000);
              }
              else if (data == 3)
              {
                user_id.className += " is-invalid";
                email_id.className += " is-invalid";
                mess3.style.display = 'block';
                setTimeout( () => { 
                  mess3.style.display = 'none';
                  user_id.className = '';
                  user_id.className = 'form-control';
                  email_id.className = '';
                  email_id.className = 'form-control'; }, 3000);
              }
              else
              {
                  success.style.display = 'block';
                  setTimeout( () => { 
                    success.style.display = 'none';
                    window.location.href = "send_reset_password.php?email="+email+"&reset=" +data+""; 
                    }, 2000);
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
</html>