<?php
$message = "";

session_start();
if (!empty($_SESSION['user'])) {
    header('location: /dashboard.php');
}

if (!empty($_REQUEST['status'])) {
    switch ($_REQUEST['status']) {
        case 'empty':
            $message = 'Error, empty fields';
            break;
        case 'error':
            $message = "Username or password incorrect";
            break;
        case 'created':
            $message = "User Created";
            break;
        default:
            $message = "";
            break;
    }
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
                            <a href="#" title="Home"><i class="fas fa-home fa-2x"></i></a>
                            <a href="/createAccount.php" title="Create account" class="u-pull-right"><i
                                    class="fas fa-plus fa-2x"></i></a>
                        </nav>
                    </div>
                </div>
            </section>

            <section class="login">
                <form action="/login.php" method="POST">
                    <div class="row">
                        <div class="six columns">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username"
                                class="u-full-width">
                        </div>
                        <div class="six columns">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="u-full-width">
                        </div>
                    </div>
                    <h6><?php echo $message; ?></h6>
                    <div class="row">
                        <input type="submit" value="Log in" class="button u-pull-right">
                    </div>
                </form>
            </section>

        </div>
    </body>

</html>