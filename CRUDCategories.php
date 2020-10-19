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

if (empty($_GET) || !$userAdmin) {
    header('location:/index.php');
}

if (!empty($_POST) && ((empty($_GET['create']) ? false : $_GET['create']) === 'true')) {
    echo 'true create';die;
    if (!emptyFields()) {
        $newCategory = new Category($_REQUEST['name'], $_REQUEST['parent']);
        if(!empty(addCategory($newCategory))){

        }else{

        }
    } else {
        header('location:/createCategory.php?message=Empty%20Fields');
    }
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
    return (empty($_REQUEST['name']));
}