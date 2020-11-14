<?php
require_once(__DIR__ . '/../class/classProduct.php');
require_once(__DIR__ . '/../class/classOrder.php');
require_once(__DIR__ . '/../class/classDetails.php');
require_once(__DIR__ . '/../functions/functionsProduct.php');
require_once(__DIR__ . '/../functions/functionsBill.php');

function createDeatils($idOrder)
{
    if (!empty($idOrder)) {
        $order = getOrderById($idOrder);
        $details = getDetails($order);
        $total = 0;
        foreach ($details as $detail) {
            createDetailData($detail);
            $total += getTotal($detail);
        }
        echo "<p><strong>Total: </strong>&#8353;$total</p>";
    }
}

function createDetailData($detail)
{
    $quantity = $detail->getQuantity();
    $product = productById($detail->getIdProduct());
    $productName = $product->getName();
    $productPrice = $product->getPrice();
    echo "
    <ul>
        <li>$productName -- &#8353;$productPrice <strong>x</strong>$quantity</li>
    </ul>";
}

function createOrders($idUser)
{
    $orders = getOrders($idUser);
    if (!empty($orders)) {
        foreach ($orders as $order) {
            createOrderData($order);
        }
    }
}

function createOrderData($order)
{
    $id = $order->getId();
    $date = $order->getPurchaseDate();
    $details = getDetails($order);
    $total = 0;
    foreach ($details as $detail) {
        $total += getTotal($detail);
    }
    echo "
    <tr>
        <td><a href='/orders.php?idOrder=$id'>$date</a></td>
        <td>&#8353;$total</td>
    <tr>
    ";
}

function getTotal($detail)
{
    $product = productById($detail->getIdProduct());
    $quantity = $detail->getQuantity();
    return $product->getPrice() * $quantity;
}