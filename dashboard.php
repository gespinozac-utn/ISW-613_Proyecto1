<?php 
    require('classUser.php');
    session_start();
    $user = $_SESSION['user'];
    
    if(empty($_SESSION['user'])){
        echo "<h1 style='color: red;'>Unauthorized Access.</h1>";
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">

    <body>
        <div class="container">
            <?php require('header.php'); ?>

            <section class="dashboard">
                <?php 
                    switch($user->get_role()){ 
                        case 'Administrador': 
                            $registrados=0;
                            $vendidos=0;
                            $total=0;?>
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
                <?php       break;
                        case 'Cliente':
                        default: ?>
                <!-- Client dashboard -->
                <?php       break;
                    };?>
            </section>
        </div>
    </body>

</html>