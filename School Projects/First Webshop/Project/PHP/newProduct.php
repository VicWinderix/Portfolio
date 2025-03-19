<?php
session_start();
$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);

if (isset($_SESSION['email']) and $_SESSION['admin'] == 1) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $productName = htmlspecialchars(trim($_POST['productName']));
        $categoryID = htmlspecialchars(trim($_POST['categoryID']));
        $creator = htmlspecialchars(trim($_POST['creator']));
        $description = htmlspecialchars(trim($_POST['description']));
        $currentUnitCost = htmlspecialchars(trim($_POST['currentUnitCost']));
        $currentUnitPrice = htmlspecialchars(trim($_POST['currentUnitPrice']));
        $picture = htmlspecialchars(trim($_POST['picture']));

        $sql = "INSERT INTO products (productName, categoryID, creator, description, currentUnitCost, currentUnitPrice, active, picture) 
                VALUES ('$productName', $categoryID, '$creator', '$description', $currentUnitCost, $currentUnitPrice, 1, '$picture')";
        mysqli_query($link, $sql) or trigger_error("Failed to add new product", E_ERROR);;
        
    }
}
header("Location:../PHP/products.php");
?>
