<?php
require_once('categoryFunctions.php');
require_once('classCategory.php');
require_once('classUser.php');

session_start();
$user = $_SESSION['user'];

if (empty($_GET) || $user->get_role() != 'Administrador') {
    header('location:/index.php');
}

if (!empty($_GET['delete'])) {
    if (deleteCategory($_GET['delete'])) {
        header('location:/category.php');
    }
} else if (!empty($_GET['edit'])) {
    //editar
}