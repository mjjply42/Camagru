<?php


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Login</title>
  </head>
  <body>
  <form>
  Login<input type="login"><br>
  Password<input type="pwd"><br><br>
  <input type="submit" value="submit"><br><br>
  </form>
  <div class="home">Home</div>
  <script>
    var home = document.querySelector(".home");
    home.addEventListener('click', Home);
    function    Home()    { document.location.href = "index.php"};
  </script>
  </body>
</html>