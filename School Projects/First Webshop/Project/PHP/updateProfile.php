<?php
session_start();
if (isset($_SESSION['email'])) {
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

        $firstName = htmlspecialchars(trim($_POST['firstName']));
        $lastName = htmlspecialchars(trim($_POST['lastName']));
        $mail = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $street = htmlspecialchars(trim($_POST['street']));
        $houseNbr = htmlspecialchars(trim($_POST['house-number']));
        $postalCode = htmlspecialchars(trim($_POST['postal-code']));
        $city = htmlspecialchars(trim($_POST['city']));
        $country = htmlspecialchars(trim($_POST['country']));
    }
    $email = $_SESSION['email'];
    $sql = "UPDATE customer SET firstName='$firstName', lastName='$lastName', email='$mail', phoneNbr='$phone', street='$street', houseNbr=$houseNbr, postalcode=$postalCode, city='$city', country='$country' where email = '$email'";

    mysqli_query($link, $sql) or trigger_error("Failed to update customer data for $email", E_ERROR);
    header("Location:../PHP/userprofile.php");

    mysqli_close($link);
}
