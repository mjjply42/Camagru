<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <form action="check_login.php" method="POST" autocomplete="off">
  Username<input type="login" name="login"><br>
  Password<input type="password" name="pwd"><br><br>
  <input type="submit" value="Submit" name="submit"><br><br>
  </form>
  <button class="forgot_pass">Forgot Password</button>
  <div class="home">Home</div>
  <script>
    var home = document.querySelector(".home");
    var forgot = document.querySelector(".forgot_pass");
    forgot.addEventListener('click', Forgot);
    home.addEventListener('click', Home);

    function    Home()    { window.location.href = "index.php"};
    
    function    Forgot()  { 
      window.location.href = "forgot_pass.php" 
    };
  </script>
  </body>
</html>