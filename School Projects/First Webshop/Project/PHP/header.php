<header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <ul class="nav nav-underline col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="nav-item"><a href="../PHP/home.php" class="nav-link px-2 link-secondary"
                            aria-current="page">Home</a></li>
                    <li class="nav-item"></li><a href="../PHP/shop.php"
                        class="nav-link px-2 link-body-emphasis">Shop</a></li>
                    <li class="nav-item"></li><a href="../PHP/3dPrinterInfo.php" class="nav-link px-2 link-body-emphasis">3D printer info</a></li>
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