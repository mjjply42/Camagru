<?php
    echo($_POST['send']);
    $reset = $_GET['reset'];
    $username = $_COOKIE['username'];
    $to      = $_GET['email'];
    $e_verify = $_COOKIE['verify'];
    $subject = 'Password | Forgotten Password';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
    $message = '
    Here is the new password for your account. It should only be 
    treated as temporary, and needs to be changed immediately.
    
    ------------------------
    Username: '.$username.'
    Password: '.$reset.'
    ------------------------
    
    ';
    
    mail($to, $subject, $message, $headers);
    header("Location:   login.php");


?>