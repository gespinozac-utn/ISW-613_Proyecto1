<?php
session_start();
$message = "";

if (!empty($_REQUEST['message'])) {
    $message = $_REQUEST['message'];
}

if (!empty($_SESSION['user'])) {
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
            <?php require('style.php'); ?>

            <section class="navbar u-full-width">
                <div class="row">
                    <div class="twelve columns">
                        <nav>
                            <a href="/index.php" title="Home"><i class="fas fa-home fa-2x"></i></a>
                            <a href="#" title="Create account" class="u-pull-right"><i
                                    class="fas fa-plus fa-2x"></i></a>
                        </nav>
                    </div>
                </div>
            </section>

            <section class="create">
                <form action="/CRUDClients.php?action=add" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="six columns">
                            <label for="name">Full name</label>
                            <input type="text" name="name" class="u-full-width" placeholder="Name">
                        </div>
                        <div class="six columns">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="u-full-width" placeholder="ExampleEmail@email.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="six columns">
                            <label for="phone">Phone number</label>
                            <input type="text" name="phone" class="u-full-width" placeholder="Phone number">
                        </div>
                        <div class="six columns">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="u-full-width" placeholder="Address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="four columns">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="u-full-width" placeholder="Username">
                        </div>
                        <div class="four columns">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="u-full-width" placeholder="Password">
                        </div>
                        <div class="four columns">
                            <label for="repeatPassword">Confirm Password</label>
                            <input type="password" name="repeatPassword" class="u-full-width"
                                placeholder="Confirm password">
                        </div>
                    </div>
                    <h6><?php echo $message; ?></h6>
                    <div class="row">
                        <input type="submit" value="Create Account" class="button u-full-width">
                    </div>
                </form>
            </section>
        </div>

    </body>

</html>