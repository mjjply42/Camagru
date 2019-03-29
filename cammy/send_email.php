<?php
include_once 'database.php';

try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }

catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
    die(); }
$state = $conn->prepare("SELECT profile_info.image_id, profile_info.user_id, users.user_id, users.user_usrname, users.user_email
                            FROM users, profile_info
                            WHERE profile_info.image_id = 6
                            AND users.user_id = profile_info.user_id");
function    newLike()
{

}

function    newComment()
{
    

}

function    newUser()
{
    $email = $_COOKIE['email'];
    $username = $_COOKIE['username'];
    $to      = $email;
    $e_verify = $_COOKIE['verify'];
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
    http://localhost:8888/new_usr_session.php?email='.$email.'&verify='.$e_verify.'';
    
    mail($to, $subject, $message, $headers);
}
?>