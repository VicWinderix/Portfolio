<?php
require 'errorHandler.php';

function exception_handler($exception) {
    echo "Exception: " . $exception->getMessage();
}
set_exception_handler('exception_handler');

session_start();

$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

try {
    $link = mysqli_connect($host, $username, $password);
    if (!$link) {
        throw new Exception("Error: Unable to connect to MySQL. " . mysqli_connect_error());
    }

    if (!mysqli_select_db($link, $database)) {
        throw new Exception("Failed to open database: " . mysqli_error($link));
    }

    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];
        $userAdmin = $_SESSION['admin'];

        $profilepic = "SELECT profile_picture FROM customer WHERE email = ?";
        $stmt = mysqli_prepare($link, $profilepic);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result) {
                $picresult = mysqli_fetch_array($result)['profile_picture'];
            } else {
                throw new Exception("Failed to fetch profile picture: " . mysqli_error($link));
            }
            mysqli_stmt_close($stmt);
        } else {
            throw new Exception("Failed to prepare statement: " . mysqli_error($link));
        }
    } else {
        $picresult = "emptyprofilepicture.jpeg";
        $userAdmin = 0;
    }
} catch (Exception $e) {
    exception_handler($e);
}
?>