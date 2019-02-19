<?php



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Change Password</title>
  </head>
  <body>
  <h1>Change Password</h1>
  <form action="password_change.php" method='POST' autocomplete='off'>
  <br>Old Password<input type="text" name="old_pass"></input>
  <br>New Password<input type="text" name="new_pass"></input>
  <br><input type="submit" name="Submit" value="submit"></input>
  </form>
  <div class="home">Home</div>
  <script>
  var home = document.querySelector(".home");
  home.addEventListener('click', Home);
  function  Home()    { document.location.href = "index.php" };
  </script>
  </body>
</html>