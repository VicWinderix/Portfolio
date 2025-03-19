<?php
require 'errorHandler.php';
set_error_handler("handleErrors");

session_start();
$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);

if (isset($_SESSION['email']) and $_SESSION['admin'] == 1) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $categoryName = htmlspecialchars(trim($_POST['categoryName']));
        $description = htmlspecialchars(trim($_POST['description']));

        $sql = "INSERT INTO categories (categoryName, description, active) 
                VALUES ('$categoryName', '$description', 1)";
        mysqli_query($link, $sql) or trigger_error("Failed to add category $categoryName", E_ERROR);
        
    }
}
header("Location:../PHP/products.php");
?>
