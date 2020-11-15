<?php
require_once(__DIR__ . '/../functions/functionsProduct.php');
require_once(__DIR__ . '/../functions/functionsUser.php');
require_once(__DIR__ . '/../functions/functionsBill.php');
require_once(__DIR__ . '/../functions/functionsClient.php');

function totalClients()
{
    $total = count(getAllClients());
    return !empty($total) ? $total : 0;
}

function totalProducts($idUser = null)
{
    $total = 0;
    $orders = getOrders($idUser);
    if (!empty($orders)) {
        foreach ($orders as $order) {
            $details = getDetails($order);
            foreach ($details as $detail) {
                $total += $detail->getQuantity();
            }
        }
    }
    return $total;
}

function totalProfit()
{
    $total = 0;
    $orders = getOrders();
    if (!empty($orders)) {
        foreach ($orders as $order) {
            $details = getDetails($order);
            foreach ($details as $detail) {
                $product = productById($detail->getIdProduct());
                $total += $product->getPrice() * $detail->getQuantity();
            }
        }
    }
    return $total;
}

function totalComprado($idUser)
{
    $total = 0;
    $orders = getOrders($idUser);
    if (!empty($orders)) {
        foreach ($orders as $order) {
            $details = getDetails($order);
            foreach ($details as $detail) {
                $product = productById($detail->getIdProduct());
                $total += $product->getPrice() * $detail->getQuantity();
            }
        }
    }
    return $total;
}