<?php
if (isset($_POST['send']) && $_POST == 'yes')
{
    echo($_POST['send']);
    $email = $_COOKIE['email'];
    $username = $_COOKIE['username'];
    $to      = $email;
    $e_verify = $_SESSION['verify'];
    $subject = 'Signup | Verification';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
    $message = '
    Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
    
    ------------------------
    Username: '.$username.'
    Email: '.$email.'
    ------------------------
    
    Please click this link to activate your account:
    http://localhost:8100/new_usr_session.php?email='.$email.'&verify='.$e_verify.'';
    
    mail($to, $subject, $message, $headers);
}
?>