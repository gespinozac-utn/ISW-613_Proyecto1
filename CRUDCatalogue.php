<?php
require_once('functionsProduct.php');
require_once('classProduct.php');
require_once('functionsCategory.php');
require_once('classCategory.php');
require_once('classUser.php');

function createCatalogue($idCategory)
{
    foreach (getAllProducts($idCategory) as $prod) {
        createProductCard($prod);
    }
}

function createProductCard($product)
{
    echo '
    <div class="product-card">
        <a href="#">
            <div class="product-image">
                <img src="' . $product->getImageURL() . '">
            </div>
        <div class="product-info">
            <h5>' . $product->getName() . '</h5>
            <h6>&#8353;' . $product->getPrice() . '</h6>
        </div>
        </a>
    </div>';
}