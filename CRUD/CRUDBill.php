<?php
require_once(__DIR__ . '/../class/classProduct.php');
require_once(__DIR__ . '/../class/classOrder.php');
require_once(__DIR__ . '/../class/classDetails.php');
require_once(__DIR__ . '/../functions/functionsProduct.php');
require_once(__DIR__ . '/../functions/functionsBill.php');

if ($_GET) {
    if (!empty($_GET)) {
        if (!empty($_POST)) {
            switch ($_REQUEST['action']) {
                case 'add':
                    addNewDetail();
                    break;
                case 'checkout':
                    break;
            }
        } else if ($_REQUEST['action'] === 'delete' && !empty($_REQUEST['id'])) {
            // DELETE detail
            deleteDetail($_REQUEST['id']);
            header('location:/checkout.php');
        }
    } else {
        header('location:/index.php');
    }
}

function addNewDetail()
{
    $preOrder = getPreOderByUser($_REQUEST['idUser']);
    $product = productById($_REQUEST['idP']);
    $newDetail = new Detail($preOrder->getId(), $product->getId(), $_REQUEST['quantity']);
    addDetail($newDetail);
    header('location:/checkout.php');
}

function loadOrders($idUser)
{
    $preOrder = getPreOderByUser($idUser);
    if (!empty($details = getDetails($preOrder))) {
        foreach ($details as $detail) {
            createData($detail);
        }
    }
}

function createData($detail)
{
    $id = $detail->getId();
    $quantity = $detail->getquantity();
    $product = productById($detail->getIdProduct());
    $name = $product->getName();
    echo '
    <tr>
        <td>' . $name . '</td>
        <td>' . $quantity . '</td>
        <td><a href="/CRUD/CRUDBill.php?action=delete&id=' . $id . '"><i class="fas fa-times fa-lg"></i></a>
        </td>
    </tr>
    ';
}