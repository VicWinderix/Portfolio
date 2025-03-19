<?php 
session_start();
if (isset($_SESSION['email']) and $_SESSION['admin'] == 1) {
    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $orderID = htmlspecialchars(trim($_POST['orderID']));
    }

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);

    $shipDate = date("Y-m-d");
    $sql = ("SELECT orderdetails.*, products.productName FROM orderdetails inner join products on orderdetails.productID = products.productID WHERE orderID = '$orderID'");
    $resultOrderID = mysqli_query($link, $sql) or trigger_error("Failed to pull order data form database", E_ERROR);;

    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];
        $profilepic = "SELECT profile_picture FROM customer c WHERE c.email = \"$userEmail\"";
        $result = mysqli_query($link, $profilepic);
        $picresult = mysqli_fetch_array($result)['profile_picture'];
    } else {
        $picresult = "emptyprofilepicture.jpeg";
    }
} else {
    header("Location: ../HTML/login.html");
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
                    <li class="nav-item"><a href="../HTML/home.html" class="nav-link px-2 link-secondary active"
                            aria-current="page">Home</a></li>
                    <li class="nav-item"></li><a href="../PHP/shop.php"
                        class="nav-link px-2 link-body-emphasis">Shop</a></li>
                    <li class="nav-item"></li><a href="#" class="nav-link px-2 link-body-emphasis">3D printer info</a>
                    </li>
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
                            <?php if ($_SESSION['admin'] == 1) {
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
    <!-- Hero Section -->
    <div class="hero-header">
        <h1>Order #<?php echo htmlspecialchars($orderID)?></h1>
    </div>
    </div>
    <div class="card text-center">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody><?php
                while ($row = mysqli_fetch_array($resultOrderID)) {
                    $orderdata = [];
                    $orderdata["productName"] = $row["productName"];
                    $orderdata["unitPrice"] = $row["unitPrice"];
                    $orderdata["quantity"] = $row["quantity"];
                    $orderdata["discount"] = $row["discount"];
                    $orderdata["price"] = $orderdata["unitPrice"] * $orderdata["quantity"] * (1-$orderdata["discount"]);
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($orderdata['productName']); ?></td>
                            <td><?php echo htmlspecialchars($orderdata['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($orderdata['discount']); ?></td>
                            <td>€<?php echo htmlspecialchars($orderdata['price']); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <a href="../PHP/orders.php"><button type="button" class="btn btn-primary">Return to orders</button></a>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                        <svg class="bi" width="30" height="24">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <span class="mb-3 mb-md-0 text-body-secondary">© 2024 Company, Inc</span>
                </div>
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </footer>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>