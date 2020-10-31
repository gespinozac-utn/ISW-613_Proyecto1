<?php
require_once('functionsCategory.php');
require_once('classCategory.php');
require_once('classUser.php');

session_start();
$user = empty($_SESSION) ? null : $_SESSION['user'];
$userAdmin = empty($user) ? false : ($user->get_role() === 'Administrador');

if ($_GET) {
    if (!empty($_GET) && $userAdmin) {
        if (!empty($_POST)) {
            switch ($_REQUEST['action']) {
                case 'add':
                    addNewCategory();
                    break;
                case 'edit':
                    editCategory();
                    break;
                default:
                    header('location:/index.php');
                    break;
            }
        } else if ($_REQUEST['action'] === 'delete' && !empty($_REQUEST['id'])) {
            if (validateDelete()) {
                deleteCategory($_REQUEST['id']);
                header('location:/category.php');
            } else {
                header('location:/category.php?message=Error.Can`t%20delete.Try%20Again.');
            }
        }
    } else {
        header('location:/index.php');
    }
} else {
    header('location:/index.php');
}

function validateDelete()
{
    include_once('functionsProduct.php');
    $category = categoryById($_REQUEST['id']);

    if (!(count(getAllChild($category->get_id())) > 0)) {
        if (!(count(getAllProductsByCategory($category->get_id())) > 0)) {
            return true;
        } else {
            header('location:/category.php?message=Category%20with%20products.Can`t%20delete.');
            die;
        }
    } else {
        header('location:/category.php?message=Category%20with%20childs.Can`t%20delete.');
        die;
    }
}

function editCategory()
{
    if (!emptyFields()) {
        $category = categoryById($_REQUEST['id']);
        $category->set_name($_REQUEST['name']);
        $category->set_parent($_REQUEST['parent']);
        if (updateCategory($category)) {
            header('location:/category.php');
        } else {
            $header = 'editCategory.php?id=' . $category->get_id();
            header('location:/' . $header);
        }
    }
}

function addNewCategory()
{
    if (!emptyFields()) {
        $newCategory = new Category($_REQUEST['name'], $_REQUEST['parent']);
        if (!empty(addCategory($newCategory))) {
            header('location:/createCategory.php?message=Category%20added');
        } else {
            header('location:/createCategory.php?message=Error%20adding%20category.Try%20again.');
        }
    } else {
        header('location:/createCategory.php?message=Empty%20Fields');
    }
}

function emptyFields()
{
    return (empty($_REQUEST['name']));
}

function totalCategories()
{
    return count(searchCategories());
}