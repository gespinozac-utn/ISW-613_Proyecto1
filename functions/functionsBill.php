<?php
require_once(__DIR__ . '/../sqlConnection.php');
require_once(__DIR__ . '/../class/classOrder.php');
require_once(__DIR__ . '/../class/classDetails.php');
require_once(__DIR__ . '/../class/classProduct.php');

function preOrder($idUser)
{
    $conn = getConnection();
    $sql = "INSERT INTO `order`(`idUser`) VALUES(?)";
    $order = new Order($idUser);

    if ($stmt = $conn->prepare($sql)) {
        $idUser = $order->getIdUser();
        $stmt->bind_param('i', $idUser);
        $result = $stmt->execute();
        $order->setId(mysqli_insert_id($conn));
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        echo $error;
    }
    $conn->close();

    if ($result && !empty($order->getId())) {
        return $order;
    } else {
        return false;
    }
}

function getPreOrder($order)
{
    $idUser = $order->getIdUser();
    $conn = getConnection();
    $sql = 'SELECT * FROM `order` WHERE idUser=? AND `status`=0';
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $idUser);
        $result = $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        $order->setId($data['id']);
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        echo $error;
    }
    $conn->close();

    if ($result && !empty($order->getId())) {
        return $order;
    } else {
        return false;
    }
}

function preOrderCheckout($order)
{
    $conn = getConnection();
    $id = $order->getId();
    $sql = 'UPDATE `order` SET `status`=1, `purchaseDate`=NOW() WHERE `id`=?';
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $order = getOrderById($id);
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        echo $error;
    }
    $conn->close();

    if ($result && !empty($order->getId())) {
        return $order;
    } else {
        return false;
    }
}

function getOrderById($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM `order` WHERE `id` = $id;";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newOrder = new Order(
        $result['idUser'],
        $result['purchaseDate'],
        $result['status'],
        $result['id']
    );
    return (!empty($result['id']) ? $newOrder : false);
}

function getDetails($order)
{
    $id = $order->getId();
    $conn = getConnection();
    $details = [];
    $sql = "SELECT * FROM `detail` WHERE `idOrder`=$id;";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        echo $conn->connect_error;
        die;
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $newDetail = new Detail(
                $row['idOrder'],
                $row['idProduct'],
                $row['quantity'],
                $row['id']
            );
            array_push($details, $newDetail);
        }
    } else {
        return false;
    }
    return $details;
}

function getPreOderByUser($idUser)
{
    $conn = getConnection();
    $sql = "SELECT * FROM `order` WHERE `idUser`=$idUser AND `status`=0;";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        echo $conn->connect_error;
        die;
    }
    $conn->close();

    if (mysqli_num_rows($result) == 1) {
        $result = $result->fetch_assoc();
        return new Order(
            $result['idUser'],
            $result['purchaseDate'],
            $result['status'],
            $result['id']
        );
    } else {
        return preOrder($idUser);
    }
}