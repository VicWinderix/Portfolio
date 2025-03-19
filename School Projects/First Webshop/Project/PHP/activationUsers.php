<?php
require 'errorHandler.php';
set_error_handler("handleErrors");

session_start();
if (isset($_SESSION['email']) and $_SESSION['admin']==1) {
    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $customerID = htmlspecialchars(trim($_POST['customerID']));
        $active = htmlspecialchars(trim($_POST['active']));
    }
    if($customerID != 1){
    if($active==0){$sql = "UPDATE customer SET active = 1 where customerID = $customerID";}
    else{$sql = "UPDATE customer SET active = 0 where customerID = $customerID";}
    mysqli_query($link, $sql) or trigger_error("Failed to change activation status for user $customerID", E_ERROR);}
    header("Location:../PHP/useraccounts.php");
    mysqli_close($link);
}
?>