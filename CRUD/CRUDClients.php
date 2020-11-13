<?php

require_once(__DIR__ . '/../functions/functionsClient.php');
require_once(__DIR__ . '/../functions/functionsUser.php');

if ($_POST && !empty($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'add':
            registerClient();
            break;
    }
}

function registerClient()
{
    if (!emptyFields()) {
        if (comparePassword()) {
            $newU = new User($_REQUEST['username'], $_REQUEST['password']);
            $newC = new Client(
                $_REQUEST['name'],
                $_REQUEST['email'],
                $_REQUEST['phone'],
                $_REQUEST['address']
            );
            if (!existUser($newU->get_userName())) {
                $newU = addUser($newU);
                $newC->set_idUsuario($newU->get_id());
                $newC = addClient($newC);

                if (!empty($newU) && !empty($newC)) {
                    header('location:/index.php?status=created');
                } else {
                    header('location:/createAccount.php?message=Error,%20can`t%20created%20user');
                }
            } else {
                header('location:/createAccount.php?message=Username%20already%20taken');
            }
        } else {
            header('location:/createAccount.php?message=%20Passwords%20do%20not%20match.%20Try%20again');
        }
    } else {
        header('location:/createAccount.php?message=Empty%20Fields');
    }
}

function emptyFields()
{
    return (empty($_REQUEST['name']) ||
        empty($_REQUEST['email']) ||
        empty($_REQUEST['password']) ||
        empty($_REQUEST['repeatPassword']) ||
        empty($_REQUEST['phone']) ||
        empty($_REQUEST['address']));
}

function comparePassword()
{
    return ($_REQUEST['password'] === $_REQUEST['repeatPassword']);
}

function totalClients()
{
    return count(getAllClients());
}