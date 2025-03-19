<?php
// Verbinding maken met de database
$host = "localhost"; // Pas aan naar je host
$username = "Webuser";  // Pas aan naar je database-gebruiker
$password = "Lab2024";      // Pas aan naar je database-wachtwoord
$database = "3d-shop"; // Pas aan naar je database-naam

$link = mysqli_connect($host, $username, $password, $database);

if (!$link) {
    die("Error: Could not connect to the database: " . mysqli_connect_error());
}

// Haal alle gebruikers op
$query = "SELECT customerID, password FROM customer";
$result = mysqli_query($link, $query);

if (!$result) {
    die("Error: Could not fetch data from the database.");
}

while ($row = mysqli_fetch_assoc($result)) {
    $customerID = $row['customerID'];
    $plainPassword = $row['password'];

    // Hash het wachtwoord
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // Update de database met het gehashte wachtwoord
    $updateQuery = "UPDATE customer SET password = ? WHERE customerID = ?";
    $stmt = mysqli_prepare($link, $updateQuery);
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $customerID);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Password for customer ID $customerID updated successfully.<br>";
    } else {
        echo "Failed to update password for customer ID $customerID.<br>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>