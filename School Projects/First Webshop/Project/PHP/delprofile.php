<?php
session_start();
$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$userEmail = $_SESSION['email'];

$link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");

mysqli_select_db($link, $database) or die("Error: the database could not be opened");
if ($_SESSION['admin'] == 0) {
    $query = "SELECT active FROM customer WHERE email = '$userEmail'";
    $result = mysqli_query($link, $query) or trigger_error("Couldn't pull user data from the database", E_ERROR);
    $numberRecords = mysqli_fetch_array($result)['active'];

    $change = "UPDATE customer SET active = 0 WHERE email = '$userEmail'";
    mysqli_query($link, $change) or trigger_error("Couldn't deactivate profile of $userEmail", E_USER_WARNING); 
    session_unset();
    session_destroy();
    header("Location: ../PHP/home.php");
}
else{
    header("Location: ../PHP/userprofile.php");
}
?>