<?php
require_once('class/classUser.php');
require_once('CRUD/CRUDOrders.php');
session_start();
if (empty($_SESSION['user'])) {
    echo "<h1 style='color: red;'>Unauthorized Access.</h1>";
    die;
}
$user = $_SESSION['user'];
$idOrder = ($_GET && !empty($_REQUEST['idOrder'])) ? $_REQUEST['idOrder'] : false;
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="shortcut icon" href="https://www.utn.ac.cr/misc/favicon.ico" type="image/vnd.microsoft.icon" />
        <style>
        td>a {
            display: block;
        }

        .details {
            border: 1px dashed black;
            padding: 25px;
            height: 300px;
            overflow-y: auto;
        }

        .details>ul {
            padding-left: 30px;
        }

        @media (min-width: 1000px) {

            thead,
            tr {
                width: 100% !important;
            }

            td,
            th {
                width: 40% !important;
            }
        }
        </style>
    </head>

    <body>
        <div class="container">
            <?php require('header.php'); ?>
            <section class="orders">
                <!-- CODE GOES HERE -->
                <div class="row">
                    <div class="five columns u-full-width">&nbsp;</div>
                    <div class="six columns u-full-width">
                        <h2>Orders</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="six columns u-full-width">
                        <table class="u-full-width">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?= createOrders($user->get_id()); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="six columns u-full-width details">
                        <h5>Details</h5>
                        <?= createDeatils($idOrder); ?>
                    </div>
                </div>
            </section>
        </div>
    </body>

</html>