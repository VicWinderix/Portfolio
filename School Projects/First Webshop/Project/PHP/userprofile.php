<?php
session_start();
if (isset($_SESSION['email'])) {

    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";

    

    $userEmail = $_SESSION['email'];

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $query = "SELECT customerID, firstName, lastName, email, phoneNbr, street, houseNbr, postalcode, city, country, profile_picture FROM customer WHERE email = '$userEmail'";
    $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    $numberRecords = mysqli_num_rows($result);

    $userdata = [
        "customerID" => "",
        "firstName" => "",
        "lastName" => "",
        "email" => "",
        "phoneNbr" => "",
        "street" => "",
        "houseNbr" => "",
        "postalcode" => "",
        "city" => "",
        "country" => "",
        "profile_picture" => ""
    ];
    while ($row = mysqli_fetch_array($result)) {
        $userdata["customerID"] = $row["customerID"];
        $userdata["firstName"] = $row["firstName"];
        $userdata["lastName"] = $row["lastName"];
        $userdata["email"] = $row["email"];
        $userdata["phoneNbr"] = $row["phoneNbr"];
        $userdata["street"] = $row["street"];
        $userdata["houseNbr"] = $row["houseNbr"];
        $userdata["postalcode"] = $row["postalcode"];
        $userdata["city"] = $row["city"];
        $userdata["country"] = $row["country"];
        $userdata["profile_picture"] = $row["profile_picture"];
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
    <link href="../CSS/userprofile.css" rel="stylesheet" />
    <link href="../CSS/testcart.css" rel="stylesheet" />
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
                <button type="button" class="btn btn-primary position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                        <img src="../Pictures/Icon's/cart.svg">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php $itemCount = count($_SESSION['cart']);
                                                                                                                        echo $itemCount; ?></span>
                    </button>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../Pictures/ProfilePictures/<?php echo htmlspecialchars($userdata['profile_picture']); ?>" alt="mdo" width="32" height="32"
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
    <section class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-section">
            <img src="../Pictures/ProfilePictures/<?php echo htmlspecialchars($userdata['profile_picture']); ?>" alt="Profile Picture" class="profile-pic">
            <div class="profile-header">
                <div class="profile-details">
                    <h4>Name: <?php echo htmlspecialchars($userdata['firstName']), ' ', htmlspecialchars($userdata['lastName']); ?></h4>
                    <p><strong>Email: </strong><?php echo htmlspecialchars($userdata['email']); ?></p>
                    <p><strong>Phone: </strong><?php echo htmlspecialchars($userdata['phoneNbr']); ?></p>
                    <p><strong>Address: </strong></p>
                    <p><?php echo htmlspecialchars($userdata['street']), ' ', htmlspecialchars($userdata['houseNbr']); ?></p>
                    <p><?php echo htmlspecialchars($userdata['postalcode']), ' ', htmlspecialchars($userdata['city']); ?></p>
                    <p><?php echo htmlspecialchars($userdata['country']); ?></p>
                </div>
            </div>
        </div>
        <div class="orders-section">
            <h2>Previous Orders</h2>
            <?php
            $orderquery = "SELECT o.OrderID 'orderID', o.OrderDate 'orderDate', SUM(od.UnitPrice) 'totalPrice' FROM Orders o inner join orderdetails od on o.OrderID = od.OrderID  where o.customerID = {$userdata['customerID']} group by o.OrderID, o.OrderDate";
            $orderresult = mysqli_query($link, $orderquery) or trigger_error("Failed to pull order details from database", E_ERROR);
            $orderdata = [
                "orderID" => "",
                "orderDate" => "",
                "totalPrice" => "",
            ];
            while ($row = mysqli_fetch_array($orderresult)) {
                $orderdata["orderID"] = $row["orderID"];
                $orderdata["orderDate"] = $row["orderDate"];
                $orderdata["totalPrice"] = $row["totalPrice"];
            ?>
                <div class="order-item">
                    <p><strong>Order #<?php echo htmlspecialchars($orderdata['orderID']); ?></strong></p>
                    <p><strong>Date: </strong><?php echo htmlspecialchars($orderdata['orderDate']); ?></p>
                    <p><strong>Total: </strong> €<?php echo htmlspecialchars($orderdata['totalPrice']); ?></p>
                </div>
            <?php
            } ?>
        </div>
        <div class="buttoncontainer">
            <a href="../PHP/logout.php" class="logoutbtn">log out</a>
            <a href="../PHP/changeprofile.php" class="editbtn">Edit Profile</a>
            <div class="bd-example">
                    <button type="button" class="editbtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Change password
                    </button>
            </div>
            <a href="../PHP/delprofile.php" class="logoutbtn">Delete profile</a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Change password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../PHP/changePassword.php" method="POST" onsubmit="">
                            <div class="modal-body">
                                <label for="Category" class="form-label">Old password</label>
                                <input type="password" class="form-control" id="oldpass" name="oldpass" value="" required>

                                <label for="description" class="form-label">New password</label>
                                <input type="password" class="form-control" id="newpass" name="newpass" value="">

                                <label for="description" class="form-label">Confirm new password</label>
                                <input type="password" class="form-control" id="confnewpass" name="confnewpass" value="">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once 'shoppingcart.php';?>
    <?php require_once 'footer.php';?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>
<?php
mysqli_close($link);
?>