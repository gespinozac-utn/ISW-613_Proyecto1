<?php
require_once('sqlConnection.php');
require_once('classClient.php');

function addClient($client)
{
    $conn = getConnection();
    $result = false;
    $name = $client->get_name();
    $email = $client->get_email();
    $idUsuario = $client->get_idUsuario();

    $sql = 'INSERT INTO clients(`name`,`email`,`idUser`) VALUES(?,?,?);';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $name, $email, $idUsuario);
        $result = $stmt->execute();
        $client = clientByIdUser($idUsuario);
        $stmt->close();
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        $stmt->close();
        echo $error;
    }
    $conn->close();

    if ($result && !empty($client->get_id())) {
        return $client;
    } else {
        return false;
    }
}

function clientById($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM clients WHERE `id`='$id';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newClient = new Client(
        $result['name'],
        $result['email'],
        $result['idUser'],
        $result['id']
    );
    return (!empty($newClient->get_id()) ? $newClient : false);
}

function clientByIdUser($idUser)
{
    $conn = getConnection();
    $sql = "SELECT * FROM clients WHERE `idUser`='$idUser';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();
    $result = $result->fetch_array();
    $newClient = new Client(
        $result['name'],
        $result['email'],
        $result['idUser'],
        $result['id']
    );
    return (!empty($newClient->get_id()) ? $newClient : false);
}

function deleteClient($client)
{
    $conn = getConnection();
    $id = $client->get_id();
    $email = $client->get_email();

    $sql = "DELETE FROM clients WHERE `id`='$id' AND `email`='$email';";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }
    $conn->close();

    return $result;
}

function getAllClients()
{
    $conn = getConnection();
    $clients = [];
    $sql = "SELECT `id`,`name`,`email`,`idUser` FROM clients;";
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        $conn->close();
        return false;
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $newClient = new Client(
                $row['name'],
                $row['email'],
                $row['idUser'],
                $row['id']
            );
            array_push($clients, $newClient);
        }
    }
    $conn->close();

    return $clients;
}