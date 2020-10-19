<?php
require_once('categoryFunctions.php');
require_once('classCategory.php');
require_once('classUser.php');

session_start();
if (empty($_SESSION) || $_SESSION['user']->get_role() != 'Administrador') {
    header('location:/index.php');
}
$user = $_SESSION['user'];
$userAdmin = $user->get_role();

if (!empty($_POST)) {
    if (!emptyFields()) {
    } else {
        header('location:/category.php?message=Empty%20Fields');
    }
}

if (empty($_GET) || !$userAdmin) {
    header('location:/index.php');
}

if (!empty($_GET['delete']) && $userAdmin) {
    if (deleteCategory($_GET['delete'])) {
        header('location:/category.php');
    }
} else if (!empty($_GET['edit']) && $userAdmin) {
    //editar
}

function emptyFields()
{
    return (empty($_REQUEST['name']) || empty($_REQUEST['parent']));
}