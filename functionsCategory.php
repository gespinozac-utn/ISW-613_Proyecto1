<?php
require_once('sqlConnection.php');
require_once('classCategory.php');

function categoryByName($category)
{
    $conn = getConnection();
    $name = $category->get_name();

    $sql = "SELECT * FROM category WHERE `name`='$name'";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newCategory = new Category(
        $result['name'],
        $result['parent'],
        $result['id']
    );
    return (!empty($result['id']) ? $newCategory : false);
}

function categoryById($id)
{
    $conn = getConnection();

    $sql = "SELECT * FROM category WHERE `id`='$id'";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newCategory = new Category(
        $result['name'],
        $result['parent'],
        $result['id']
    );
    return (!empty($result['name']) ? $newCategory : false);
}

function addCategory($category)
{
    $conn = getConnection();
    $result = false;
    $name = $category->get_name();
    $parent = empty($category->get_parent()) ? "---" : $category->get_parent();
    $category->set_Parent($parent);

    $sql = 'INSERT INTO category(`name`,`parent`) VALUES(?,?);';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $name, $parent);
        $result = $stmt->execute();
        $category = categoryByName($category);
        $stmt->close();
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        echo $error;
    }
    $conn->close();

    if ($result && !empty($category->get_id())) {
        return $category;
    } else {
        return false;
    }
}

function searchCategories($filter = '')
{
    $filter = "`name` LIKE '%" . $filter . "%' OR `parent` LIKE '%" . $filter . "%' ";
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

function deleteCategory($id)
{
    $conn = getConnection();

    $sql = "DELETE FROM category WHERE `id`='$id';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();

    return $result;
}

function updateCategory($category)
{
    $conn = getConnection();
    $result = false;
    $name = $category->get_name();
    $parent = empty($category->get_parent()) ? "---" : $category->get_parent();
    $id = $category->get_id();
    $category->set_Parent($parent);

    $sql = 'UPDATE category SET  `name` = ? ,`parent`=? WHERE `id`=?;';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $name, $parent, $id);
        $result = $stmt->execute();
        $category = categoryById($id);
        $stmt->close();
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        $category = null;
        echo $error;
    }
    $conn->close();

    if ($result && !empty($category->get_id())) {
        return $category;
    } else {
        return false;
    }
}

function getAllChild($idParent)
{
    $conn = getConnection();
    $sql = 'SELECT c.* FROM category AS c
                INNER JOIN category AS p ON(p.name = c.parent)
            WHERE p.id = ' . $idParent . ';';
    $childrens = [];
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
            array_push($childrens, $newCategory);
        }
    }
    $conn->close();
    return $childrens;
}