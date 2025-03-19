<?php
session_start();
if (isset($_SESSION['email'])){
    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");
    mysqli_select_db($link, $database) or trigger_error("Failed to open database", E_ERROR);
    mysqli_close($link);
}
else{
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - 3D Print Store</title>
    <link href="../CSS/reset.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../CSS/signup.css" rel="stylesheet" />
    <script src="../JAVA/singupvalidaton.js"></script>
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
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../Pictures/ProfilePictures/emptyprofilepicture.jpeg" alt="mdo" width="32" height="32"
                            class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small">
                        <li><a class="dropdown-item" href="../PHP/userprofile.php">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../PHP/logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <section class="signup-section">
        <div class="form-container">
            <h2>Fill in your data</h2>
            <form action="../PHP/placeOrder.php" method="POST" class="signup-form" onsubmit="return validateAndSubmit()">

                <label for="street">Street</label>
                <input type="text" id="street" name="street" required>

                <label for="house-number">House Number</label>
                <input type="text" id="house-number" name="house-number" required>

                <label for="postal-code">Postal Code</label>
                <input type="text" id="postal-code" name="postal-code" required>

                <label for="city">City</label>
                <input type="text" id="city" name="city" required>

                <label for="country">Country</label>
                <input type="text" id="country" name="country" required>

                <p>In case we want to contact you, we will send an email to ... or we will call to this number: ...</p>

                <button type="submit" class="cta">Pay</button>
            </form>
        </div>
    </section>
    <footer>
        <p>&copy; 2023 3D Print Store | All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>