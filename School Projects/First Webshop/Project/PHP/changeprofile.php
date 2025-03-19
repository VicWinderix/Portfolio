<?php
session_start();
if (isset($_SESSION['email'])) {

    $host = "localhost";
    $username = "Webuser";
    $password = "Lab2024";
    $database = "3d-shop";

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $userEmail = $_SESSION['email'];

    $link = mysqli_connect($host, $username, $password) or die("Error: no connection can be made to the host");

    mysqli_select_db($link, $database) or die("Error: the database could not be opened");

    $query = "SELECT firstName, lastName, email, phoneNbr, street, houseNbr, postalcode, city, country, profile_picture FROM customer WHERE email = '$userEmail'";
    $result = mysqli_query($link, $query) or trigger_error("Failed to pull user data from database", E_ERROR);;
    $numberRecords = mysqli_num_rows($result);

    $userdata = [
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
    //session variable isn't registered, send back to login page
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
            <h2>Change your cridentials</h2>
            <form action="../PHP/updateProfile.php" method="POST" class="signup-form" onsubmit="">

                <label for="firstName">Firstname</label>
                <input type="firstName" id="firstName" name="firstName" value="<?php echo ($userdata["firstName"]); ?>" required>

                <label for="lastName">Lastname</label>
                <input type="lastName" id="lastName" name="lastName" value="<?php echo ($userdata["lastName"]); ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo ($userdata["email"]); ?>" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?php echo ($userdata["phoneNbr"]); ?>">

                <label for="street">Street</label>
                <input type="text" id="street" name="street" value="<?php echo ($userdata["street"]); ?>" required>

                <label for="house-number">House Number</label>
                <input type="text" id="house-number" name="house-number" value="<?php echo ($userdata["houseNbr"]); ?>" required>

                <label for="postal-code">Postal Code</label>
                <input type="text" id="postal-code" name="postal-code" value="<?php echo ($userdata["postalcode"]); ?>" required>

                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo ($userdata["city"]); ?>" required>

                <label for="country">Country</label>
                <input type="text" id="country" name="country" value="<?php echo ($userdata["country"]); ?>" required>

                <button type="submit" class="cta">Save changes</button>
            </form>
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