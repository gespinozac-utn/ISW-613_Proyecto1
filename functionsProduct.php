<?php

require_once('sqlConnection.php');
require_once('classProduct.php');

function productById($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM product WHERE `id`='$id';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newProduct = new Product(
        $result['sku'],
        $result['name'],
        $result['description'],
        $result['imageURL'],
        $result['idCategory'],
        $result['stock'],
        $result['price'],
        $result['id']
    );
    return (!empty($newProduct->getID()) ? $newProduct : false);
}

function getAllProducts()
{
    $conn = getConnection();
    $sql = "SELECT * FROM category;";
    $products = [];
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $newProduct = new Product(
                $row['sku'],
                $row['name'],
                $row['description'],
                $row['imageURL'],
                $row['idCategory'],
                $row['stock'],
                $row['price'],
                $row['id']
            );
        }
    }
    $conn->close();

    return $products;
}

function addProduct($product)
{
    $conn = getConnection();
    $result = false;
    $sku = $product->getSKU();
    $name = $product->getName();
    $description = $product->getDescription();
    $imageURL = $product->getImageURL();
    $idCategory = $product->getIdCategory();
    $stock = $product->getStock();
    $price = $product->getPrice();

    $sql = 'INSERT INTO product(`sku`,
                                `name`,
                                `description`,
                                `imageURL`,
                                `idCategory`,
                                `stock`,
                                `price`) 
            VALUES(?,?,?,?,?,?,?);';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "ssssiid",
            $sku,
            $name,
            $description,
            $imageURL,
            $idCategory,
            $stock,
            $price
        );
        $result = $stmt->execute();
        $product = productById(mysqli_insert_id($conn));
        $stmt->close();
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        echo $error;
    }
    $conn->close();

    if ($result && !empty($product->getId())) {
        return $product;
    } else {
        return false;
    }
}