<?php
require_once('functions/functionsProduct.php');
require_once('class/classProduct.php');
require_once('class/classUser.php');

session_start();

$message;

if (empty($_SESSION['user'])) {
    header('location:/index.php');
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="shortcut icon" href="https://www.utn.ac.cr/misc/favicon.ico" type="image/vnd.microsoft.icon" />
    </head>

    <body>

        <div class="container">
            <?php require_once('header.php');
        if ($_GET) {
            createSection();
        } ?>

        </div>

    </body>

</html>


<?php

function loadComboBox($product)
{
    include_once('functions/functionsCategory.php');
    foreach (searchCategories() as $category) { ?>
<option value="<?php echo $category->get_id(); ?>"
    <?php echo ($product->getIdCategory() === $category->get_id()) ? 'selected' : '' ?>>
    <?php echo $category->get_name(); ?></option>
<?php }
}


function createSection()
{
    $product = productById($_REQUEST['id']);
    $message = "";
    ?>
<section>
    <form action="/CRUD/CRUDProducts.php?action=edit&id=<?php echo $product->getId(); ?>" method="POST"
        enctype="multipart/form-data">
        <h3 style="text-align: center;">Edit Product</h3>

        <div class="row">
            <div class="six columns">
                <label for="name">SKU code</label>
                <input type="text" class="u-full-width" name="sku" placeholder="SKU Code" required
                    value="<?php echo $product->getSKU(); ?>">
            </div>
            <div class="six columns">
                <label for="parent">Product name</label>
                <input type="text" name="name" placeholder="Product name" class="u-full-width" required
                    value="<?php echo $product->getName(); ?>">
            </div>
        </div>
        <div class=" row">
            <div class="six columns">
                <label for="parent">Image URL</label>
                <input type="file" name="imageURL" placeholder="Image URL" class="u-full-width"
                    accept="image/png,image/jpg,image/jpeg">
            </div>
            <div class=" six columns">
                <label for="name">Category</label>
                <!-- SELECT COMBOBOX  -->
                <select name="category" id="category" class="u-full-width">
                    <!-- <option value="-1">---</option> -->
                    <?php loadComboBox($product); ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="name">Stock</label>
                <input type="text" name="stock" placeholder="Stock" class="u-full-width"
                    value="<?php echo $product->getStock(); ?>">
            </div>
            <div class=" six columns">
                <label for="parent">Price</label>
                <input type="text" name="price" placeholder="Price" class="u-full-width"
                    value="<?php echo $product->getPrice(); ?>">
            </div>
        </div>
        <div class=" row">
            <div class="tewlve columns">
                <label for="name">Description</label>
                <textarea class="u-full-width" name="description" placeholder="Description"
                    required><?php echo $product->getDescription(); ?></textarea>
            </div>
        </div>
        <h6><?php echo $message; ?></h6>
        <div class=" row">
            <input type="submit" value="Save" class="button-primary u-pull-right">
        </div>
    </form>
</section>
<?php } ?>