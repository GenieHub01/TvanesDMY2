<li class="nav-item shop-cartt">
    <a class="nav-link" href="#">
        <i class="fas fa-shopping-cart"></i>
        <span class="num-in" id="head-cart-count"><?= $product_count ?></span>
    </a>
    <div class="down-menu <?= ($product_count <= 0)? 'no-products': null?>" id="head-cart-inner">
        <? if($product_count > 0): ?>
            <div class="prods" id="head-cart-products">
                <? foreach ($products as $product):?>
                    <div class="eac-prod" data-id="<?= $product['id'] ?>">
                        <!--
                        <img src="images/Electric-Actuator-G-33-752406-6NW009206-767933-1-100x100.jpg" class="prod-img" alt="Electric-Actuator">
                        -->
                        <p class="prod-det"><?= $product['item']->title ?></p>
                        <span class="num-pri">
                            <span><?= $product['quantity'] ?></span>
                            x
                            <span><?= \Yii::$app->formatter->asCurrency($product['item']->regular_price ) ?></span>
                            <i class="fas fa-times remove-prod"></i>
                        </span>
                    </div>
                <? endforeach;?>
            </div>

            <div class="sub-tot">
                <p class="sub">Subtotal:</p>

                <p class="tot">
                    <span class="num" id="head-cart-total">
                        <?= \Yii::$app->formatter->asCurrency($total_sum) ?>
                    </span>
                </p>

            </div>

            <div class="view-check row">
                <div class="col-6">
                    <a href="/cart">
                        <button class="view hvr-bounce-to-top">VIEW CART</button>
                    </a>
                </div>

                <div class="col-6">
                    <a href="/cart">
                        <button class="chec">CHECKOUT</button>

                    </a>
                </div>
            </div>
            <p class="eac-item no-prods"></p>
        <? else: ?>
            <div class="prods" id="head-cart-products">
            </div>
            <div class="sub-tot">
                <p class="sub">Subtotal:</p>

                <p class="tot">
                    <span class="num" id="head-cart-total"></span>
                </p>

            </div>

            <div class="view-check row">
                <div class="col-6">
                    <a href="/cart">
                        <button class="view hvr-bounce-to-top">VIEW CART</button>
                    </a>
                </div>

                <div class="col-6">
                    <a href="/cart">
                        <button class="chec">CHECKOUT</button>

                    </a>
                </div>
            </div>
            <p class="eac-item no-prods">No products in the cart.</p>
        <? endif; ?>
    </div>
</li>
