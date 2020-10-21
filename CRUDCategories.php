<?php
require_once('categoryFunctions.php');
require_once('classCategory.php');
require_once('classUser.php');

session_start();
$user = empty($_SESSION) ? null : $_SESSION['user'];
$userAdmin = empty($user) ? false : ($user->get_role() === 'Administrador');

if($_GET){
    if(!empty($_GET) && $userAdmin){
        if(!empty($_POST)){
            switch($_REQUEST['action']){
                case 'add':
                    echo 'add';
                    // addNewCategory();
                    break;
                case 'edit':
                    echo 'edit';
                    break;
                default:
                    header('location:/index.php');
                    break;
            }
        }else if($_REQUEST['action'] === 'delete'){
            header('location:/category.php');
        }
    }else{header('location:/index.php');}
}else{header('location:/index.php');}

function addNewCategory(){
    if (!emptyFields()) {
        $newCategory = new Category($_REQUEST['name'], $_REQUEST['parent']);
        if(!empty(addCategory($newCategory))){
            header('location:/createCategory.php?message=Category%20added');

        }else{

        }
    } else {
        header('location:/createCategory.php?message=Empty%20Fields');
    }
}

function emptyFields()
{
    return (empty($_REQUEST['name']));
}

function totalCategories(){
    return count(getAllCategories());
}