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
    <link href="../CSS/shop.css" rel="stylesheet" />
    <link href="../CSS/testcart.css" rel="stylesheet" />
</head>

<body>
    <?php require_once 'header.php' ?>
    <!-- Hero Section -->
    <div class="hero-header text-center">
        <h1>Our products</h1>
        <p>Discover handy tools, satisfieng fidgets toys and much more!</p>
        <select id="categoryFilter" class="form-select small-select">
            <option value="0">All Categories</option>
            <?php
            $categories = mysqli_query($link, "SELECT categoryID, categoryName FROM categories");
            while ($category = mysqli_fetch_assoc($categories)) {
                echo '<option value="' . $category['categoryID'] . '">' . htmlspecialchars($category['categoryName']) . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="container mt-4">
        <div id="products" class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        </div>
    </div>
    <?php require_once 'shoppingcart.php' ?>
    <?php require_once 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                method: 'POST',
                url: 'filter.php',
                data: {
                    categoryID: 0
                },
                success: function(response) {
                    $('#products').html(response);
                }
            });

            $('#categoryFilter').on('change', function() {
                $.ajax({
                    method: 'POST',
                    url: 'filter.php',
                    data: {
                        categoryID: $(this).val()
                    },
                    success: function(response) {
                        $('#products').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>
<?php
mysqli_close($link);
?>