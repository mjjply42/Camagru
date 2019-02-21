<?php
include_once 'database.php';
session_start();

try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
}

catch   (PDOException $event) {
    print "Error!: " . $event->getMessage(). "<br/>";
    die();
}
$validity = $conn->prepare("SELECT `user_email`, `user_usrname` FROM users");
$validity->execute();
while ($result = $validity->fetchAll())
{
  foreach($result as $row)
  { 
    if ($row['user_usrname'] == $_SESSION['username'])
    {
      $_SESSION['email'] = $row['user_email'];
    }
  }
} 
if (isset($_POST['logout']))
{
  $_SESSION['logged'] = false;
}
if ($_SESSION['logged'] == false)
  header('Location:  login.php');


?>
<!DOCTYPE html>
<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <title>Camagru - Profile</title>
  </head>
  <body>
      <h1>User Profile</h1>
      <form method="POST" action="usr_profile.php">
      <input class="logout" type="submit" value="Logout" name="logout"></input>
      </form>
      <button class="settings">Settings</button>
      <button class="test">test</button>
      <div class="home">Home</div>
      <script>

      var settings = document.querySelector(".settings");
      var home = document.querySelector(".home");
      home.addEventListener('click', Home);
      settings.addEventListener('click', toSettings);
      function toSettings()
      {
        window.location.href = '/usr_settings.php';
      }
      function    Home()    { document.location.href = "index.php"};
      </script>
  </body>
</html>