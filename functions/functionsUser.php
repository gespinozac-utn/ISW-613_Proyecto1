<?php
require_once(__DIR__ . '/../sqlConnection.php');
require_once(__DIR__ . '/../class/classUser.php');

function validateUser($user)
{
    $conn = getConnection();
    $username = $user->get_userName();
    $password = $user->get_password();
    $sql = "SELECT * FROM users WHERE `username`='$username' AND `password`='$password';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newUser = new User(
        $result['username'],
        $result['password'],
        $result['id'],
        $result['role']
    );
    return (!empty($result['id']) ? $newUser : false);
}

function userById($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE `id`='$id';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newUser = new User(
        $result['username'],
        $result['password'],
        $result['id'],
        $result['role']
    );
    return (!empty($newUser->get_id()) ? $newUser : false);
}

function addUser($user)
{
    $conn = getConnection();
    $result = false;
    $username = $user->get_userName();
    $password = $user->get_password();

    $sql = 'INSERT INTO users(`username`,`password`) VALUES(?,?);';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $username, $password);
        $result = $stmt->execute();
        $user = validateUser($user);
        $stmt->close();
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        echo $error;
    }
    $conn->close();

    if ($result && !empty($user->get_id())) {
        return $user;
    } else {
        return false;
    }
}

function deleteUser($user)
{
    $conn = getConnection();
    $id = $user->get_id();

    $sql = "DELETE FROM users WHERE `id`='$id';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();

    return $result;
}

function getAllUsers()
{
    $conn = getConnection();
    $users = [];
    $sql = "SELECT `id`,`username`,`password` FROM users WHERE `role`='Cliente';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $newUser = new User(
                $row['username'],
                $row['password'],
                $row['id']
            );
            array_push($users, $newUser);
        }
    }
    $conn->close();

    return $users;
}

function existUser($username)
{
    if ($username === 'admin') {
        return true;
    }
    foreach (getAllUsers() as $user) {
        if ($user->get_userName() === $username) {
            return true;
        }
    }
    return false;
}