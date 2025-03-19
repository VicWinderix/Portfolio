<?php
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productID = htmlspecialchars($_POST['productID']);
        $quantity = htmlspecialchars($_POST['quantity']);

        if (!isset($_SESSION['cart'])) {
            throw new Exception("Shopping cart does not exist.");
        }

        if (isset($_SESSION['cart'][$productID])) {
            unset($_SESSION['cart'][$productID]);
        } else {
            throw new Exception("Product not found in the shopping cart.");
        }

        header("Location: ../PHP/shop.php");
        exit;
    }
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_ERROR);
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
