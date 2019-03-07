<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Login</title>
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