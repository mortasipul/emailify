<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';

    }

    elseif (isset($_POST['register'])) { //user registering

        require 'register.php';

    }
}
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$con = mysqli_connect("localhost", "root", "", "emailify");
$email = $mysqli->escape_string($_POST['email']);
$result = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'");


if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    echo("<script>location.href = 'error.php';</script>");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;
        echo("<script>location.href = 'home.php';</script>");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        echo("<script>location.href = 'error.php';</script>");
    }
}
?>
