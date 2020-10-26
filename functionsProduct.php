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
    $sql = "SELECT * FROM product;";
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

function updateProduct($product)
{
    $conn = getConnection();
    $result = false;
    $name = $product->getName();
    $sku = $product->getSKU();
    $name = $product->getName();
    $description = $product->getDescription();
    $imageURL = $product->getImageURL();
    $idCategory = $product->getIdCategory();
    $stock = $product->getStock();
    $price = $product->getPrice();
    $id = $product->getId();

    $sql = 'UPDATE product SET  
                                `SKU` = ? ,
                                `name`=?,
                                `description`=?,
                                `imageURL`=?,
                                `idCategory`=?,
                                `stock`=?,
                                `price`=?
            WHERE `id`=?;';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "ssssiidi",
            $sku,
            $name,
            $description,
            $imageURL,
            $idCategory,
            $stock,
            $price,
            $id
        );
        $result = $stmt->execute();
        $product = productById($id);
        $stmt->close();
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        echo $error;
        die;
        $stmt->close();
        $product = null;
        echo $error;
    }
    $conn->close();

    if ($result && !empty($product->getId())) {
        return $product;
    } else {
        return false;
    }
}

function deleteProduct($id)
{
    $conn = getConnection();

    $sql = "DELETE FROM product WHERE `id`='$id';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();

    return $result;
}

function searchProduct($filter = '')
{
    $filter = "`name` LIKE '%" . $filter . "%' OR 
                `SKU` LIKE '%" . $filter . "%' OR
                `category´ LIKE '%" . $filter . "%'";
    $conn = getConnection();
    $categories = [];
    $sql = "SELECT `id`,`name`,`parent` FROM category WHERE " . $filter . ";";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $newCategory = new Category(
                $row['name'],
                $row['parent'],
                $row['id']
            );
            array_push($categories, $newCategory);
        }
    }
    $conn->close();

    return $categories;
}

// addProduct(new Product('sku123456789', 'encendedor', 'encendedor', 'none', 15, 8, 1000));