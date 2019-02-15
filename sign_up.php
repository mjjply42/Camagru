<?php


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru-Sign-Up</title>
  </head>
  <body>
  <form action="sign_up.php">
<h1>Welcome New User!</h1><br><br>
Username <input type="username" value="<?php echo $_SESSION['login'];?>"><br>
First Name <input type="first" value="<?php echo $_SESSION['passwd'];?>"><br>
Last Name <input type="last" value="<?php echo $_SESSION['passwd'];?>"><br>
Email <input type="email" value="<?php echo $_SESSION['passwd'];?>"><br>
Password <input type="paswd" value="<?php echo $_SESSION['passwd'];?>"><br>
<input type="submit" value="submit"><br>

</form>
  </body>
</html>