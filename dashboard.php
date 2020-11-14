<?php
require_once('class/classUser.php');
require_once('CRUD/CRUDDashboard.php');
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
    </head>

    <body>
        <div class="container">
            <?php require('header.php'); ?>

            <section class="dashboard">
                <?php
            switch ($user->get_role()) {
                case 'Administrador':
                    $registrados = totalClients();
                    $vendidos = totalProducts();
                    $total = totalProfit(); ?>
                <!-- Administrator dashboard -->
                <div class="row">
                    <div class="four columns">&nbsp;</div>
                    <div class="six columns">
                        <h5>Clientes registrados: <strong><?php echo $registrados; ?></strong> </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">&nbsp;</div>
                    <div class="six columns">
                        <h5>Productos Vendidos: <strong><?php echo $vendidos; ?></strong> </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">&nbsp;</div>
                    <div class="six columns">
                        <h5>Monto Total de ventas: <strong>&#8353;<?php echo $total; ?></strong> </h5>
                    </div>
                </div>
                <?php break;
                case 'Cliente':
                default:
                    $totalProductos = totalProducts($user->get_id());
                    $totalMonto = 0; ?>
                <!-- Client dashboard -->
                <div class="row">
                    <div class="six columns">
                        <h5>Total de productos: <?php echo $totalProductos; ?></h5>
                    </div>
                    <div class="six columns">
                        <h5>Monto total: <?php echo $totalMonto; ?></h5>
                    </div>
                </div>
                <?php break;
            }; ?>
            </section>
        </div>
    </body>

</html>