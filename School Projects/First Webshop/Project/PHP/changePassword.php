<?php
require_once 'database.php';
require 'errorHandler.php';
set_error_handler("handleErrors");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userEmail = $_SESSION['email'];
    $oldpass = htmlspecialchars(trim($_POST['oldpass']));
    $newpass = htmlspecialchars(trim($_POST['newpass']));
    $confnewpass = htmlspecialchars(trim($_POST['confnewpass']));


    $link = mysqli_connect($host, $username, $password, $database) or trigger_error("Failed to open database", E_ERROR);

    $stmt = $link->prepare("SELECT password FROM customer WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedHash = $row['password'];

        if (password_verify($oldpass, $storedHash)) {
            if ($newpass === $confnewpass) {
                $hashedNewPassword = password_hash($newpass, PASSWORD_DEFAULT);
                $updateStmt = $link->prepare("UPDATE customer SET password = ? WHERE email = ?");
                $updateStmt->bind_param("ss", $hashedNewPassword, $userEmail);

                if ($updateStmt->execute()) {
                    echo "Password updated successfully.";
                } else {
                    trigger_error("Failed updating password from $userEmail", E_USER_NOTICE);
                }
            } else {
                echo "New passwords do not match.";
            }
        } else {
            echo "Old password is incorrect.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
    $link->close();
} else {
    trigger_error("Wrong request send to change password", E_WARNING);
}
header("Location:../PHP/useraccounts.php");
?>