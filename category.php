<?php
require_once('class/classUser.php');
require_once('functions/functionsCategory.php');
session_start();
$user = $_SESSION['user'];
$message = "";

if (!empty($_REQUEST['message'])) {
    $message = $_REQUEST['message'];
}
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
            <h3 style="text-align: center;">Category</h3>
            <div class="container">
                <div class="row">
                    <div class="four columns">
                        <a href="/createCategory.php" class="button button-primary">Create</a>
                    </div>
                    <div class="three columns">
                        <p style="color: red;"><?php echo $message; ?></p>
                    </div>
                    <div class="five columns">
                        <div class="u-pull-right">
                            <form action="category.php" method="GET">
                                <input type="text" placeholder="Search" name="search" title="Search for name">
                                <button type="submit"><i class="fas fa-search" style="color:grey"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="u-full-width">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Parent</th>
                            <th>Utility</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        loadTable(); ?>
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
    $categories = searchCategories($_GET && !empty($_REQUEST['search']) ? $_REQUEST['search'] : "");
    foreach ($categories as $category) { ?>
        <tr>
            <td> <?php echo $category->get_id(); ?> </td>
            <td> <?php echo $category->get_name(); ?> </td>
            <td> <?php echo $category->get_parent(); ?> </td>
            <td>
                <a href="editCategory.php?id=<?php echo $category->get_id(); ?>">Edit</a> |
                <a href="/CRUD/CRUDCategories.php?action=delete&id=<?php echo $category->get_id(); ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>

        </tr>

<?php }
}
?>