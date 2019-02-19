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
  <body>
  <h1>A verification link will be emailed to you shortly</h1>
  <p>The link will epxire in exactly one day</p>
  <?php
  $email = $_GET['email'];
  $username = $_GET['username'];
  $to      = $email;
  $e_verify = $_GET['verify'];
  $subject = 'Signup | Verification';
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
  $message = '
   
  Thanks for signing up!
  Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
   
  ------------------------
  Username: '.$name.'
  Email: '.$email.'
  ------------------------
   
  Please click this link to activate your account:
  http://localhost:8100/new_usr_session.php?email='.$email.'&verify='.$e_verify.'';
                       
  mail($to, $subject, $message, $headers);
  

  ?>
  </body>
</html>