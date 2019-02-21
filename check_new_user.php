<?php
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "camagru";
$DB_CHARSET = "utf8mb4";
$DB_PORT = 8889;
$DB_SET_DSN = "mysql:host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";
$DB_DSN = "mysql:dbname=$DB_NAME;host=$DB_HOST:$DB_PORT;charset=$DB_CHARSET";
#******* $("#prospects_form").submit(function(e) {
#********* e.preventDefault();
#});
##^^Function will prevent form from switching windows on send
##Grab&Check values through ajax, using JQUERY

#New Users cannot have same:
#user_usrname
#same user_email
try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
}
catch   (PDOException $event) {
    print "Error!: " . $event->getMessage(). "<br/>";
    die();
}
if ((!empty($_POST['username'])) && (!empty($_POST['first'])) && (!empty($_POST['last'])) && (!empty($_POST['email'])) && (!empty($_POST['password'])))
{
    $username = $_POST['username'];
    $first_n = $_POST['first'];
    $last_n = $_POST['last'];
    $email = $_POST['email'];
    $password = hash('sha3-512',$_POST['password']);
    $e_verify = uniqid($email, true);
    $ifNew = false;

    $validity = $conn->prepare("SELECT user_usrname, user_email FROM users");
    $validity->execute();
    if ($result = $validity->fetchAll())
    {
        while($result = $validity->fetchAll())
        {
            foreach($result as $row)
            { 
                if ($row['user_usrname'] == $username || $row['user_email'] == $email)
                {
                    ##Switch these two lines out with an AJAX Call 
                    ##that shows beside form. That will be a flashy step.
                    echo("User Already Exists. Redirecting");
                    header("Refresh: 1; sign_up.php");
                    $ifNew = false;
                    break;
                }
                else
                {
                    $ifNew = true;
                }
            }
        }
    }
    else
    {
        $ifNew = true;
    }
    $conn = NULL;
    if ($ifNew == true)
    {
        echo("HERE");
        try 
        {
            $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        }
        catch   (PDOException $e) 
        {
            print "Error!: " . $e->getMessage(). "<br/>";
            die();
        }
        $new_usr = $conn->prepare("INSERT INTO temp_users
                                    (user_usrname, user_first, 
                                    user_last, user_email, user_pwd, e_verify)
                                VALUES ('$username', '$first_n',
                                        '$last_n', '$email', '$password', '$e_verify')");
        $new_usr->execute();
        session_start();
        $_SESSION['prevent'] = 'true';
        $_SESSION['verify'] = $e_verify;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        setcookie('username', $username, time()+3600);
        setcookie('email', $email, time()+3600);
        setcookie('verify', $e_verify, time()+3600);
        session_write_close();
        header("Location: check_email.php?username=$username&email=$email&verify=$e_verify");
    }
}
else
    header("Location:  sign_up.php");


?>
