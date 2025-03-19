<?php
session_start();
$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
mysqli_select_db($link, $database) or die("Error: the database could not be opened");

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT customerID FROM customer WHERE email = '$email'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $customerID = $row['customerID'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $orderDate = date("Y-m-d");
        $shipStreet = htmlspecialchars(trim($_POST['street']));
        $shipHouseNumber = (int) htmlspecialchars(trim($_POST['house-number']));
        $shipPostalcode = (int) htmlspecialchars(trim($_POST['postal-code']));
        $shipCity = htmlspecialchars(trim($_POST['city']));
        $shipCountry = htmlspecialchars(trim($_POST['country']));

        $sql = "INSERT INTO orders (customerID, orderDate, shipStreet, shipHouseNumber, shipPostalcode, shipCity, shipCountry) 
                VALUES ($customerID, '$orderDate', '$shipStreet', $shipHouseNumber, $shipPostalcode, '$shipCity', '$shipCountry')";
        mysqli_query($link, $sql) or trigger_error("Failed to place order for customer $email", E_ERROR);

        $orderIDQuery = "SELECT max(orderID) AS maxOrderID FROM orders";
        $orderIDResult = mysqli_query($link, $orderIDQuery);
        $orderIDRow = mysqli_fetch_assoc($orderIDResult);
        $orderID = $orderIDRow['maxOrderID'];

        foreach ($_SESSION['cart'] as $productID => $product) {
            $productID = $product['id'];
            $price = $product['price'];
            $quantity = $product['quantity'];
            $totalPrice = $price * $quantity;

            $sql2 = "INSERT INTO orderdetails (orderID, productID, unitPrice, quantity, discount) 
                     VALUES ($orderID, $productID, $totalPrice, $quantity, NULL)";
            mysqli_query($link, $sql2) or trigger_error("Failed to add order details to order", E_ERROR);;
        }
    }
    unset($_SESSION['cart']);
}
header("Location:../PHP/home.php");
?>
