<?php
require_once('classUser.php');
session_start();
$user = $_SESSION['user'];

if (empty($_SESSION['user'])) {
    echo "<h1 style='color: red;'>Unauthorized Access.</h1>";
    die;
}
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
                    require_once('CRUDClients.php');
                    $registrados = totalClients();
                    $vendidos = 0;
                    $total = 0; ?>
                <!-- Administrator dashboard -->
                <div class="row">
                    <div class="four columns">
                        <h5>clientes registrados <?php echo $registrados; ?> </h5>
                    </div>
                    <div class="four columns">
                        <h5>Prodcutos Vendidos <?php echo $vendidos; ?> </h5>
                    </div>
                    <div class="four columns">
                        <h5>Monto Total de ventas <?php echo $total; ?> </h5>
                    </div>
                </div>
                <?php break;
                case 'Cliente':
                default: ?>
                <!-- Client dashboard -->
                <?php break;
            }; ?>
            </section>
        </div>
    </body>

</html>