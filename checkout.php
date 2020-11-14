<?php

require_once('class/classUser.php');
require_once('CRUD/CRUDBill.php');
session_start();
if (empty($_SESSION['user'])) {
    echo "<h1 style='color: red;'>Unauthorized Access.</h1>";
    die;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="shortcut icon" href="https://www.utn.ac.cr/misc/favicon.ico" type="image/vnd.microsoft.icon" />
        <style>
        .side-menu {
            width: 16%;
            position: absolute;
            z-index: 1;
            overflow: auto;
            height: 80%;
            border-right: 1px dotted black;
        }

        li {
            list-style: none;
            margin-left: 2rem;
        }

        li>a {
            text-decoration: none;
            color: black;
        }

        .catalogue {
            min-height: 340px;
        }

        .content {
            margin-left: 16%;
            display: flex;
            flex-wrap: wrap;
        }

        .product-card {
            padding: 2%;
            flex-grow: 1;
            flex-basis: 29%;
            display: flex;
        }

        .product-image img {
            max-width: 100%;
            border-radius: 15%;
            width: 110px;
            height: 110px;
        }

        .product-info {
            margin-top: auto;
        }

        .product-card>a {
            text-decoration: none;
            color: black;
        }

        .product-info>h6,
        .product-info>h5 {
            margin-bottom: 1rem;
        }
        </style>
    </head>

    <body>
        <div class="container">
            <?php require('header.php'); ?>
            <section class="catalogue">

                <div class="side-menu">
                    <ul>
                        <li>
                            <a href="/catalogue.php"><i class="far fa-arrow-alt-circle-left fa-2x"> Back</i></a>
                        </li>
                    </ul>
                </div>

                <section class="content">
                    <div class="row u-full-width">
                        <div class="four columns u-full-width">&nbsp;</div>
                        <div class="eight columns u-full-width">
                            <h4>Items on the basket</h4>
                        </div>
                    </div>
                    <div class="container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>quantity</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Load orders -->
                                <?php loadOrders($_SESSION['user']->get_id()); ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="twelve columns">
                                <form action="/CRUD/CRUDBill.php?action=checkout" method="POST">
                                    <input type="hidden" name="idU" value="<?php echo $user->get_id(); ?>">
                                    <input type="submit" value="Checkout" class="button u-full-width">
                                </form>
                            </div>
                        </div>
                    </div>

                </section>

            </section>
        </div>
    </body>

</html>