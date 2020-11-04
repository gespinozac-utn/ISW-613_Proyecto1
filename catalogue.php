<?php
require_once('classUser.php');
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
        }

        .product-info {
            margin-top: auto;
        }

        div>a {
            text-decoration: none !important;
            color: black !important;
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
                            <a href="#">All</a>
                        </li>
                        <li>
                            <a href="#">Ropa</a>
                        </li>
                        <li>
                            <a href="#">Comida</a>
                        </li>
                        <span><strong>SubCategory</strong></span>
                        <li>
                            <a href="#">Ropa de hombres</a>
                        </li>
                        <li>
                            <a href="#">Ropa de mujer</a>
                        </li>
                    </ul>
                </div>
                <!-- CODE GOES HERE -->
                <div class="content">

                    <div class="product-card">
                        <a href="#">
                            <div class="product-image">
                                <img src="uploads/chaquetacuero.jpg" height="110" width="110">
                            </div>
                            <div class="product-info">
                                <h5>Leather Jacket</h5>
                                <h6>&#8353;35000</h6>
                            </div>
                        </a>
                    </div>

                    <div class="product-card">
                        <a href="#">
                            <div class="product-image">
                                <img src="uploads/snicker.jpg" height="110" width="110">
                            </div>
                            <div class="product-info">
                                <h5>Snicker</h5>
                                <h6>&#8353;750</h6>
                            </div>
                        </a>
                    </div>

                    <div class="product-card">
                        <a href="#">
                            <div class="product-image">
                                <img src="uploads/Blusa-Azul.jpg" height="110" width="110">
                            </div>
                            <div class=" product-info">
                                <h5>Blusa Azul</h5>
                                <h6>&#8353;5500</h6>
                            </div>
                        </a>
                    </div>
                    <!-- 
                    <div class="product-card">
                        <a href="#">
                            <div class="product-image">
                                <img src="uploads/placeholder.png" height="110" width="110">
                            </div>
                            <div class="product-info">
                                <h5>NONE</h5>
                                <h6>&#8353;0</h6>
                            </div>
                        </a>
                    </div>

                    <div class="product-card">
                        <a href="#">
                            <div class="product-image">
                                <img src="uploads/placeholder.png" height="110" width="110">
                            </div>
                            <div class="product-info">
                                <h5>NONE</h5>
                                <h6>&#8353;0</h6>
                            </div>
                        </a>
                    </div>

                    <div class="product-card">
                        <a href="#">
                            <div class="product-image">
                                <img src="uploads/placeholder.png" height="110" width="110">
                            </div>
                            <div class="product-info">
                                <h5>NONE</h5>
                                <h6>&#8353;0</h6>
                            </div>
                        </a>
                    </div>

                    <div class="product-card">
                        <a href="#">
                            <div class="product-image">
                                <img src="uploads/placeholder.png" height="110" width="110">
                            </div>
                            <div class="product-info">
                                <h5>NONE</h5>
                                <h6>&#8353;0</h6>
                            </div>
                        </a>
                    </div> -->

                </div>
            </section>


        </div>
    </body>

</html>