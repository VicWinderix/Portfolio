<?php 
session_start();
if (isset($_SESSION['email']) and $_SESSION['admin'] == 1) {
    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $orderID = htmlspecialchars(trim($_POST['orderID']));
    }

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);

    $shipDate = date("Y-m-d");
    $sql = ("UPDATE orders SET shippedDate = '$shipDate' WHERE orderID = '$orderID'");
    $result = mysqli_query($link, $sql) or trigger_error("Failed to update shippingstatus for order $orderID", E_ERROR);;
    header("Location: ../PHP/orders.php");
    
} else {
    header("Location: ../HTML/login.html");
}
?>
