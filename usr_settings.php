<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - UserSettings</title>
  </head>
  <body>
  <h1>User Settings</h1>
    <p1> Change User Settings </p1>
    <br><br><button class="ch_usr"> Change Username </button>
    <br><button class="ch_em"> Change Email </button>
    <br><button class="ch_pw"> Change Password </button>
    <div class="home">Home</div>
  </body>
  <script>
  var home = document.querySelector(".home");
  var usname_butt = document.querySelector(".ch_usr");
  var email_butt = document.querySelector(".ch_em");
  var pass_butt = document.querySelector(".ch_pw");
  
  home.addEventListener('click', Home);
  usname_butt.addEventListener('click', userFormDrop);
  email_butt.addEventListener('click', emailFormDrop);
  pass_butt.addEventListener('click', passFormDrop);

  function  userFormDrop()  { window.location.href = '/change_username.php'; }
  function  emailFormDrop() { window.location.href = '/change_email.php'; }
  function  passFormDrop()  { window.location.href = '/change_password.php'; }
  function  Home()    { document.location.href = "index.php" };

  </script>
</html>