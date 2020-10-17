<?php 
/**
 *  Gets a new mysql connection
 */
function getConnection() {
    $connection = new mysqli('localhost:3306', 'root', 'root1234', 'ISW-613_Proyecto1');
    if ($connection->connect_errno) {
      echo $connection->connect_error;
      die;
    }
    return $connection;
}
?>