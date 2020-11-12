<?php
require_once('functionsProduct.php');
require_once('classProduct.php');
require_once('functionsCategory.php');
require_once('classCategory.php');
require_once('classUser.php');

function createCatalogue($idCategory)
{
    foreach (filterByCategory($idCategory) as $prod) {
        createProductCard($prod);
    }
}

function createProductCard($product)
{
    echo '
    <div class="product-card">
        <a href="/catalogue.php?preview=' . $product->getId() . '">
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

function createSideMenu($idPa = null)
{
    if (empty($idPa)) {
        $idPa = !empty($idPa) ? $idPa : '---';
        foreach (searchCategories($idPa) as $cat) {
            createListItem($cat);
        }
    } else {
        // Create Parent label
        $parent = categoryById($idPa);
        $prevParent = categoryByName(new Category($parent->get_parent()));
        if ($prevParent) {
            createListItem($prevParent);
        }
        createListItem($parent, true);

        //create children categories
        $childs = getAllChild($idPa);
        if (!empty($childs)) {
            echo '<span><strong>SubCategory</strong></span>';
            foreach ($childs as $child) {
                createListItem($child);
            }
        }
    }
}

function createListItem($category, $active = false)
{
    $name = $active ? '<strong> > </strong>' . $category->get_name() : $category->get_name();
    echo '
    <li>
        <a href="/catalogue.php?id=' . $category->get_id() . '">' . $name . '</a>
    </li>
    ';
}

function previewProduct($idProd)
{
    $product = productById($idProd);
    echo '
    <div class="row u-full-width">
        <div class="three columns u-full-width"> &nbsp;</div>
        <div class="nine columns">
            <h2>' . $product->getName() . '</h2>
        </div>
    </div>

    <div class="row u-full-width">
        <div class="one column">&nbsp;</div>
        <div class="four columns">
            <img src="' . $product->getImageURL() . '" style="height:200px;width:200px;">
        </div>
        <div class="seven columns">
            <p>' . $product->getDescription() . '</p>
        </div>
    </div>

    <div class="row u-wull-width">
        <div class="twelve columns u-full-width">
            <h5><strong>' . $product->getSKU() . '</strong></h5>
        </div>
    </div>

    <div class="row u-full-width">
        <div class="four columns u-full width">
            <h4><strong>Price:</strong>&#8353; ' . $product->getPrice() . '</h4>
        </div>
        <div class="six columns u-full width">
            <h5 class="u-pull-right"><strong>Stock:</strong> ' . $product->getStock() . '</h5>
        </div>
    </div>
    
    <div class="row u-full-width">
        <form action="#?id=' . $product->getId() . '">
            <div class="nine columns">
                <input type="number" name="quantity" class="u-pull-right" value="1" min="1" max="' . $product->getStock() . '" require>
            </div>
            <div class="one columns">
                &nbsp;
            </div>
            <div class="two colmuns">
                <input type="submit" value="Add"  class="button button-primary">
            </div>
        </form>
    </div>
    ';
}