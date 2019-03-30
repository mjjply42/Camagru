<?php
include_once 'database.php';
$im_id = $_POST['image_id'];
$username = '';
$email = '';
try { $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); }

catch   (PDOException $event) { print "Error!: " . $event->getMessage(). "<br/>";
    die(); }
$state = $conn->prepare("SELECT profile_info.image_id, users.user_id, users.user_usrname, users.user_email
                            FROM users, profile_info
                            WHERE profile_info.image_id = 6
                            AND users.user_id = profile_info.user_id");
$state->execute();
while($result = $state->fetchAll())
{
    foreach($result as $row)
    {
        $username = $row['user_usrname'];
        $email = $row['user_email'];
    }
}

if ($_POST['value'] == 0)
    newUser($username, $email);
else if ($_POST['value'] == 1)
    newComment($username, $email);
else
    newLike($username, $email);

function    newLike($username, $email)
{
    $to      = $email;
    $subject = 'Notification | New Like On Your Photo!';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
    $message = '
    A user has liked one of the photos on your page!
    
    ------------------------
    Username: '.$username.'
    Email: '.$email.'
    ------------------------';
    
    mail($to, $subject, $message, $headers);
}

function    newComment($username, $email)
{
    $to      = $email;
    $subject = 'Notification | New Comment On Your Photo';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
    $message = '
    A user has commented on one of your photos!

    ------------------------
    Username: '.$username.'
    Email: '.$email.'
    ------------------------';
    
    mail($to, $subject, $message, $headers);

}

function    newUser($username, $email)
{
    $to      = $email;
    $subject = 'Signup | Verification';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
    $message = '
    Thanks for signing up!
    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
    
    ------------------------
    Username: '.$username.'
    Email: '.$email.'
    ------------------------';
    
    mail($to, $subject, $message, $headers);
}
?>