<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru-Sign-Up</title>
  </head>
  <body>
  <form class="signup-form" action="check_new_user.php" method="POST" autocomplete="off">
<h1>Welcome New User!</h1><br><br>
Username <input type="text" name="username"><br>
First Name <input type="text" name="first"><br>
Last Name <input type="text" name="last"><br>
Email <input type="text" name="email"><br>
Password <input type="password" name="password"><br><br>
<input type="submit" value="submit" name="submit"><br><br>

</form>
<div class="home">Home</div>
<script>
  var home = document.querySelector(".home");
  home.addEventListener('click', Home);
  function    Home()    { document.location.href = "index.php"; }
</script>
  </body>
</html>