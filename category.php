<?php
require_once('classUser.php');
require_once('categoryFunctions.php');
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
                <h3 style="text-align: center;">Category</h3>
                <div class="container">
                    <div class="row">
                        <div class="six columns">
                            <a href="/createCategory.php" class="button button-primary">Create</a>
                        </div>
                        <div class="six columns">
                            <div class="u-pull-right">
                                <input type="text" placeholder="Search" name="filter" title="Search for name">
                                <a href="#" title="Search"><i class="fas fa-search"></i></a>
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
    $categories = getAllCategories();
    foreach ($categories as $category) { ?>
<tr>
    <td> <?php echo $category->get_id(); ?> </td>
    <td> <?php echo $category->get_name(); ?> </td>
    <td> <?php echo $category->get_parent(); ?> </td>
    <td>
        <a href="?action=edit&id=<?php echo $category->get_id(); ?>">Edit</a> | 
        <a href="/CRUDCategories.php?action=delete&id=<?php echo $category->get_id(); ?>"onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>

<?php }
}
?>