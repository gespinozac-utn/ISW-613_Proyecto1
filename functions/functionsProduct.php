<?php

require_once(__DIR__ . '/../sqlConnection.php');
require_once(__DIR__ . '/../class/classProduct.php');

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

function getAllProductsByCategory($idCategory)
{
    $conn = getConnection();
    $sql = "SELECT * FROM product WHERE idCategory = " . $idCategory . " AND `stock` > 0";
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
            array_push($products, $newProduct);
        }
    }
    $conn->close();
    return $products;
}

function getAllProducts($idCategory = null)
{
    $conn = getConnection();
    $sql = "SELECT * FROM product WHERE `stock` > 0 ";
    if (!empty($idCategory)) {
        $sql .= "AND idCategory = " . $idCategory;
    }
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
            array_push($products, $newProduct);
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
    $imageURL = empty($product->getImageURL()) ? 'UPLOADS/PLACEHOLDER.png' : $product->getImageURL();
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
            VALUES(?,?,?,"' . $imageURL . '",?,?,?);';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "sssiid",
            $sku,
            $name,
            $description,
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
                                `imageURL`="' . $imageURL . '",
                                `idCategory`=?,
                                `stock`=?,
                                `price`=?
            WHERE `id`=?;';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "sssiidi",
            $sku,
            $name,
            $description,
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
    $filter = "p.`name` LIKE '%" . $filter . "%' OR 
                p.`SKU` LIKE '%" . $filter . "%' OR
                c.`name` LIKE '%" . $filter . "%' OR
                pa.`name` LIKE '%" . $filter . "%'";
    $conn = getConnection();
    $products = [];
    $sql = "SELECT DISTINCT p.*,c.name AS categoryName
            FROM product as p
                INNER JOIN category AS c ON (p.idCategory = c.id)
                INNER JOIN category AS pa ON (c.parent = pa.name OR p.idCategory = pa.id)
            WHERE " . $filter . ";";

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
            array_push($products, $newProduct);
        }
    }
    $conn->close();

    return $products;
}

function filterByCategory($idCategory = null)
{
    $conn = getConnection();
    $products = [];
    $sql = "SELECT DISTINCT p.*
            FROM product AS p
                INNER JOIN category AS c ON (p.idCategory = c.id)
                INNER JOIN category AS pa ON (p.idCategory = pa.id OR c.parent = pa.name) ";
    !empty($idCategory) ? $sql .= "WHERE c.id = '" . $idCategory . "' OR pa.id = '"  . $idCategory . "'" : $sql;
    $sql .= " AND p.`stock` > 0;";
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
            array_push($products, $newProduct);
        }
    }
    $conn->close();

    return $products;
}