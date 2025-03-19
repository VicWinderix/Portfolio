<?php
// Start de sessie
session_start();

// Databaseverbinding
$host = "localhost";
$username = "Webuser";
$password = "Lab2024";
$database = "3d-shop";

$link = mysqli_connect($host, $username, $password) or die(json_encode(['error' => 'Database connection failed']));
mysqli_select_db($link, $database) or die(json_encode(['error' => 'Database selection failed']));

// Ontvang de category_id parameter
$categoryID = isset($_POST['categoryID']) ? intval($_POST['categoryID']) : 0;

// Query om producten op te halen
if ($categoryID === 0) {
    $query = "SELECT productID, productName, description, currentUnitPrice, picture FROM products";
    $stmt = mysqli_prepare($link, $query);
} else {
    $query = "SELECT productID, productName, description, currentUnitPrice, picture FROM products WHERE categoryID = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $categoryID);
}

// Voer de query uit
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo json_encode(['error' => 'Error fetching products']);
    exit;
}


// Zet de producten in een array
$output = '';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '
    <div class="col">
        <div class="card text-center">
            <div class="card-body">
                <img src="../Pictures/ProductPictures/' . htmlspecialchars($row['picture']) . '" class="card-img-top" alt="' . htmlspecialchars($row['productName']) . '">
                <h5 class="card-title">' . htmlspecialchars($row['productName']) . '</h5>
                <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <form action="../PHP/addToCart.php" method="POST">
                        <input type="hidden" id="productID" name="productID" value="' . htmlspecialchars($row['productID']) . '">
                        <input type="hidden" id="productName" name="productName" value="' . htmlspecialchars($row['productName']) . '">
                        <input type="hidden" id="price" name="price" value="' . htmlspecialchars($row['currentUnitPrice']) . '">
                        <input type="hidden" id="picture" name="picture" value="' . htmlspecialchars($row['picture']) . '">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    <span class="btn btn-secondary disabled">Price: €' . htmlspecialchars($row['currentUnitPrice']) . '</span>
                </div>
            </div>
        </div>
    </div>';
}

echo $output;

// Sluit de databaseverbinding
mysqli_close($link);
?>