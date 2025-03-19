<?php
require 'errorHandler.php';
set_error_handler("handleErrors");

$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $username, $password) or die ("Error: no connection can be made to the host");

mysqli_select_db($link, $database) or die ("Error: the database could not be opened");

$query = "SELECT email, password, admin FROM customer WHERE active = 1";
$result = mysqli_query($link, $query) or trigger_error("Failed to open database", E_ERROR);
$numberRecords = mysqli_num_rows($result);

$login = array();
while($row = mysqli_fetch_array($result)) {
    $login[] = array($row['email'], $row['password'], $row['admin'] );
}

function searchUser($user,$login){
    foreach($login as $validUser){
        if ($validUser[0] == $user){
            return $validUser;
        }
    }
    return -1;
}
if (!isset($_POST['email']) || !isset($_POST['password']))
{
	header( "Location: ../PHP/login.php" );
    trigger_error("Form error for login, password/email not send", E_USER_NOTICE);
}
elseif (empty($_POST['email']) || empty($_POST['password']))
{
	header( "Location: ../HTML/signup.html" );
    trigger_error("Form error for login, password/email is empty", E_USER_NOTICE);
}
else{
    $user = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);
    $result = searchUser($user, $login);

    if ($result != -1){
        $match = password_verify($pass,$result[1]);
        if($match){
            session_start();
            $_SESSION['email'] = $user;
            $_SESSION['admin'] = $result[2];
            header("Location:../PHP/userprofile.php");
        }
        else{
            header("Location:../HTML/login.html");
            trigger_error("Wrong password inserted for $user", E_USER_NOTICE);
        }
    }
    else{
        header("Location:../HTML/signup.html");
        trigger_error("No account found for user $user", E_USER_NOTICE);
    }
}
mysqli_close($link);
?>