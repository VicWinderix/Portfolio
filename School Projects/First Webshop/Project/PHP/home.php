<?php
require_once 'database.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3D Print Store</title>
    <link href="../CSS/reset.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../CSS/home.css" rel="stylesheet" />
    <link href="../CSS/testcart.css" rel="stylesheet" />
</head>

<body>
    <?php require_once 'header.php';?>
    <!-- Hero Section -->
    <div class="hero-header">
        <h1>Welcome to the World of 3D Printing</h1>
        <p>Discover the latest in 3D printing technology, from printers to filament, and much more!</p>
        <a href="../PHP/shop.php" class="btn btn-primary">Shop now</a>
    </div>
    <!-- Top Sellers Section -->
    <section class="products text-center bg-white">
        <h2 class="topsell">Top Sellers</h2>
        <div class="container mt-4">
        <div id="productContainer" class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <?php
            $sql = "SELECT productID, productName, description, creator, currentUnitPrice, picture FROM products WHERE products.active = 1 limit 3";
            $result = mysqli_query($link, $sql) or trigger_error("Couldn't pull product data from the database", E_ERROR);;
            while ($row = mysqli_fetch_array($result)) {
                $productdata = [];
                $productdata["productID"] = $row["productID"];
                $productdata["productName"] = $row["productName"];
                $productdata["description"] = $row["description"];
                $productdata["creator"] = $row["creator"];
                $productdata["currentUnitPrice"] = $row["currentUnitPrice"];
                $productdata["picture"] = $row["picture"];
            ?>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="../Pictures/ProductPictures/<?php echo htmlspecialchars($productdata['picture']); ?>" class="card-img-top" \
                                alt="Picture <?php echo htmlspecialchars($productdata['productName']); ?>">
                            <h5 class="card-title"><?php echo htmlspecialchars($productdata['productName']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($productdata['description']) ?></p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <span class=" btn btn-secondary disabled">Price: €<?php echo htmlspecialchars($productdata['currentUnitPrice']); ?></span>
                                </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    </section>
    <?php require_once 'shoppingcart.php'?>
    <?php require_once 'footer.php'?>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>