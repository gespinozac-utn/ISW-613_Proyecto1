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