<?php

if (isset($_POST['submit'])) 
{
    include_once 'usr_db.php';

    $user_name = $_POST['username'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

}
else
{
    header("Location: /sign_up.php");
    exit();
}

?>