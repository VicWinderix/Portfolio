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
    <?php require_once 'header.php'?>
    <!-- Hero Section -->
    <div class="hero-header">
        <h1>Orders</h1>
    </div>
    </div>
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="../PHP/terminal.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/useraccounts.php">Useraccounts</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">OrderID</th>
                        <th scope="col">CustomerID</th>
                        <th scope="col">OrderDate</th>
                        <th scope="col">ShippingDate</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Country</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT orderID, customerID, orderDate, shippedDate, shipStreet,	shipHouseNumber, shipPostalcode, shipCity, shipCountry FROM orders";
                    $result = mysqli_query($link, $sql) or trigger_error("Failed to pull order data from database", E_ERROR);;
                    while ($row = mysqli_fetch_array($result)) {
                        $orderdata = [];
                        $orderdata["orderID"] = $row["orderID"];
                        $orderdata["customerID"] = $row["customerID"];
                        $orderdata["orderDate"] = $row["orderDate"];
                        $orderdata["shippedDate"] = $row["shippedDate"];
                        $orderdata["shipStreet"] = $row["shipStreet"];
                        $orderdata["shipHouseNumber"] = $row["shipHouseNumber"];
                        $orderdata["shipPostalcode"] = $row["shipPostalcode"];
                        $orderdata["shipCity"] = $row["shipCity"];
                        $orderdata["shipCountry"] = $row["shipCountry"];
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($orderdata['orderID']); ?></th>
                            <td><?php echo htmlspecialchars($orderdata['customerID']); ?></td>
                            <td><?php echo htmlspecialchars($orderdata['orderDate']); ?></td>
                            <td><?php echo htmlspecialchars($orderdata['shippedDate']); ?></td>
                            <td><?php echo htmlspecialchars($orderdata['shipStreet']), ' ', htmlspecialchars($orderdata['shipHouseNumber']) ?></td>
                            <td><?php echo htmlspecialchars($orderdata['shipPostalcode']), ' ', htmlspecialchars($orderdata['shipCity']) ?></td>
                            <td><?php echo htmlspecialchars($orderdata['shipCountry']) ?></td>
                            <td>
                                <form action="../PHP/orderDetails.php" method="POST" onsubmit="">
                                    <input type="hidden" id="orderID" name="orderID" value="<?php echo htmlspecialchars($orderdata['orderID']); ?>">
                                    <button type="submit" class="btn btn-primary">View Details</button>
                                </form>
                            </td>
                            <td>
                                <form action="../PHP/shipOrder.php" method="POST" onsubmit="">
                                    <input type="hidden" id="orderID" name="orderID" value="<?php echo htmlspecialchars($orderdata['orderID']); ?>">
                                    <button type="submit" class="btn btn-primary">ship order</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Footer -->
    <?php require_once 'shoppingcart.php'?>
    <?php require_once 'footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>