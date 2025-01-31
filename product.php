<?php
require_once('class/classUser.php');
require_once('functions/functionsProduct.php');
session_start();
$user = $_SESSION['user'];
if (empty($_SESSION) || $user->get_role() != 'Administrador') {
    header('location:/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="https://www.utn.ac.cr/misc/favicon.ico" type="image/vnd.microsoft.icon" />
</head>

<body>

    <div class="container">
        <?php require_once('header.php') ?>

        <section>
            <h3 style="text-align: center;">Product</h3>
            <div class="container">
                <div class="row">
                    <div class="six columns">
                        <a href="createProduct.php" class="button button-primary">Create</a>
                    </div>
                    <div class="six columns">
                        <div class="u-pull-right">
                            <form action="/product.php" method="GET">
                                <input type="text" placeholder="Search" name="search" title="Search for name">
                                <button type="submit"><i class="fas fa-search" style="color:grey"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="u-full-width">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Utility</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php loadTable(); ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</body>

</html>

<?php


function loadTable()
{
    include_once('functions/functionsCategory.php');
    $products = searchProduct($_GET ? $_REQUEST['search'] : "");

    foreach ($products as $product) {
        $category = categoryById($product->getIdCategory());
?>
        <tr>
            <td> <?php echo $product->getSKU(); ?> </td>
            <td> <?php echo $product->getName(); ?> </td>
            <td> <?php echo $category->get_name(); ?> </td>
            <td>
                <a href="editProduct.php?id=<?php echo $product->getId(); ?>">Edit</a> |
                <a href="/CRUD/CRUDProducts.php?action=delete&id=<?php echo $product->getId(); ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>

        </tr>

<?php }
} ?>