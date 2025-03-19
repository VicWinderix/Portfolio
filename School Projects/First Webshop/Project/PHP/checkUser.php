<?php
require 'errorHandler.php';
set_error_handler("handleErrors");

$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);


if (isset($_POST['email'])) {
    if (!empty($_POST['email'])) {
        $query = "SELECT * FROM customer WHERE email like ?";
        $stmt = mysqli_prepare($link, $query);
        $email = htmlspecialchars($_POST['email']);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 0) {
            echo ("Avaliable");
        } else {
            echo ("Not avaliable"); 
        }
    }
}
mysqli_close($link);
?>