<?php
require_once(__DIR__ . '/../class/classProduct.php');
require_once(__DIR__ . '/../class/classOrder.php');
require_once(__DIR__ . '/../class/classDetails.php');
require_once(__DIR__ . '/../functions/functionsProduct.php');
require_once(__DIR__ . '/../functions/functionsBill.php');

function loadOrders($idUser)
{
    $order = getPreOderByUser($idUser);
    if (!empty($details = getDetails($order))) {
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