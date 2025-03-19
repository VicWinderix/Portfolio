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
    <?php require_once 'header.php'?>
    <!-- Hero Section -->
    <div class="hero-header">
        <h1>Products</h1>
    </div>
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link" href="../PHP/orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../PHP/products.php">Products</a>
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
                        <th scope="col">ProductID</th>
                        <th scope="col">Product</th>
                        <th scope="col">Category</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Description</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Price</th>
                        <th scope="col">Active</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT products.productID, products.productName, categories.categoryName, products.creator, products.description, products.currentUnitCost, products.currentUnitPrice, products.active FROM products inner join categories on products.categoryID = categories.categoryID";
                    $result = mysqli_query($link, $sql) or trigger_error("Failed to pull product data from database", E_ERROR);;
                    while ($row = mysqli_fetch_array($result)) {
                        $productdata = [];
                        $productdata["productID"] = $row["productID"];
                        $productdata["productName"] = $row["productName"];
                        $productdata["categoryName"] = $row["categoryName"];
                        $productdata["creator"] = $row["creator"];
                        $productdata["description"] = $row["description"];
                        $productdata["currentUnitCost"] = $row["currentUnitCost"];
                        $productdata["currentUnitPrice"] = $row["currentUnitPrice"];
                        $productdata["active"] = $row["active"];
                    ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($productdata["productID"]); ?></th>
                            <td><?php echo htmlspecialchars($productdata["productName"]); ?></td>
                            <td><?php echo htmlspecialchars($productdata["categoryName"]); ?></td>
                            <td><?php echo htmlspecialchars($productdata["creator"]); ?></td>
                            <td><?php echo htmlspecialchars($productdata["description"]); ?></td>
                            <td>€<?php echo htmlspecialchars($productdata["currentUnitCost"]); ?></td>
                            <td>€<?php echo htmlspecialchars($productdata["currentUnitPrice"]) ?></td>
                            <td><?php echo htmlspecialchars($productdata["active"]) ?></td>
                            <td>
                                <form action="../PHP/activationProducts.php" method="POST" onsubmit="">
                                    <input type="hidden" id="productID" name="productID" value="<?php echo ($productdata["productID"]); ?>">
                                    <input type="hidden" id="active" name="active" value="<?php echo ($productdata["active"]); ?>">
                                    <button type="submit" class="btn btn-primary" onclick=""><?php echo $productdata['active'] == 1 ? "Deactivate" : "Activate"; ?></button>
                                </form>
                            </td>
                            <td>
                                <form action="../PHP/changeProducts.php" method="POST" onsubmit="">
                                    <input type="hidden" id="productID" name="productID" value="<?php echo ($productdata["productID"]); ?>">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </form>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                <a href="../PHP/addProduct.php"><button type="button" class="btn btn-primary">Add product</button></a>
                <div class="bd-example">
                    <button type="button" class="btn btn-primary gap-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Category
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../PHP/addCategory.php" method="POST" onsubmit="">
                            <div class="modal-body">
                                <label for="Category" class="form-label">Category name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName" value="" required>

                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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