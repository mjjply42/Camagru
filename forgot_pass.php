<?php



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="login.css">
    <title>Camagru - Fogotten Password</title>
    <div class="btn btn-info btn-lg" id="home" onclick="Home();">Home</div>
  <img src="BeFunky-collage3.png">
  </head>
  <body>
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
  </body>
  <script>
    $("#forgot").submit(function(e) {
      e.preventDefault();
    });
    function    Home()    { window.location.href = "index.php"};
    
    var username = document.querySelector("#login").value;
    var email = document.querySelector("#email").value;
    var user_id = document.querySelector("#login");
    var email_id = document.querySelector("#email");
    var mess2 = document.querySelector(".message2");
    var mess3 = document.querySelector(".message3");
    function  sendNew()
    {
      $.ajax(
      {
          type: "Post",
          url: "check_forgot_pass.php",
          data: {'login': username,
                  'email': email},
          success: function(data) 
          {
            console.log('dfs');
              if (data == 2)
              {
                console.log(2);
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
                console.log(3);
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
                  window.location.href = "send_reset_password.php?email="+email+"&reset=" +data+"";
              }
          }
      });
    }
  </script>
</html>