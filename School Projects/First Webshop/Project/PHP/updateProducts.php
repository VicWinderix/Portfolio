<?php
session_start();
if (isset($_SESSION['email']) and $_SESSION['admin']==1) {
    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $productID = htmlspecialchars(trim($_POST['productID']));
        $productName = htmlspecialchars(trim($_POST['productName']));
        $categoryID = htmlspecialchars(trim($_POST['categoryID']));
        $creator = htmlspecialchars(trim($_POST['creator']));
        $description = htmlspecialchars(trim($_POST['description']));
        $currentUnitCost = htmlspecialchars(trim($_POST['currentUnitCost']));
        $currentUnitPrice = htmlspecialchars(trim($_POST['currentUnitPrice']));
        $picture = htmlspecialchars(trim($_POST['picture']));
    }

    $sql = "UPDATE products SET productName='$productName', categoryID=$categoryID, creator='$creator', description='$description', currentUnitCost=$currentUnitCost, currentUnitPrice=$currentUnitPrice, picture='$picture' where productID=$productID";

    mysqli_query($link, $sql) or trigger_error("Failed to update product data for product $productID", E_ERROR);

    header("Location:../PHP/products.php");

    mysqli_close($link);
}
