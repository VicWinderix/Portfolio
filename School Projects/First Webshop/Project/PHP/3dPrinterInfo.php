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
    <link href="../CSS/3d-printer.css" rel="stylesheet" />
    <link href="../CSS/testcart.css" rel="stylesheet" />
</head>

<body>
    <?php require_once 'header.php'; ?>
    <!-- Hero Section -->
    <div class="hero-header">
        <h1>Bambulab A1</h1>
        <p>An amazing 3D printer that prints all of our products</p>
    </div>
    <div class="printer-info-section">
    <div class="text-image-container">
        <div class="text-content">
            <h2>Bambulab A1</h2>
            <p>The Bambulab A1 is a groundbreaking 3D printer renowned for its user-friendly design, high performance, and advanced features. Designed for both hobbyists and professionals, this machine delivers a seamless experience by combining precision, speed, and smart technologies.</p>
        </div>
        <div class="image-content">
            <img src="../Pictures/Printer.png" alt="Bambulab A1 Printer">
        </div>
    </div>
</div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Speed and Precision
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>The A1 is equipped with a powerful motion control engine, allowing it to print exceptionally fast without sacrificing accuracy. With layer heights as fine as 0.1 mm, it produces sharp details and smooth finishes.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Multi-Material Support
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Thanks to an integrated AMS (Automatic Material System), the Bambulab A1 supports multi-color and multi-material printing. It is compatible with PLA, PETG, ABS, TPU, and even advanced composites like fiber-reinforced filaments.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Automation and AI
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>The printer leverages AI-powered features, such as automatic bed leveling, filament detection, and error prediction. These smart systems ensure a hassle-free printing experience while minimizing the need for manual intervention.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Robust and Compact Design
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>The sleek and sturdy design of the A1 makes it suitable for a variety of environments, from home offices to professional workshops. Its compact size ensures it doesn’t take up excessive space.</p>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'shoppingcart.php' ?>
    <?php require_once 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>