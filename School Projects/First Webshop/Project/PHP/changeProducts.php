<?php
require_once 'database.php';
require_once 'errorHandler.php';

if (isset($_SESSION['email']) and $_SESSION['admin'] == 1) {
    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $productID = htmlspecialchars(trim($_POST['productID']));
    }

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    $sql = "SELECT productID, productName, categoryID, creator, description, currentUnitCost, currentUnitPrice, picture FROM products where productID = $productID";
    $result = mysqli_query($link, $sql) or trigger_error("Failed to pull product data from database", E_ERROR);;
    $productdata = [
        "productID" => "",
        "productName" => "",
        "categoryID" => "",
        "creator" => "",
        "description" => "",
        "currentUnitCost" => "",
        "currentUnitPrice" => "",
        "picture" => ""
    ];
    while ($row = mysqli_fetch_array($result)) {
        $productdata = [];
        $productdata["productID"] = $row["productID"];
        $productdata["productName"] = $row["productName"];
        $productdata["categoryID"] = $row["categoryID"];
        $productdata["creator"] = $row["creator"];
        $productdata["description"] = $row["description"];
        $productdata["currentUnitCost"] = $row["currentUnitCost"];
        $productdata["currentUnitPrice"] = $row["currentUnitPrice"];
        $productdata["picture"] = $row["picture"];
    }

    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];
        $userAdmin = $_SESSION['admin'];
        $profilepic = "SELECT profile_picture FROM customer c WHERE c.email = \"$userEmail\"";
        $result = mysqli_query($link, $profilepic);
        $picresult = mysqli_fetch_array($result)['profile_picture'];
    } else {
        $picresult = "emptyprofilepicture.jpeg";
        $userAdmin = 0;
    }
    
} else {
    header("Location: ../HTML/login.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - 3D Print Store</title>
    <link href="../CSS/reset.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../CSS/signup.css" rel="stylesheet" />
</head>

<body>
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <ul class="nav nav-underline col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="nav-item"><a href="../PHP/home.php" class="nav-link px-2 link-secondary" aria-current="page">Home</a></li>
                    <li class="nav-item"></li><a href="../PHP/shop.php" class="nav-link px-2 link-body-emphasis">Shop</a></li>
                    <li class="nav-item"></li><a href="#" class="nav-link px-2 link-body-emphasis">3D printer info</a></li>
                </ul>
                <div class="d-grid gap-4 d-md-flex justify-content-md-center">
                    <button type="button" class="btn btn-primary position-relative ">
                        <img src="../Pictures/Icon's/cart.svg">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php $itemCount = count($_SESSION['cart']);
                                                                                                                        echo $itemCount; ?></span>
                    </button>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../Pictures/ProfilePictures/<?php echo htmlspecialchars($picresult) ?>" alt="mdo" width="32" height="32"
                                class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-small">
                            <li><a class="dropdown-item" href="../PHP/userprofile.php">Profile</a></li>
                            <?php if ($userAdmin == 1) {
                                echo ('<li><a class="dropdown-item" href="../PHP/orders.php">Dashboard</a></li>');
                            } ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../PHP/logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="signup-section">
        <div class="form-container">
            <h2>Change product cridentials</h2>
            <form action="../PHP/updateProducts.php" method="POST" class="signup-form" onsubmit="">

                <label for="productName">Productname</label>
                <input type="text" id="productName" name="productName" value="<?php echo ($productdata["productName"]); ?>" required>

                <label for="categoryID">CategoryID</label>
                <input type="text" id="categoryID" name="categoryID" value="<?php echo ($productdata["categoryID"]); ?>" required>

                <label for="creator">Creator</label>
                <input type="text" id="creator" name="creator" value="<?php echo ($productdata["creator"]); ?>" required>

                <label for="description">Description</label>
                <input type="text" id="description" name="description" value="<?php echo ($productdata["description"]); ?>">

                <label for="currentUnitCost">CurrentUnitCost</label>
                <input type="text" id="currentUnitCost" name="currentUnitCost" value="<?php echo ($productdata["currentUnitCost"]); ?>" required>

                <label for="currentUnitPrice">CurrentUnitPrice</label>
                <input type="text" id="currentUnitPrice" name="currentUnitPrice" value="<?php echo ($productdata["currentUnitPrice"]); ?>" required>

                <label for="picture">Picture</label>
                <input type="text" id="picture" name="picture" value="<?php echo ($productdata["picture"]); ?>" required>
                <input type="hidden" id="productID" name="productID" value="<?php echo ($productdata["productID"]); ?>" required>

                <button type="submit" class="cta">Save changes</button>
            </form>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>
<?php
mysqli_close($link);
?>