<?php 
    require('sqlConnection.php');
    require('classUser.php');
    
    function validateUser($user){
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
        $newUser = new User($result['username'],
                            $result['password'],
                            $result['id'],
                            $result['role']);
        return ( !empty($result['id']) ? $newUser: false);
    }

    function userById($id){
        $conn = getConnection();
        $sql = "SELECT * FROM users WHERE `id`='$id';";
        $result = $conn->query($sql);
        if ($conn->connect_errno) {
            $conn->close();
            return false;
        }
        $conn->close();
        $result = $result->fetch_array();
        $newUser = new User($result['username'],
                            $result['password'],
                            $result['id'],
                            $result['role']);
        return (!empty($newUser->get_id()) ? $newUser : false);
    }

    // $stmt = $conn->prepare('SELECT * FROM users WHERE `username`=? AND `password`=?;');
    // $stmt->bind_param("ss",$username, $password);
    // $stmt->execute();
?>