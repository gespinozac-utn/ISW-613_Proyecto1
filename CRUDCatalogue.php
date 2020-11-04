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

function createSideMenu()
{
    foreach (filterByCategory(null) as $cat) {
        createListItem($cat);
    }
}

function createListItem($category)
{
    echo '
    <li>
        <a href="/catalogue.php?id=' . $category->get_id() . '">' . $category->get_name() . '</a>
    </li>
    ';
}

// <li>
//  <a href="#">All</a>
// </li>

// {{{ SUBCATEGORY SECTION }}}
// <span><strong>SubCategory</strong></span>
// <li>
//  <a href="#">Ropa de hombres</a>
// </li>