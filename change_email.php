<?php



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Change Email</title>
  </head>
  <body>
  <h1>Change Username</h1>
  <form action="email_change.php" method='POST' autocomplete='off'>
  <br>Old Email<input type="text" name="old_em"></input>
  <br>New Email<input type="text" name="new_em"></input>
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