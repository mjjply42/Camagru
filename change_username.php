<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Change Username</title>
  </head>
  <body>
  <h1>Change Username</h1>
  <form action="name_change.php" method='POST' autocomplete='off'>
  <br>Old Username<input type="text" name="old_u"></input>
  <br>New username<input type="text" name="new_u"></input>
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