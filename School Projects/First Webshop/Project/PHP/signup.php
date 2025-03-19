<?php
require 'errorHandler.php';
set_error_handler("handleErrors");

$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $username, $password);
if (!$link) {
    die("Error: Unable to connect to MySQL. " . mysqli_connect_error());
}

if (!mysqli_select_db($link, $database)) {
    die("Error: Failed to open database. " . mysqli_error($link));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = password_hash(htmlspecialchars(trim($_POST['password'])), PASSWORD_DEFAULT);
    $confirmPassword = htmlspecialchars(trim($_POST['confirm-password']));
    $street = htmlspecialchars(trim($_POST['street']));
    $houseNbr = htmlspecialchars(trim($_POST['house-number']));
    $postalCode = htmlspecialchars(trim($_POST['postal-code']));
    $city = htmlspecialchars(trim($_POST['city']));
    $country = htmlspecialchars(trim($_POST['country']));

    // Voeg admin en active toe met vaste waarden
    $admin = 0;
    $active = 1;

    $sql = "INSERT INTO customer (firstName, lastName, admin, active, email, password, phoneNbr, street, houseNbr, postalcode, city, country) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($link, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssisssssssss", $firstName, $lastName, $admin, $active, $email, $password, $phone, $street, $houseNbr, $postalCode, $city, $country);

        if (!mysqli_stmt_execute($stmt)) {
            trigger_error("Failed to create new customer: " . mysqli_stmt_error($stmt), E_USER_NOTICE);
        }

        mysqli_stmt_close($stmt);
    } else {
        trigger_error("Failed to prepare statement: " . mysqli_error($link), E_USER_NOTICE);
    }

    header("Location:../HTML/login.html");
    exit();
} else {
    trigger_error("Invalid request method", E_USER_NOTICE);
}

mysqli_close($link);
?>