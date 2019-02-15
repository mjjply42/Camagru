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
  Login<input type="login" name="login"><br>
  Password<input type="pwd" name="pwd"><br><br>
  <input type="submit" value="Submit" name="submit"><br><br>
  </form>
  <div class="home">Home</div>
  <script>
    var home = document.querySelector(".home");
    home.addEventListener('click', Home);
    function    Home()    { document.location.href = "index.php"};
  </script>
  </body>
</html>