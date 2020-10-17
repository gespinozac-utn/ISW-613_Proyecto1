<?php 

?>

<!DOCTYPE html>
<html lang="en">

    <style>

    </style>

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
                <form action="#" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="six columns">
                            <label for="name">Full name</label>
                            <input type="text" class="u-full-width" placeholder="Name">
                        </div>
                        <div class="six columns">
                            <label for="email">Email</label>
                            <input type="email" class="u-full-width" placeholder="ExampleEmail@email.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="four columns">
                            <label for="username">Username</label>
                            <input type="text" class="u-full-width" placeholder="Username">
                        </div>
                        <div class="four columns">
                            <label for="password">Password</label>
                            <input type="password" class="u-full-width" placeholder="Password">
                        </div>
                        <div class="four columns">
                            <label for="repeatPassword">Repeat Password</label>
                            <input type="password" class="u-full-width" placeholder="Password">
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Create Account" class="button u-full-width">
                    </div>
                </form>
            </section>
        </div>

    </body>

</html>