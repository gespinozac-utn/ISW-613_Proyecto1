<?php 
    require('style.php'); 
?>
<!DOCTYPE html>

<section class="navbar u-full-width">
    <div class="row">
        <div class="twelve columns">
            <nav>
                <a href="/index.php" title="Home"><i class="fas fa-home fa-2x"></i></a>
                <?php if($user->get_role() === 'Administrador'){ 
                    echo'<a href="">Prueba</a>';
                 }?>
                <a href="/logout.php" class="u-pull-right u-cf"><i class="fas fa-sign-out-alt fa-2x"></i></a>
            </nav>
        </div>
    </div>
</section>