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
    <link href="../CSS/shoppingcart.css" rel="stylesheet" />
</head>

<body>
    <?php require_once 'header.php';?>
    <!-- Hero Section -->
    <div class="hero-header">
        <h1>Useraccounts</h1>
    </div>
    </div>
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../PHP/useraccounts.php">Useraccounts</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">CustomerID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">City</th>
                        <th scope="col">Country</th>
                        <th scope="col">Active</th>
                        <th scope="col">Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT customerID, firstName, lastName, email, phoneNbr, street, houseNbr, postalcode, city, country, active, admin FROM customer";
                    $result = mysqli_query($link, $sql) or trigger_error("Failed to pull customer data from database", E_ERROR);
                    while ($row = mysqli_fetch_array($result)) {
                        $userdata = [];
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
                        $userdata["active"] = $row["active"];
                        $userdata["admin"] = $row["admin"];
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($userdata["customerID"]); ?></th>
                            <td><?php echo htmlspecialchars($userdata['firstName']), ' ', htmlspecialchars($userdata['lastName']); ?></td>
                            <td><?php echo htmlspecialchars($userdata["email"]); ?></td>
                            <td><?php echo htmlspecialchars($userdata["phoneNbr"]); ?></td>
                            <td><?php echo htmlspecialchars($userdata['street']), ' ', htmlspecialchars($userdata['houseNbr']) ?></td>
                            <td><?php echo htmlspecialchars($userdata['postalcode']), ' ', htmlspecialchars($userdata['city']) ?></td>
                            <td><?php echo htmlspecialchars($userdata['country']) ?></td>
                            <td><?php echo htmlspecialchars($userdata['active']) ?></td>
                            <td><?php echo htmlspecialchars($userdata['admin']) ?></td>
                            <td>
                                <form action="../PHP/activationUsers.php" method="POST" onsubmit=""><input type="hidden" id="customerID" name="customerID" value="<?php echo ($userdata["customerID"]); ?>"><input type="hidden" id="active" name="active" value="<?php echo ($userdata["active"]); ?>"><button type="submit" class="btn btn-primary" onclick=""><?php echo $userdata['active'] == 1 ? "Deactivate" : "Activate"; ?></button></form>
                            </td>
                            <td>
                                <form action="../PHP/changerole.php" method="POST" onsubmit=""><input type="hidden" id="customerID" name="customerID" value="<?php echo ($userdata["customerID"]); ?>"><input type="hidden" id="admin" name="admin" value="<?php echo ($userdata["admin"]); ?>"><button type="submit" class="btn btn-primary">Edit role</button></form>
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