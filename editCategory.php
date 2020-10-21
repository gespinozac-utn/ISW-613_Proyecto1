<?php
require_once('functionsCategory.php');
require_once('classCategory.php');
require_once('classUser.php');

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
        }
        ?>

        </div>
    </body>

</html>

<?php

function createSection()
{
    $category = new Category();
    $category->set_id($_REQUEST['id']);
    $category = getById($category);

    $message = "";

?>
<section>
    <form action="/CRUDCategories.php?action=edit" method="POST">
        <h3 style="text-align: center;">Edit category</h3>

        <div class="row">
            <div class="six columns">
                <label for="name">Category name</label>
                <input type="text" class="u-full-width" name="name" placeholder="Name" required
                    value="<?php echo $category->get_name(); ?>">
            </div>
            <div class="six columns">
                <label for="parent">Category parent</label>
                <input type="text" name="parent" placeholder="Parent" class="u-full-width"
                    Value="<?php echo $category->get_parent() === '---' ? '' : $category->get_parent(); ?>">
            </div>
        </div>
        <h6><?php echo $message; ?></h6>
        <div class="row">
            <input type="submit" value="Save" class="button-primary u-pull-right">
        </div>
    </form>
</section>
<?php }
?>