<?php
require_once('class/classUser.php');

session_start();
$user = $_SESSION['user'];
$message = "";

if (!empty($_REQUEST['message'])) {
    $message = $_REQUEST['message'];
}

if (empty($_SESSION['user']) || $_SESSION['user']->get_role() != 'Administrador') {
    echo 'usuario vacio o no administrador';
    die;
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
        <?php require_once('header.php'); ?>

        <section>
            <form action="/CRUD/CRUDCategories.php?action=add" method="POST">
                <h3 style="text-align: center;">Create category</h3>

                <div class="row">
                    <div class="six columns">
                        <label for="name">Category name</label>
                        <input type="text" class="u-full-width" name="name" placeholder="Name" required>
                    </div>
                    <div class="six columns">
                        <label for="parent">Category parent</label>
                        <input type="text" name="parent" placeholder="Parent" class="u-full-width">
                    </div>
                </div>
                <h6><?php echo $message; ?></h6>
                <div class="row">
                    <input type="submit" value="Create" class="button-primary u-pull-right">
                </div>
            </form>
        </section>
    </div>

</body>

</html>