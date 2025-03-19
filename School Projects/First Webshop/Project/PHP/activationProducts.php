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

        $productID = htmlspecialchars(trim($_POST['productID']));
        $active = htmlspecialchars(trim($_POST['active']));
    }
    if($active==0){$sql = "UPDATE products SET active = 1 where productID = $productID";}
    else{$sql = "UPDATE products SET active = 0 where productID = $productID";}
    mysqli_query($link, $sql) or trigger_error("Failed to change product status", E_ERROR);

    header("Location:../PHP/products.php");
    mysqli_close($link);
}
?>