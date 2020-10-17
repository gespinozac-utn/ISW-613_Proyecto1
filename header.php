<?php
require('style.php');
?>
<!DOCTYPE html>

<section class="navbar u-full-width">
    <div class="row">
        <div class="twelve columns">
            <nav>
                <a href="/index.php" title="Home"><i class="fas fa-home fa-2x"></i></a>
                <a href="/logout.php" title="Sing out" class="u-pull-right"><i
                        class="fas fa-sign-out-alt fa-2x"></i></a>
                <!-- Menu Administrador -->
                <?php if ($user->get_role() === 'Administrador') { ?>
                <a href="/category.php" title="Category"><i class="fas fa-tag fa-2x"></i></a>
                <a href="#" title="Product"><i class="fas fa-box-open fa-2x"></i></a>
                <?php } else { ?>
                <!-- Menu Cliente -->
                <a href="#" title="Checkout" class="u-pull-right"><i class="fas fa-shopping-basket fa-2x"></i></a>
                <?php } ?>
            </nav>
        </div>
    </div>
</section>