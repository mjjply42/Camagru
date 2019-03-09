<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
  <div class="btn btn-info btn-lg" id="home">Home</div>
  <img src="BeFunky-collage3.png">
    <div class="container">
  <form method="POST" autocomplete="off" class="log">
    Username<input type="login" id="login" class="form-control" name="login"><br>
    Password<input type="password" name="pwd" class="form-control" id="pwd"><br><br>
  <input type="submit" value="Submit" onclick="checkUser();" name="submit"><br>
  </form>
  <button class="forgot_pass">Forgot Password</button>
  </div>
  <div class="message3">
    <p>Fill in all fields</p>
  </div>
  <div class="message2">
    <p>Username or Password is incorrect</p>
  </div>
  <script>
    $(".log").submit(function(e) {
    e.preventDefault();
});
    var home = document.querySelector("#home");
    var forgot = document.querySelector(".forgot_pass");
    forgot.addEventListener('click', Forgot);
    home.addEventListener('click', Home);

    function    Home()    { window.location.href = "index.php"};
    
    function    Forgot()  { 
      window.location.href = "forgot_pass.php" 
    };
    function  checkUser()
    {
      var username = document.querySelector("#login").value;
      var password = document.querySelector("#pwd").value;
      var user_id = document.querySelector("#login");
      var pass_id = document.querySelector("#pwd");
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
                mess2.style.display = 'block';
                setTimeout( () => { 
                  mess2.style.display = 'none';
                  user_id.className = '';
                  user_id.className = 'form-control';
                  pass_id.className = '';
                  pass_id.className = 'form-control'; }, 3000);
                  
              }
              else
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
          }
      });
    }
  </script>
  </body>
</html>