<?php
require_once('../functions/functionsProduct.php');
require_once(__DIR__ . '/../class/classProduct.php');
require_once(__DIR__ . '/../class/classUser.php');

session_start();
$user = empty($_SESSION) ? null : $_SESSION['user'];
$userAdmin = empty($user) ? false : ($user->get_role() === 'Administrador');

if ($_GET) {
    if (!empty($_GET) && $userAdmin) {
        if (!empty($_POST)) {
            switch ($_REQUEST['action']) {
                case 'add':
                    addNewProduct();
                    break;
                case 'edit':
                    editProduct();
                    break;
                default:
                    header('location:/index.php');
                    break;
            }
        } else if ($_REQUEST['action'] === 'delete' && !empty($_REQUEST['id'])) {
            deleteProduct($_REQUEST['id']);
            header('location:/product.php');
        }
    } else {
        header('location:/index.php');
    }
} else {
    header('location:/index.php');
}

function newImage()
{
    $target_dir = 'uploads/';
    $target_temp = $_FILES['imageURL']['tmp_name'];
    $targe_name = basename($_FILES['imageURL']['name']);
    $target_file = $target_dir . $targe_name;
    if (!empty($targe_name)) {
        $directory = __DIR__ . '/../' . $target_file;
        move_uploaded_file($target_temp, $directory);
        return $target_file;
    } else {
        return null;
    }
}

function addNewProduct()
{
    if (!emptyFields()) {
        $newProduct = new Product(
            $_REQUEST['sku'],
            $_REQUEST['name'],
            $_REQUEST['description'],
            newImage(),
            $_REQUEST['category'],
            $_REQUEST['stock'],
            $_REQUEST['price']
        );
        if (!empty(addProduct($newProduct))) {
            header('location:/createProduct.php?message=Product%20added');
        } else {
            header('location:/createProduct.php?message=Error%20adding%20product.Try%20again.');
        }
    } else {
        header('location:/createProduct.php?message=Empty%20Fields');
    }
}

function getImageUrl($product)
{
    $target_dir = 'uploads/';
    $target_temp = $_FILES['imageURL']['tmp_name'];
    $targe_name = basename($_FILES['imageURL']['name']);
    $target_file = $target_dir . $targe_name;
    if (!empty($targe_name)) {
        $directory = __DIR__ . '/../' . $target_file;
        move_uploaded_file($target_temp, $directory);
        return  $target_file;
    } else {
        return $product->getImageURL();
    }
}

function editProduct()
{
    if (!emptyFields()) {
        $product = productById($_REQUEST['id']);
        $product->setSKU($_REQUEST['sku']);
        $product->setName($_REQUEST['name']);
        $product->setDescription($_REQUEST['description']);
        $product->setImageURL(getImageUrl($product));
        $product->setIDCategory($_REQUEST['category']);
        $product->setStock($_REQUEST['stock']);
        $product->setPrice($_REQUEST['price']);
        if (updateProduct($product)) {
            header('location:/product.php');
            exit();
        }
    }
    $header = 'editProduct.php?id=' . $_REQUEST['id'] . '&message=Empty fields.';
    header('location:/' . $header);
}

function emptyFields()
{
    return (empty($_REQUEST['sku']) ||
        empty($_REQUEST['name']) ||
        empty($_REQUEST['description']) ||
        empty($_REQUEST['category']) ||
        empty($_REQUEST['stock']) ||
        empty($_REQUEST['price']));
}