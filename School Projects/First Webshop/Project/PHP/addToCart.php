<?php
require 'errorHandler.php';
set_error_handler("handleErrors");

session_start();
if (isset($_SESSION['email'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productID = htmlspecialchars($_POST['productID']);
        $productName = htmlspecialchars($_POST['productName']);
        $productPrice = ($_POST['price']);
        $quantity = intval(1);
        $picture = htmlspecialchars($_POST['picture']);

        if (isset($_SESSION['cart'][$productID])) {

            $_SESSION['cart'][$productID]['quantity'] += $quantity;
        } else {

            $_SESSION['cart'][$productID] = [
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => $quantity,
                'id' => $productID,
                'picture' => $picture
            ];
        }
        header("Location:../PHP/shop.php");
    }
}
else{
    header("Location:../HTML/login.html");
}
?>