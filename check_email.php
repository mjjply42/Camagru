<?php
session_start();
if($_SESSION['prevent'] == 'true')
{
    $_SESSION['prevent'] = 'false';
}
else
    header("Location:  not_accessible.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Camagru - Check Email</title>
  </head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <body>
  <h1>Click button below to send verification link</h1>
  <p>The link will epxire in exactly one day</p>
  <button class="resend">Send Link</button>
  <script>
  $(document).ready(function() {
    $(".resend").click(function() {
      $.ajax({
        type: "Post",
        url: "send_email.php",
        data: "send='yes'",
        success: function() {
          alert("Email Has Been Sent");
        }
      });
    });

  });
  
  
  </script>
  </body>
</html>