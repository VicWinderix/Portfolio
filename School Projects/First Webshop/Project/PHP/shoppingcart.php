<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Shoppingcart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group">
                <?php
                if (!empty($_SESSION['cart'])) {
                    $totalPrice = 0;

                    foreach ($_SESSION['cart'] as $productID => $product) {
                        $itemTotal = $product['price'] * $product['quantity'];
                        $totalPrice += $itemTotal;
                ?>
                        <!-- Product -->
                        <div class="list-group-item cart-item d-flex align-items-center">
                            <img src="../Pictures/ProductPictures/<?php echo htmlspecialchars($product['picture']); ?>" alt="Picture <?php echo htmlspecialchars($product['name']); ?>" class="img-thumbnail me-3">
                            <div class="flex-grow-1">
                                <h10 class="mb-0"><?php echo htmlspecialchars($product['name']); ?></h10>
                                <p class="mb-0">Price: </strong>€<?php echo htmlspecialchars($product['price']); ?></p>
                                <p class="mb-0">Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
                            </div>
                            <div class="ms-3">
                                <p class="text-end">Total: €<?php echo htmlspecialchars($totalPrice); ?></p>
                                <form action="../PHP/delFromCart.php" method="POST" onsubmit="">
                                    <input type="hidden" id="productID" name="productID" value="<?php echo ($productID); ?>">
                                    <input type="hidden" id="quantity" name="quantity" value="<?php echo ($product["quantity"]); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <p class="total-price">Total Price: €<?php echo htmlspecialchars($totalPrice); ?></p>
                        <a href="../PHP/checkout.php"><button class="btn btn-checkout">Proceed to Checkout</button></a>
                    </div><?php } ?>
            </div>
        </div>
    </div>