<?php
require_once('classUser.php');
require_once('CRUDCatalogue.php');
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
                        <span><strong>Category</strong></span>
                        <li>
                            <a href="/catalogue.php">All</a>
                        </li>
                        <?php createSideMenu($_GET && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null); ?>
                    </ul>
                </div>

                <div class="content">
                    <?php
                if ($_GET) {
                    if (empty($_REQUEST['preview'])) {
                        createCatalogue(!empty($_REQUEST['id']) ? $_REQUEST['id'] : null);
                    } else {
                        previewProduct($_REQUEST['preview']);
                    }
                } else {
                    createCatalogue(null);
                }
                ?>
                </div>

            </section>
        </div>
    </body>

</html>